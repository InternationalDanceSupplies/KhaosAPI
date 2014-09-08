<?php

/**
 * KhaosAPI
 *
 * @link        https://github.com/InternationalDanceSupplies/KhaosAPI for the canonical source repository
 * @copyright   Copyright (C) 2014 IDS. See license.txt packaged with this source code.
 * @link        Coded to the Zend Framework Coding Standard for PHP 
 *              http://framework.zend.com/manual/1.12/en/coding-standard.html
 * 
 * File format: UNIX
 * File encoding: UTF8
 * File indentation: Spaces (4). No tabs
 *
 */

namespace KhaosAPI\Caller
{
    /**
     * The CallerInterface interface provides a consistent interface for
     * Caller classes.
     *
     * @category   KhaosAPI
     * @package    Caller
     */
    interface CallerInterface
    {
        public function setClient(\SoapClient $client);
        public function getClient();
        public function setArgs(array $args);
        public function getArgs($asObject = true);
        public function run();
    }
}