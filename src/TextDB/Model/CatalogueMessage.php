<?php

namespace TextDB\Model;

use TextDB\Model\BaseModel;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Catalogue as CatalogueEntity;

/**
* 
*/
class CatalogueMessage extends BaseModel
{
	
	function __construct(StorageProvider $storage)
	{
		$this->__construct($storage);
	}

	function getCatalogueMessages(CatalogueEntity $catalogue) {
		
	}
}