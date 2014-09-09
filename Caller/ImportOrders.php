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
    use \KhaosAPI\Utility\Obj;
    
    /**
     * The ImportOrders class provides methods for calling the ImportOrders SOAP
     * method.
     *
     * @author Jon Matthews <joncarlmatthews@gmail.com>
     * @category KhaosAPI
     * @package Caller
     */
    class ImportOrders extends CallerAbstract
    {

        /**
         * \SimpleXMLElement object
         *
         * @access private
         * @var \SimpleXMLElement
         */
        private $_xmlObj = null;

        /**
         * \SimpleXMLElement object
         *
         * @access private
         * @var \SimpleXMLElement
         */
        private $_xmlPath = '
                <SALES_ORDERS xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                                xsi:noNamespaceSchemaLocation="http://www.keystonesoftware.co.uk/xml/KSDXMLImportFormat.xsd">
                </SALES_ORDERS>
        ';

        public function __construct()
        {
            $this->_xmlObj = new \SimpleXMLElement($this->_xmlPath);
        }

        /**
         * Calls ImportOrders.
         * 
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @return string
         */
        public function run()
        {
            // Stock code.
            if (!isset($this->getArgs()->orders)){
                throw new Exception('Missing orders array.');
            }

            $args = $this->getArgs(false);

            foreach($args['orders'] as $order){

                $salesOrder = $this->_xmlObj->addChild('SALES_ORDER');

                $this->_arrayToXml($order, $salesOrder);
            }

            // Debug:
            /*
            header('Content-Type: application/xml; charset=utf-8');
            $domxml = new \DOMDocument('1.0');
            $domxml->preserveWhiteSpace = false;
            $domxml->formatOutput = true;
            $domxml->loadXML($this->_xmlObj->asXML());
            echo $domxml->saveXML();
            exit();
            */

            // Call server.
            return $this->getClient()->ImportOrders($this->_xmlObj->asXML());
        }

        /**
         * Converts a MD array into XML nodes.
         * 
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @param array $bind
         * @param \SimpleXMLElement $xmlParentNode
         * @return void
         */
        private function _arrayToXml($bind, &$xmlParentNode)
        {
            foreach($bind as $key => $value) {
                if(is_array($value)) {
                    if(!is_numeric($key)){
                        $subnode = $xmlParentNode->addChild("$key");
                        $this->_arrayToXml($value, $subnode);
                    }
                    else{
                        $subnode = $xmlParentNode->addChild("item$key");
                        $this->_arrayToXml($value, $subnode);
                    }
                }
                else {
                    $xmlParentNode->addChild("$key",htmlspecialchars("$value"));
                }
            }
        }
    }
}