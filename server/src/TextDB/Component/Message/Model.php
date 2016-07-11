<?php

namespace TextDB\Component\Message;

use TextDB\Component\Base\Model as BaseModel;
use TextDB\Component\Message\Entity as MessageEntity;
use TextDB\Enum\LanguageCodes;
use TextDB\Utils\EntityHelper;

/**
* 
*/
class Model extends BaseModel
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

		$messageEntity = EntityHelper::createEntity(MessageEntity::class,[
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
			$messageEntity = EntityHelper::createEntity(MessageEntity::class,[
	 			'messagePK'   	=> $rowArray['message_pk'],
	 			'identifier'  	=> $rowArray['identifier'],
	 			'text' 		  	=> $rowArray['text'],
	 			'locale' 	  	=> $rowArray['locale'],
	 			'catalogueName' => $rowArray['catalogue_name'],
	 			'isPluralForm' => $rowArray['is_plural_form']
			]);
			$messageEntity->dateCreated  = $rowArray['date_created'];
			$messageEntity->dateModified = $rowArray['date_modified'];
			$messageList[] = $messageEntity;
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
			$messageEntity = EntityHelper::createEntity(MessageEntity::class,[
	 			'messagePK'   	=> $rowArray['message_pk'],
	 			'identifier'  	=> $rowArray['identifier'],
	 			'text' 		  	=> $rowArray['text'],
	 			'locale' 	  	=> $rowArray['locale'],
	 			'catalogueName' => $rowArray['catalogue_name'],
	 			'isPluralForm' => $rowArray['is_plural_form']
			]);
			$messageEntity->dateCreated  = $rowArray['date_created'];
			$messageEntity->dateModified = $rowArray['date_modified'];
			$messageList[] = $messageEntity;
		}

		return $messageList;
	}

	/**
	 * @return MessageEntity[]
	 */
	public function getLastModifiedList($limit) {
		$rows = $this->dbConnection
					 ->fetchAll("SELECT *
					 			FROM message 
					 			ORDER BY date_modified
					 			LIMIT {$limit}");

		$messageList = [];
		foreach ($rows as $rowArray) {
			$messageEntity = EntityHelper::createEntity(MessageEntity::class,[
	 			'messagePK'   	=> $rowArray['message_pk'],
	 			'identifier'  	=> $rowArray['identifier'],
	 			'text' 		  	=> $rowArray['text'],
	 			'locale' 	  	=> $rowArray['locale'],
	 			'catalogueName' => $rowArray['catalogue_name'],
	 			'isPluralForm' => $rowArray['is_plural_form']
			]);
			$messageEntity->dateCreated  = $rowArray['date_created'];
			$messageEntity->dateModified = $rowArray['date_modified'];
			$messageList[] = $messageEntity;
		}

		return $messageList;
	}
}
