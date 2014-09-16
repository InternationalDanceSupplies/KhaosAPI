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
    use \KhaosAPI\Utility\Obj;
    
    /**
     * The Generic class provides methods for calling generic SOAP methods.
     *
     * @author Jon Matthews <joncarlmatthews@gmail.com>
     * @category KhaosAPI
     * @package Caller
     */
    class Generic extends CallerAbstract
    {
        private $_calledMethodName = null;

        /**
         * Setter for @link $_calledMethodName
         * 
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @param string $calledMethodName
         * @return CallerAbstract
         */
        public function setCalledMethodName($calledMethodName)
        {
            $this->_calledMethodName = $calledMethodName;
            return $this;
        }

        /**
         * Getter for @link $_calledMethodName
         * 
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @return \SoapClient
         */
        public function getCalledMethodName()
        {
            return $this->_calledMethodName;
        }

        /**
         * Calls the endpoint.
         *
         * @todo make it possible for the soap method to accept arguments.
         *
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @return string
         */
        public function run()
        {
            $soapMethod = $this->getCalledMethodName();

            return $this->getClient()->$soapMethod();
        }
    }
}