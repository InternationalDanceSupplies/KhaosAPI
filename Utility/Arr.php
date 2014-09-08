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
     * The Arr class provides methods for dealing with common array
     * tasks.
     *
     * @author      Jon Matthews <joncarlmatthews@gmail.com>
     * @category    KhaosAPI
     * @package     Utility
     */
    class Arr
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
         * Converts an array to an Object of type stdClass.
         *
         * @static
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @param array $array
         * @return stdClass
         */
        static public function toObject($array)
        {
            $result = new \stdClass();
            
            foreach ($array as $key => $value){

                if (is_array($value)){
                    $result->{$key} = self::toObject($value);
                }else{
                    $result->{$key} = $value;
                }
            }
            
            return $result;
        }
    }
}