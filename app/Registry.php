<?php

/**
 * @package app
 * @author Deleuil Maxime
 * @var $vars 
 * @version 1.0.0
 */ 
Class Registry {

	private $vars = array();

	/**
	 * setter de la classe 
	 * @param  String $index 
	 * @param  type $value 
	 */
	public function __set($index, $value)
	{
		$this->vars[$index] = $value;
	}

	/**
	 * getter de la classe
	 * @param  String $index 
	 * @return type
	 */
	public function __get($index)
	{
		return $this->vars[$index];
	}
}
?>