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
		$this->cataloguePK		= $properties->getValue('cataloguePK',null);
		$this->catalogueTitle 	= $properties->getValue('catalogueTitle',null);
	}

	/**
	 * @var int
	 */
	public $cataloguePK;
	/**
	 * @var string
	 */
	public $catalogueTitle;
}