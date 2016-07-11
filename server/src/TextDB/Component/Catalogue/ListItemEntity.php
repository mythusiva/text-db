<?php

namespace TextDB\Component\Catalogue;

use TextDB\Utils\Properties;
use TextDB\Component\Catalogue\Entity as CatalogueEntity;

/**
* 
*/
class ListItemEntity extends CatalogueEntity
{

	const EXCEPTION_INVALID_STRINGS_COUNT = 0;

	/**
	 * @param Properties
	 */
	function __construct(Properties $properties)
	{
		parent::__construct($properties);
		$this->textsCount = $properties->getValue('textsCount',null);
	}

	/**
	 * @var int
	 */
	public $textsCount;

	public function validate() 
	{
		parent::validate();
		if(
			!is_int($this->textsCount) 
			&& !($this->textsCount >= 0)
		) {
			throw new \Exception(
				"The textsCount value should be greater than or equal to zero.", 
				self::EXCEPTION_INVALID_STRINGS_COUNT
			);
		}
	}
}
