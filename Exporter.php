<?php

namespace KhaosAPI
{
    class Exporter extends Connector
    {
        public function stock(array $args = array())
        {
            $worker = new Exporter\Stock;
            $worker->setClient($this->_client);
            $worker->setArgs($args);
            return $worker->run();
        }
    }
}