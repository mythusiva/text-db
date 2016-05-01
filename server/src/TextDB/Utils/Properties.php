<?php

namespace TextDB\Utils;

/**
* 
*/
class Properties
{

	/** 
	 * @var array
	 */
	private $properties;
	
	function __construct($properties)
	{
		$this->properties = $properties;
	}

	/**
	 * Based on the provided keyName, it will return the 
	 * array value at that index if it exists. If it does
	 * not exist, it will return the provided defaultValue.
	 * 
	 * @param  string $keyName
	 * @param  mixed $defaultValue
	 * @return mixed
	 */
	function getValue($keyName,$defaultValue) {
		if(array_key_exists($keyName, $this->properties)) {
			return $this->properties[$keyName];
		} else {
			return $defaultValue;
		}
	}
}