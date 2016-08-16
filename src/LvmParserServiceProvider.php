<?php

/**
 * This file contains the LvmParserServiceProvider class
 * It makes the functionality available to laravel
 *
 * PHP version 5.6
 *
 * @category Parser
 * @package  MrCrankHank\LvmParser
 * @author   Alexander Hank <mail@alexander-hank.de>
 * @license  Apache License 2.0 http://www.apache.org/licenses/LICENSE-2.0.txt
 * @link     null
 */

namespace MrCrankHank\LvmParser;

use Illuminate\Support\ServiceProvider;

/**
 * Class LvmParserServiceProvider
 *
 * @category Parser
 * @package  MrCrankHank\LvmParser
 * @author   Alexander Hank <mail@alexander-hank.de>
 * @license  Apache License 2.0 http://www.apache.org/licenses/LICENSE-2.0.txt
 * @link     null
 */
class LvmParserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Parser::class, function($app, $parameters) {
            return new Parser($parameters['string']);
        });
    }
}
