<?php

namespace TextDB\Model;


use TextDB\Model\BaseModel;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Catalogue as CatalogueEntity;
use TextDB\Model\Catalogue as CatalogueModel;
use TextDB\Model\Message as MessageModel;

/**
* 
*/
class CatalogueMessage extends BaseModel
{

	/**
	 * @var CatalogueModel
	 */
	protected $catalogueModel;

	/**
	 * @var MessageModel
	 */
	protected $messageModel;
	
	function __construct($dependencies)
	{
		parent::__construct($dependencies);

		$this->catalogueModel = $this->dependencies['catalogueModel'];
		$this->messageModel = $this->dependencies['messageModel'];
	}

	/**
	 * @param  string $identifier
	 * @param  string $text
	 * @param  string $locale
	 * @param  string $catalogueName
	 */
	public function createMessage($identifier,$text,$locale,$catalogueName) {
		$data = [
			'identifier' => $identifier,
			'text' => $text,
			'locale' => $locale,
			'catalogue_fk' => $catalogueFK
		];
		$this->dbConnection
			 ->table('message')
			 ->insertIgnore($data);
	}

	function getCatalogueMessages(CatalogueEntity $catalogue) {

		$catalogueFK = $catalogue->cataloguePK;

		$rows = $this->dbConnection
			 ->table('message')
			 ->where('catalogue_fk', '=', $catalogueFK)
			 ->get();

		$listOfMessages = [];

		foreach ($rows as $row) {
			
			$listOfMessages[] = $this->messageModel->convertToEntity($row);

		}

		return $listOfMessages;
	}

	private function getCatalogueFK($catalogueName) {
		/**
		 * @var CatalogueEntity
		 */
		$catalogueEntity = $this->catalogueModel->getCatalogue($catalogueName);
		return $catalogueEntity->cataloguePK;
	}

}