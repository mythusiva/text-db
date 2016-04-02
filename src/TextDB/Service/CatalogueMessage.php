<?php

namespace TextDB\Service;


use TextDB\Service\BaseService;
use TextDB\Model\Catalogue as CatalogueModel;
use TextDB\Model\Message as MessageModel;
use TextDB\Model\CatalogueMessage as CatalogueMessageModel;
use TextDB\Entity\Catalogue as CatalogueEntity;
use TextDB\Entity\Message as MessageEntity;
use TextDB\Utils\Properties;

/**
* 
*/
class CatalogueMessage extends BaseService
{
	/**
	 * @var MessageModel
	 */
	protected $messageModel;	
	/**
	 * @var CatalogueModel
	 */
	protected $catalogueModel;

	/** @var CatalogueMessageModel */
	protected $catalogueMessageModel;

	function __construct($dependencies)
	{
		parent::__construct($dependencies);

		$this->messageModel = $this->dependencies['messageModel'];
		$this->catalogueModel = $this->dependencies['catalogueModel'];
		$this->catalogueMessageModel = $this->dependencies['catalogueMessageModel'];
	}
	
	function createCatalogueMessage($catalogueName,$identifier,$text,$locale) {
		/** @var CatalogueEntity */
		$catalogueEntity = $this->catalogueModel->getCatalogue($catalogueName);

		$messageProperties = new Properties([
   			'identifier' => $identifier,
   			'text' => $text,
   			'locale' => $locale,
   			'catalogueFK' => $catalogueEntity->cataloguePK
		]);
		$messageEntity = new MessageEntity($messageProperties);

		$this->messageModel->createMessage($messageEntity);
	}

	function getCatalogueMessages($catalogueName) {
		$catalogueEntity = $this->catalogueModel->getCatalogue($catalogueName);

		$listOfMessages = $this->catalogueMessageModel->getCatalogueMessages($catalogueEntity);

		return $listOfMessages;
	}
}