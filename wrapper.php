<?php

class Khaos{

	public $client;
	
	public $ExportedStock;
	
	public $Version;
	public $StockList;
	
	public $CompanyList;
	public $CountryList;
	public $SaleSource;
	public $CompanyClass;
	public $Manufacturer;
	public $KeycodeTypes;
	public $Keycodes;
	public $PriceLists;
	public $AgentList;
	public $StockDataArray;
	
	public function __construct($endpoint){
		try{
			$this->client = new SoapClient($endpoint);
		}catch(Exception $e){
			echo 'Error connecting to endpoint.';
		}
	}
	
	public function GetFunctions(){
		try{
			$Functions = $this->client->__getFunctions();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetFunctions)';
			$Functions = False;
		}
	return $Functions;
	} 
		
	public function ExportStock($StockCode, $MappingType = 1, $LastUpdated = '2000-01-01'){
		if(is_array($StockCode)){$StockCode = implode(",",$StockCode);}
		try{
			$this->ExportedStock = $this->client->ExportStock($StockCode, $MappingType, $LastUpdated);
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(ExportStock)';
		}
	}	
	
	public function GetVersion(){
		try{
			$this->Version = $this->client->GetVersion();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetVersion)';
		}
	}		
	
	public function GetStockList($LastUpdated = '2000-01-01'){
		try{
			$this->StockList = $this->client->GetStockList();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetStockList)';
		}
	}		
		
	public function GetCompanyList($LastUpdated = '2000-01-01'){
		try{
			$this->CompanyList = $this->client->GetCompanyList();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetCompanyList)';
		}
	}		
	
	public function GetCountryList(){
		try{
			$this->CountryList = $this->client->GetCountryList();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetCountryList)';
		}
	}			
	public function GetSaleSource(){
		try{
			$this->SaleSource = $this->client->GetSaleSource();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetSaleSource)';
		}
	}	
	
	public function GetCompanyClass(){
		try{
			$this->CompanyClass = $this->client->GetCompanyClass();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetCompanyClass)';
		}
	}			
	public function GetManufacturer(){
		try{
			$this->Manufacturer = $this->client->GetManufacturer();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetManufacturer)';
		}
	}	
		
	public function GetKeycodeTypes(){
		try{
			$this->KeycodeTypes = $this->client->GetKeycodeTypes();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetKeycodeTypes)';
		}
	}	
	
	public function GetKeycodes(){
		try{
			$this->Keycodes = $this->client->GetKeycodes();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetKeycodes)';
		}
	}
			
	public function GetPriceLists(){
		try{
			$this->PriceLists = $this->client->GetPriceLists();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetPriceLists)';
		}
	}
	
	public function GetAgentList(){
		try{
			$this->AgentList = $this->client->GetAgentList();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetAgentList)';
		}
	}
	
	public function GetStockDataArray(){
		try{
			$this->StockDataArray = $this->client->FTStockDataArray();
		}catch(Exception $e){
			echo 'Error connecting to endpoint.(GetStockDataArray)';
		}
	}
		
	public function GetAll(){
		//Warning! Calling this function could take a little while...
		
		$this->GetVersion();
		$this->GetStockList();
		$this->GetCompanyList();
		$this->GetCountryList();
		$this->GetSaleSource();
		$this->GetCompanyClass();
		$this->GetManufacturer();
		$this->GetKeycodeTypes();
		$this->GetKeycodes();
		$this->GetPriceLists();
		$this->GetAgentList();
		$this->GetStockDataArray();
		
	}
}

//Create Connectiojn
$Connect = new Khaos('http://192.168.16.1/KhaosWeb/KhaosIDS.exe/wsdl/IKosWeb');
//List All Functions
var_dump($Connect->GetFunctions());
//Dump Object
print_r($Connect);
//Example, Call export stock.
$Connect->ExportStock('ABT01');



?>