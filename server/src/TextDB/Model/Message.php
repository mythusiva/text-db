<?php

namespace TextDB\Model;


use TextDB\Model\BaseModel;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Message as MessageEntity;
use TextDB\Enum\LanguageCodes;

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
			'identifier' 			=> $message->identifier,
			'text' 						=> $message->text,
			'locale' 					=> $message->locale,
			'catalogue_name'  => $message->catalogueName,
			'is_plural_form' 	=> $message->isPluralForm,
			'date_created'		=> date(MYSQL_DATETIME_FORMAT),
			'date_modified'		=> date(MYSQL_DATETIME_FORMAT),
		];

		LanguageCodes::assertExists($message->locale);

		$this->dbConnection
			 ->table('message')
			 ->insertIgnore($data);

		return true;
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
	public function getMessageListByCatalogue($catalogueName) {
		$rows = $this->dbConnection
					 ->table('message')
					 ->where('catalogue_name','=',$catalogueName)
					 ->get();

		$messageList = [];
		foreach ($rows as $rowArray) {
			$messageList[] = $this->convertToEntity($rowArray);
		}

		return $messageList;
	}

	/**
	 * @return MessageEntity[]
	 */
	public function getMessageList($limit) {
		$rows = $this->dbConnection
					 ->table('message')
					 ->limit((int)$limit)
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
 			'catalogueName' => $row['catalogue_name'],
 			'isPluralForm' => $row['is_plural_form']
		]);
		
		$messageEntity->dateCreated  = $row['date_created'];
		$messageEntity->dateModified = $row['date_modified'];

		return $messageEntity;
	}

}