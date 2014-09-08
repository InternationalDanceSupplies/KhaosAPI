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

namespace KhaosAPI\Utility
{
    /**
     * The Obj class provides methods for dealing with common Object
     * tasks.
     *
     * @author      Jon Matthews <joncarlmatthews@gmail.com>
     * @category    KhaosAPI
     * @package     Utility
     */
    class Obj
    {
        /**
         * Private constructor for singleton
         *
         * @access private
         * @author  Jon Matthews <joncarlmatthews@gmail.com>
         * @return ArrayMethods
         */
        private function __construct(){}
        
        /**
         * Private clone for singleton
         *
         * @access private
         * @author  Jon Matthews <joncarlmatthews@gmail.com>
         * @return ArrayMethods
         */
        private function __clone(){}

        /**
         * Converts an object to s string.
         *
         * @static
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @param StdObject $object
         * @param string $glue
         * @return string
         */
        static public function toString($object, $glue = ',')
        {
            $array = json_decode(json_encode($object), true);
            
            return implode($glue, $array);
        }
    }
}