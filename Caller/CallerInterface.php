<?php

namespace KhaosAPI\Caller
{
    interface CallerInterface
    {
        public function setClient(\SoapClient $client);
        public function getClient();
        public function setArgs(array $args);
        public function getArgs($asObject = true);
        public function run();
    }
}