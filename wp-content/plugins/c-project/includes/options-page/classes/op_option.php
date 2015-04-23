<?php
abstract class OP_Option {		
	public $name = '';
	public $xmlString = '';
	public $xmlElement = null;
	
	public function __construct($name){
		$this->name = $name;
	}
	
	public function declareXML($xmlString){
		$this->xmlString = $xmlString;
		$this->xmlElement = new SimpleXMLElement($xmlString);
	}
	
	public function displayOption($selectedValue = null){
		echo $this->getOption($selectedValue);
	}
}