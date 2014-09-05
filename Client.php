<?php

namespace KhaosAPI
{
    final class Client
    {
        private $_soapClient = null;

        public function __construct(\SoapClient $soapClient)
        {
            $this->_soapClient = $soapClient;
        }

        public function getClient()
        {
            return $this->_soapClient;
        }

        public function export()
        {
            return new Exporter($this);
        }

        public function import()
        {
            return new Importer($this);
        }
    }
}