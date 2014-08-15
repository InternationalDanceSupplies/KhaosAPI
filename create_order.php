<?php

include_once "wrapper.php";

/*********

@ Create Order XML
	ready to be consume by Khaos Control by Keystone Software.
	
*********/

//XML_String
$xmlstring = <<<XML
<SALES_ORDERS xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.keystonesoftware.co.uk/xml/KSDXMLImportFormat.xsd">
</SALES_ORDERS>
XML;
   
$xml = new SimpleXMLElement($xmlstring);

//<SALES_ORDER>
	$SalesOrder = $xml->addChild('SALES_ORDER');
	$CustomerDetail = $SalesOrder->addChild('CUSTOMER_DETAIL');
	$Payments = $SalesOrder->addChild('PAYMENTS');
	$OrderHeader = $SalesOrder->addChild('ORDER_HEADER');
	$OrderItems = $SalesOrder->addChild('ORDER_ITEMS');

//<CUSTOMER_DETAIL>
	$CustomerDetail->addChild('IS_NEW_CUSTOMER','');
	$CustomerDetail->addChild('COMPANY_CODE','');
	$CustomerDetail->addChild('OTHER_REF','');
	$CustomerDetail->addChild('WEB_SITE','');
	$CustomerDetail->addChild('WEB_USER','');
	$CustomerDetail->addChild('COMPANY_CLASS','');
	$CustomerDetail->addChild('COMPANY_TYPE','');
	$CustomerDetail->addChild('COMPANY_NAME','');
	$CustomerDetail->addChild('SOURCE_CODE','');
	$CustomerDetail->addChild('MAILING_STATUS',''); //6 for NO, 3 For US + NO 3rd Parties
	$CustomerDetail->addChild('OPTIN_NEWSLETTER',''); //6 for NO, 3 For US + NO 3rd Parties
	$CustomerDetail->addChild('TAX_REFERENCE','');
	
//<ADDRESSES>
	$Addresses = $CustomerDetail->addChild('ADDRESSES');

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
 
//<DELADDR>
	$DeliveryAddress = $Addresses->addChild('DELADDR');
	$DeliveryAddress->addChild('DADDRESS1','');
	$DeliveryAddress->addChild('DADDRESS2','');
	$DeliveryAddress->addChild('DADDRESS3','');
	$DeliveryAddress->addChild('DTOWN','');
	$DeliveryAddress->addChild('DCOUNTY','');
	$DeliveryAddress->addChild('DPOSTCODE','');
	$DeliveryAddress->addChild('DCOUNTRY_CODE','');
	$DeliveryAddress->addChild('DTITLE','');
	$DeliveryAddress->addChild('DFORENAME','');
	$DeliveryAddress->addChild('DSURNAME','');
	$DeliveryAddress->addChild('DTEL','');
	$DeliveryAddress->addChild('DFAX','');
	$DeliveryAddress->addChild('DMOBILE','');
	$DeliveryAddress->addChild('DEMAIL','');
	$DeliveryAddress->addChild('DEMAIL_SUBSCRIBER',''); //0 = no, -1 = Yes
	$DeliveryAddress->addChild('DDOB','');
	$DeliveryAddress->addChild('DORGANISATION','');

//<PAYMENT_DETAIL>
	$PaymentDetail = $Payments->addChild('PAYMENT_DETAIL',' ');
	$PaymentDetail->addChild('PAYMENT_AMOUNT','');
	$PaymentDetail->addChild('PAYMENT_TYPE',''); //0 - Cash, 1 - Cheque, 2 - Credit Card, 3 - Account, 4 - Voucher
	$PaymentDetail->addChild('CARD_TYPE','');
	$PaymentDetail->addChild('CARD_NUMBER','');
	$PaymentDetail->addChild('CARD_START','');
	$PaymentDetail->addChild('CARD_EXPIRE','');
	$PaymentDetail->addChild('CARD_ISSUE','');
	$PaymentDetail->addChild('CARD_CV2','');
	$PaymentDetail->addChild('CARD_NAME','');
	$PaymentDetail->addChild('PREAUTH','');
	$PaymentDetail->addChild('AUTH_CODE','');
	$PaymentDetail->addChild('TRANSACTION_ID','');
	$PaymentDetail->addChild('PREAUTH_REF','');
	$PaymentDetail->addChild('SECURITY_REF','');
	$PaymentDetail->addChild('SECURITY_COMMENT','');
	$PaymentDetail->addChild('ACCOUNT_NUMBER','');
	$PaymentDetail->addChild('ACCOUNT_NAME','');

//<ORDER_HEADER>
	$OrderHeader->addChild('ORDER_DATE','');
	$OrderHeader->addChild('DELIVERY_DATE','');
	$OrderHeader->addChild('ORDER_AMOUNT','');
	$OrderHeader->addChild('ORDER_CURRENCY_CODE','');
	$OrderHeader->addChild('SITE','');
	$OrderHeader->addChild('ASSOCIATED_REF',''); 
	$OrderHeader->addChild('AGENT','');
	$OrderHeader->addChild('ORDER_NOTE','');
	$OrderHeader->addChild('INVOICE_NOTE','');
	$OrderHeader->addChild('DELIVERY_NET','');
	$OrderHeader->addChild('DELIVERY_TAX','');
	$OrderHeader->addChild('DELIVERY_GRS','');
	$OrderHeader->addChild('COURIER_CODE',' ');
	$OrderHeader->addChild('PO_NUMBER','');
	$OrderHeader->addChild('KEYCODE_CODE',' ');
	$OrderHeader->addChild('BRAND',' ');
	$OrderHeader->addChild('SALES_SOURCE','');
	$OrderHeader->addChild('COURIER_NOTE',' ');
	$OrderHeader->addChild('INVOICE_PRIORITY',' ');
	
	//<COMMS_LOGS>
		$CommsLogs = $OrderHeader->addChild('COMMS_LOGS');
		$CommLogEntry = $CommsLogs->addChild('COMM_LOG_ENTRY');
		
		//<COMM_LOG_ENTRY>
			$CommLogEntry->addChild('CONTACT_TYPE','Application');
			$CommLogEntry->addChild('DATE','');
			$CommLogEntry->addChild('NEXT_DATE','');
			$CommLogEntry->addChild('DESCRIPTION','');
			$CommLogEntry->addChild('RESPONSE','');

//<ORDER_ITEMS>
$OrderItem = $OrderItems->addChild('ORDER_ITEM');

	//<ORDER_ITEM>
		$OrderItem->addChild('STOCK_CODE','');
		$OrderItem->addChild('MAPPING_TYPE',1); //-1 = Automatic matching, 1 - SKU,	2 'Other Ref',	3 - External mapping file, 4 - STOCK_DESC > Stock Description, 5 = STOCK_CODE > Stock Barcodes
		$OrderItem->addChild('STOCK_DESC','');
		$OrderItem->addChild('EXTENDED_DESC','');
		$OrderItem->addChild('ORDER_QTY','');
		$OrderItem->addChild('PRICE_GRS','');
		$OrderItem->addChild('TAX_RATE',''); //1 - Standard (e.g, 20%), 2 - Zero, 4 - Reduced (e.g, 5%)

$PreparedXML = $xml->asXML();
$OrderXML = <<<XML
$XMLString
XML;


/*********

@ Output XML to browser
	for testing before submitted to Khaos, compare to KSDXMLImportFormat.xml.
	
*********/

echo '<pre>';
print_r($OrderXML);
echo '</pre>';

/*********

@ Send XML to Khaos Control
	via HTTP SOAP webservices.
	
*********/

$Connect = new Khaos('http://192.168.16.1/KhaosWeb/KhaosIDS.exe/wsdl/IKosWeb');
$Connect->ImportOrders($OrderXML);

/*********

@ View Khaos Reponse
	Demo loops through orders and retrieve Associated Ref & SOR number.
	
*********/

foreach($Connect->OrderImportResult as $OrderLine):
	$Ref = $OrderLine->AssociatedRef;
	$Sor = $OrderLine->SalesOrderCode;
endforeach;


 ?>
 