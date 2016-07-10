<?php

namespace TextDB\Component\Message;

use TextDB\Component\Base\Service as BaseService;
use TextDB\Component\Message\Entity as MessageEntity;
use TextDB\Component\Message\Model as MessageModel;

/**
* 
*/
class Service extends BaseService
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
		$message->validate();
		return $this->messageModel->createMessage($message);
	}

	public function getList($limit=100) {
		return $this->messageModel->getMessageList($limit);
	}

	public function getByCatalogue($catalogueName) {
		return $this->messageModel->getMessageListByCatalogue($catalogueName);
	}

}