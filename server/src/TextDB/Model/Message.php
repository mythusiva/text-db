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
	 * @param  int $catalogueFK
	 */
	public function createMessage(MessageEntity $message) {
		$data = [
			'identifier' 	=> $message->identifier,
			'text' 			=> $message->text,
			'locale' 		=> $message->locale,
			'catalogue_fk'  => $message->catalogueFK
		];
		$this->dbConnection
			 ->table('message')
			 ->insertIgnore($data);
	}

	protected function convertToEntity($row) {
		$messageEntity = parent::convertToEntity(MessageEntity::class,[
 			'messagePK'   => $row['message_pk'],
 			'identifier'  => $row['identifier'],
 			'text' 		  => $row['text'],
 			'locale' 	  => $row['locale'],
 			'catalogueFK' => $row['catalogueFK']
		]);
		
		# Maintained only by the DB triggers.
		$messageEntity->dateCreated  = $row['date_created'];
		$messageEntity->dateModified = $row['date_modified'];

		return $messageEntity;
	}

}