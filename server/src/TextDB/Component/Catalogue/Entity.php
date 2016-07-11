<?php

namespace TextDB\Component\Catalogue;

use TextDB\Utils\Properties;

/**
* 
*/
class Entity
{

	const EXCEPTION_EMPTY_CATALOGUE_NAME = 0;

	/**
	 * @param Properties
	 */
	function __construct(Properties $properties)
	{
		$this->catalogueName = $properties->getValue('catalogueName',null);
	}

	/**
	 * @var string
	 */
	public $catalogueName;

	public function validate() {
		if(empty($this->catalogueName)) {
			throw new \Exception("Field cannot be empty: catalogueName", self::EXCEPTION_EMPTY_CATALOGUE_NAME);
		}
	}
}
