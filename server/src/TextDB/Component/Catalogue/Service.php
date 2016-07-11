<?php

namespace TextDB\Component\Catalogue;

use TextDB\Component\Base\Service as BaseService;
use TextDB\Component\Catalogue\Entity as CatalogueEntity;
use TextDB\Component\Catalogue\Model as CatalogueModel;
use TextDB\Component\Catalogue\ListItemEntity as CatalogueListItemEntity;

/**
* 
*/
class Service extends BaseService
{

	/**
	 * @var CatalogModel
	 */
	protected $catalogueModel;
	
	function __construct($dependencies)
	{
		parent::__construct($dependencies);

		$this->catalogueModel = $this->dependencies['catalogueModel'];
	}

	/**
	 * @param CatalogueEntity $catalogue
	 */
	public function create(CatalogueEntity $catalogue) {
		$this->catalogueModel->createCatalogue($catalogue);
	}

	/**
	 * @param  string $name
	 * @return CatalogueEntity
	 * @throws \Exception 
	 */
	public function get($name) {
		return $this->catalogueModel->getCatalogue($name);
	}

	/**
	 * @return CatalogueListItemEntity[]
	 */
	public function getListItems() {
		return $this->catalogueModel->getCatalogueList();
	}

}