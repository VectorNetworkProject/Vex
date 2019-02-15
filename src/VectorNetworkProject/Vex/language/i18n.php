<?php
/**
 * MIT License
 *
 * Copyright (c) 2019 Vector Network Project
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace VectorNetworkProject\Vex\language;


use pocketmine\Server;
use pocketmine\utils\MainLogger;
use VectorNetworkProject\Vex\Main;

class i18n
{
    public const LANGUAGE_DIR = 'lang';

    public const FALLBACK_LANG = 'ja_jp';

    /** @var Language[] $language */
    private static $language;

    private static $lang = [
        'en_US',
        'ja_JP'
    ];

    public function __construct()
    {
        try {
            @mkdir(static::getPath());
            $this->LangLoader();
        } catch (\ErrorException $e) {
            MainLogger::getLogger()->logException($e);
            Server::getInstance()->shutdown();
        }
    }

    /**
     * @throws \ErrorException
     */
    private function LangLoader(): void
    {
        $path = static::getPath();
        foreach (static::$lang as $filename) {
            Main::getInstance()->saveResource(static::getPath().$filename.'.ini', true);
        }
        if (is_dir($path)) {
            $allFiles = scandir($path, SCANDIR_SORT_NONE);
            if ($allFiles !== false) {
                $files = array_filter($allFiles, function ($filename) {
                    return substr($filename, -4) === ".ini";
                });
                foreach ($files as $file) {
                    $code = explode(".", $file)[0];
                    $lang = new Language($code);
                    static::$language[$lang->getLang()] = $lang;
                }
            }
        }

        throw new \ErrorException("Language directory $path does not exist or is not a directory");
    }

    /**
     * @param string $lang
     * @return Language
     */
    public static function getLang(string $lang): Language
    {
        return isset(static::$language[strtolower($lang)])
            ? static::$language[strtolower($lang)]
            : static::$language[static::FALLBACK_LANG];
    }

    /**
     * @return string
     */
    public static function getPath(): string
    {
        return Main::getInstance()->getDataFolder() . static::LANGUAGE_DIR . DIRECTORY_SEPARATOR;
    }
}