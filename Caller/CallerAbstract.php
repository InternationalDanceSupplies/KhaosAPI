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
    use \KhaosAPI\Utility\Arr;
    
    /**
     * The abstract class CallerAbstract provides base functionality for child
     * Caller classes.
     *
     * @category   KhaosAPI
     * @package    Caller
     */
    abstract class CallerAbstract implements CallerInterface
    {
        /**
         * \SoapClient object
         *
         * @access private
         * @var \SoapClient
         */
        private $_client = null;

        /**
         * Caller arguments
         *
         * @access private
         * @var array
         */
        private $_args = array();

        /**
         * Setter for @link $_client
         * 
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @return CallerAbstract
         */
        public function setClient(\SoapClient $client)
        {
            $this->_client = $client;
            return $this;
        }

        /**
         * Getter for @link $_client
         * 
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @return \SoapClient
         */
        public function getClient()
        {
            return $this->_client;
        }

        /**
         * Setter for @link $_args
         * 
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @return CallerAbstract
         */
        public function setArgs(array $args)
        {
            $this->_args = $args;
            return $this;
        }
        
        /**
         * Getter for @link $_args
         * 
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @param bool $asObject The return type.
         * @return array|object
         */
        public function getArgs($asObject = true)
        {
            $asObject = (bool)$asObject;

            if ($asObject){
                return Arr::toObject($this->_args);
            }

            return $this->_args;
        }
    }
}