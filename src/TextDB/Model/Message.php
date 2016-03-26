<?php

namespace TextDB\Model;


use TextDB\Model\BaseModel;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Message as MessageEntity;
use TextDB\Entity\Catalogue as CatalogueEntity;

/**
* 
*/
class Message extends BaseModel
{

	function __construct($dependencies)
	{
		parent::__construct($dependencies);
	}

	/**
	 * @param  string $identifier
	 * @param  string $text
	 * @param  string $locale
	 * @param  int $catalogFK
	 */
	public function createMessage(MessageEntity $message) {
		$data = [
			'identifier' => $message->identifier,
			'text' => $message->text,
			'locale' => $message->locale,
			'catalogue_fk' => $message->catalogueFK
		];
		$this->dbConnection
			 ->table('message')
			 ->insertIgnore($data);
	}

}