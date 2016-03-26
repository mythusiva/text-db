<?php

namespace TextDB\Provider;

use TextDB\Entity\Catalogue as CatalogueEntity;
use TextDB\Entity\Message as MessageEntity;

/**
*
*/
class Translation extends BaseProvider
{
	/**
	 * @var CatalogueEntity
	 */
	private $catalogue;

	/**
	 * @var array
	 */
	private $loadedMessages;

	/**
	 * @param CatalogueEntity $catalogue
	 */
	function __construct(CatalogueEntity $catalogue)
	{
		
		$this->catalogue = $catalogue;

	}

}