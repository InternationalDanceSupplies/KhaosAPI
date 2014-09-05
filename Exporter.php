<?php

namespace KhaosAPI
{
    class Exporter extends Connector
    {
        public function stock(array $args = array(),
                                $client = null)
        {
            $caller = new Exporter\Stock;

            // Set the client.
            if ($client instanceof \SoapClient){
                $caller->setClient($client);
            }else{
                $caller->setClient($this->_apiClient->getClient());
            }
            
            // Set the arguments.
            $caller->setArgs($args);

            // Call the endpoint.
            return $caller->run();
        }
    }
}