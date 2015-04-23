<?php
interface iOP_Option{
	public function __construct($name);
	public function declareXML($xmlString);
	public function getOption($selectedValue);
	public function displayOption($selectedValue);
}