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

namespace VectorNetworkProject\Vex;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    /** @var bool $beta */
    private static $beta = true;

    /** @var Main $instance */
    private static $instance = null;

    public function onLoad()
    {
        $this->saveDefaultConfig();
        self::$instance = $this;
        $this->getLogger()->notice('Loaded');
    }

    public function onEnable()
    {
        if (self::$beta) $this->getLogger()->warning('masterブランチのものを実行しています！');
        $this->getLogger()->notice('Enabled');
    }

    public function onDisable()
    {
        $this->getLogger()->notice('Disabled');
    }

    /**
     * @return Main
     */
    public static function getInstance(): Main
    {
        return self::$instance;
    }
}
