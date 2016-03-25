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

	function __construct(StorageProvider $storage)
	{
		$this->__construct($storage);
	}

	public function createMessage(MessageEntity $message) {
		$data = (array) $message;
		$this->dbConnection->table('message')->insertIgnore($data);
	}

}