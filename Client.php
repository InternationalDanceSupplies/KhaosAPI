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

namespace KhaosAPI
{
    /**
     * The Client class provides a wrapper for calling Khaos API endpoints.
     *
     * @final
     * @author Jon Matthews <joncarlmatthews@gmail.com>
     * @category KhaosAPI
     * @package Client
     */
    final class Client
    {
        /**
         * \SoapClient object.
         *
         * @access private
         * @var \SoapClient
         */
        private $_soapClient = null;

        /**
         * Array of callable classes
         *
         * @access private
         * @var array
         */
        private $_callers = array();

        /**
         * Class constructor
         *
         * @access public
         * @author  Jon Matthews <joncarlmatthews@gmail.com>
         * @param SoapClient $soapClient
         * @return Client
         */
        public function __construct(\SoapClient $soapClient)
        {
            $this->_soapClient = $soapClient;
        }
        
        /**
         * Returns SoapClient object.
         *
         * @access public
         * @author  Jon Matthews <joncarlmatthews@gmail.com>
         * @return SoapClient
         */
        public function getClient()
        {
            return $this->_soapClient;
        }

        /**
         * Returns the list of user defined callers.
         *
         * @access public
         * @author  Jon Matthews <joncarlmatthews@gmail.com>
         * @return array
         */
        public function getCallers()
        {
            return $this->_callers;
        }

        /**
         * Register Caller method.
         *
         * @access public
         * @author  Jon Matthews <joncarlmatthews@gmail.com>
         * @param \KhaosAPI\Caller\CallerInterface $caller
         * @return Client
         */
        public function registerCaller(\KhaosAPI\Caller\CallerInterface $caller,
                                            $key = null)
        {
            if (is_null($key)){
                $key = get_class($caller);
            }
            $this->_callers[$key] = $caller;
            return $this;
        }

        /**
         * Method loads and executes the relevant caller class.
         *
         * @access public
         * @author  Jon Matthews <joncarlmatthews@gmail.com>
         * @param string $className
         * @param array $args
         * @throws KhaosAPI\Exception
         * @return mixed
         */
        public function __call($className, $args)
        {
            $caller = null;

            $className = ucfirst($className);

            $internalClassFileName = __DIR__ 
                                        . DIRECTORY_SEPARATOR 
                                        . 'Caller' 
                                        . DIRECTORY_SEPARATOR 
                                        . $className 
                                        . '.php';

            if (is_file($internalClassFileName)){

                $callerClass = '\\KhaosAPI\\Caller\\' . $className;

                $caller = new $callerClass;

            }else{

                foreach($this->getCallers() as $fqcn => $obj){

                    if (preg_match('/' . $className . '$/', $fqcn)){

                        $caller = $obj;
                        break;
                    }
                }
            }

            if (!is_null($caller)){

                // Set the client.
                if ( (isset($args[1]))
                        && ($args[1] instanceof \SoapClient) ){
                    $caller->setClient($args[1]);
                }else{
                    $caller->setClient($this->getClient());
                }

                // Set the arguments.
                if (isset($args[0])){
                    $caller->setArgs($args[0]);
                }

                // Call the endpoint.
                return $caller->run();

            }else{
                throw new Exception('Caller ' . $className . ' not found');
            }
        }
    }
}