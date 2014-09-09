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

        private function _addNodeFromArray(array $bind,
                                            \SimpleXMLElement $parentNode,
                                            $xmlNodeKey, 
                                            $defaultValue = null)
        {
            if(isset($bind[$xmlNodeKey])){
                $parentNode->addChild($xmlNodeKey, $bind[$xmlNodeKey]); 
            }else{
                $parentNode->addChild($xmlNodeKey, $defaultValue); 
            }
        }

        /**
         * Calls the endpoint.
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

            foreach($this->getArgs(false) as $order){

                // <SALES_ORDER>
                $salesOrder = $this->_xmlObj->addChild('SALES_ORDER');

                $customerDetail     = $salesOrder->addChild('CUSTOMER_DETAIL');
                $payments           = $salesOrder->addChild('PAYMENTS');
                $orderHeader        = $salesOrder->addChild('ORDER_HEADER');
                $orderItems         = $salesOrder->addChild('ORDER_ITEMS');

                // <CUSTOMER_DETAIL>
                $this->_addNodeFromArray($order, $customerDetail, 'IS_NEW_CUSTOMER');
                $this->_addNodeFromArray($order, $customerDetail, 'COMPANY_CODE');
                $this->_addNodeFromArray($order, $customerDetail, 'OTHER_REF');
                $this->_addNodeFromArray($order, $customerDetail, 'WEB_SITE');
                $this->_addNodeFromArray($order, $customerDetail, 'WEB_USER');
                $this->_addNodeFromArray($order, $customerDetail, 'COMPANY_CLASS');
                $this->_addNodeFromArray($order, $customerDetail, 'COMPANY_TYPE');
                $this->_addNodeFromArray($order, $customerDetail, 'COMPANY_NAME');
                $this->_addNodeFromArray($order, $customerDetail, 'SOURCE_CODE');
                $this->_addNodeFromArray($order, $customerDetail, 'MAILING_STATUS');
                $this->_addNodeFromArray($order, $customerDetail, 'OPTIN_NEWSLETTER');
                $this->_addNodeFromArray($order, $customerDetail, 'TAX_REFERENCE');

                // <ADDRESSES>
                $addresses = $CustomerDetail->addChild('ADDRESSES');

                //<INVADDR>
                $InvoiceAddress = $Addresses->addChild('INVADDR');
                $InvoiceAddress->addChild('IADDRESS1','');  
                $InvoiceAddress->addChild('IADDRESS2','');  
                $InvoiceAddress->addChild('IADDRESS3','');  
                $InvoiceAddress->addChild('ITOWN','');  
                $InvoiceAddress->addChild('ICOUNTY','');    
                $InvoiceAddress->addChild('IPOSTCODE','');  
                $InvoiceAddress->addChild('ICOUNTRY_CODE','');  
                $InvoiceAddress->addChild('ITITLE','');
                $InvoiceAddress->addChild('IFORENAME','');  
                $InvoiceAddress->addChild('ISURNAME','');   
                $InvoiceAddress->addChild('ITEL','');   
                $InvoiceAddress->addChild('IFAX','');   
                $InvoiceAddress->addChild('IMOBILE','');    
                $InvoiceAddress->addChild('IEMAIL',''); 
                $InvoiceAddress->addChild('IEMAIL_SUBSCRIBER',''); //0 = no, -1 = Yes
                $InvoiceAddress->addChild('IDOB','');
                $InvoiceAddress->addChild('IORGANISATION','');

            }

            // Debug:
            header('Content-Type: application/xml; charset=utf-8');
            $domxml = new \DOMDocument('1.0');
            $domxml->preserveWhiteSpace = false;
            $domxml->formatOutput = true;
            $domxml->loadXML($this->_xmlObj->asXML());
            echo $domxml->saveXML();
            exit();

            //$orders = '';
            //echo $orders;

            // Call server.
            //return $this->getClient()->ImportOrders('<SALES_ORDERS xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.keystonesoftware.co.uk/xml/KSDXMLImportFormat.xsd">');
        }
    }
}