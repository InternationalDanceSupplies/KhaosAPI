<?php

namespace KhaosAPI\Caller
{
    use \KhaosAPI\Utility\Arr;
    
    abstract class CallerAbstract implements CallerInterface
    {
        private $_client = null;
        private $_args = array();

        public function setClient(\SoapClient $client)
        {
            $this->_client = $client;
        }
        public function getClient()
        {
            return $this->_client;
        }

        public function setArgs(array $args)
        {
            $this->_args = $args;
        }
        
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