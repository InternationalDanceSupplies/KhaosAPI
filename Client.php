<?php

namespace KhaosAPI
{
    final class Client
    {
        private $_soapClient = null;

        private $_callers = array('\\KhaosAPI\\Caller\\ExportStock',
                                                '\\KhaosAPI\\Caller\\GetVersion');

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

        public function __call($className, $args)
        {
            $className = ucfirst($className);

            foreach($this->getCallers() as $fqcn){

                if (preg_match('/' . $className . '$/', $fqcn)){

                    $caller = new $fqcn;

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

                    break;
                }
            }

            throw new Exception('Caller ' . $className . ' not found');
        }
    }
}