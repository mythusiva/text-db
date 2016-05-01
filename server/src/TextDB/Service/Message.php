<?php

namespace TextDB\Service;


use TextDB\Service\BaseService;
use TextDB\Entity\Message as MessageEntity;
use TextDB\Model\Message as MessageModel;

/**
* 
*/
class Message extends BaseService
{

	/**
	 * @var MessageModel
	 */
	protected $messageModel;
	
	function __construct($dependencies)
	{
		parent::__construct($dependencies);

		$this->messageModel = $this->dependencies['messageModel'];
	}

	/**
	 * @param  string $name
	 * @return MessageEntity
	 */
	public function get($name) {
		return $this->messageModel->getCatalogue($name);
	}

	public function getList() {
		return $this->messageModel->getMessageList();
	}

}