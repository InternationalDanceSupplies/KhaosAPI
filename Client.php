<?php

namespace KhaosAPI
{
    final class Client
    {
        private $_soapClient = null;

        private $_callers = array();

        public function __construct(\SoapClient $soapClient)
        {
            $this->_soapClient = $soapClient;
        }

        public function getClient()
        {
            return $this->_soapClient;
        }

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