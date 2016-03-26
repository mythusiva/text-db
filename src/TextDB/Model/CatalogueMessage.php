<?php

namespace TextDB\Model;


use TextDB\Model\BaseModel;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Catalogue as CatalogueEntity;
use TextDB\Model\Catalogue as CatalogueModel;

/**
* 
*/
class CatalogueMessage extends BaseModel
{

	/**
	 * @var CatalogueModel
	 */
	protected $catalogueModel;
	
	function __construct($dependencies)
	{
		parent::__construct($dependencies);

		$this->catalogueModel = $this->dependencies['catalogueModel'];
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
			'catalog_fk' => $catalogFK
		];
		$this->dbConnection
			 ->table('message')
			 ->insertIgnore($data);
	}

	function getCatalogueMessages(CatalogueEntity $catalogue) {

	}

	private function getCatalogueFK($catalogueName) {
		/**
		 * @var CatalogueEntity
		 */
		$catalogueEntity = $this->catalogueModel->getCatalogue($catalogueName);
		return $catalogueEntity->cataloguePK;
	}
}