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

	public function create(MessageEntity $message) {
		return $this->messageModel->createMessage($message);
	}

	public function getList($limit=100) {
		return $this->messageModel->getMessageList($limit);
	}

	public function getByCatalogue($catalogueName) {
		return $this->messageModel->getMessageListByCatalogue($catalogueName);
	}

}