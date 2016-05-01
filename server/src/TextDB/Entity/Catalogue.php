<?php

namespace TextDB\Entity;


use TextDB\Utils\Properties;

/**
* 
*/
class Catalogue
{

	/**
	 * @param array
	 */
	function __construct(Properties $properties)
	{
		$this->catalogueName 	= $properties->getValue('catalogueName',null);
	}

	/**
	 * @var string
	 */
	public $catalogueName;
}