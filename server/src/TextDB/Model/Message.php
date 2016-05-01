<?php

namespace TextDB\Model;


use TextDB\Model\BaseModel;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Message as MessageEntity;

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
	 * @param  MessageEntity $message
	 */
	public function createMessage(MessageEntity $message) {
		$data = [
			'identifier' 		=> $message->identifier,
			'text' 				=> $message->text,
			'locale' 			=> $message->locale,
			'catalogue_name'  	=> $message->catalogueName
		];
		$this->dbConnection
			 ->table('message')
			 ->insertIgnore($data);
	}

	/**
	 * @param  string 			$messageIdentifier
	 * @return MessageEntity
	 */
	public function getMessage($messageIdentifier) {
		$row = $this->dbConnection
					->table('message')
					->where('identifier','=',$messageIdentifier)
					->first();

		return $this->convertToEntity($row);
	}

	/**
	 * @return MessageEntity[]
	 */
	public function getMessageList() {
		$rows = $this->dbConnection
					 ->table('message')
					 ->get();

		$messageList = [];
		foreach ($rows as $rowArray) {
			$messageList[] = $this->convertToEntity($rowArray);
		}

		return $messageList;
	}

	protected function convertToEntity($row) {
		$messageEntity = parent::convertToEntity(MessageEntity::class,[
 			'messagePK'   	=> $row['message_pk'],
 			'identifier'  	=> $row['identifier'],
 			'text' 		  	=> $row['text'],
 			'locale' 	  	=> $row['locale'],
 			'catalogueName' => $row['catalogue_name']
		]);
		
		# Maintained only by the DB triggers.
		$messageEntity->dateCreated  = $row['date_created'];
		$messageEntity->dateModified = $row['date_modified'];

		return $messageEntity;
	}

}