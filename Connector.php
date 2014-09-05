<?php

namespace KhaosAPI
{

    class Connector
    {
        protected $_apiClient = null;
        
        public function __construct(Client $apiClient)
        {
            $this->_apiClient = $apiClient;
        }
    }
}