<?php

namespace TextDB\Providers;


use TextDB\Entity\Catalogue as CatalogueEntity;
use TextDB\Entity\Message as MessageEntity;

/**
*
*/
class Translation
{
	/** @var CatalogueEntity */
	private $catalogue;


	private $loadedMessages;


	function __construct(CatalogueEntity $catalogue)
	{
		
		$this->catalogue = $catalogue;

	}


	function loadMessages() {

		
		
	}



}