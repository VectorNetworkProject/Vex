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


class i18n
{
    public const LANGUAGE_DIR = 'lang';

    public const FALLBACK_LANG = 'ja_jp';

    /** @var Language[] $language */
    private static $language;

    /**
     * @param Language $language
     */
    public static function register(Language $language): void
    {
        static::$language[$language->getLang()] = $language;
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
        return \vex\RESOURCES_PATH . static::LANGUAGE_DIR . DIRECTORY_SEPARATOR;
    }
}