<?php

namespace TextDB\Component\Catalogue;


use TextDB\Service\BaseService;
use TextDB\Component\Catalogue\Entity as CatalogueEntity;
use TextDB\Component\Catalogue\Model as CatalogueModel;

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
	 * @param string $name
	 */
	public function create($name) {

		$this->catalogueModel->createCatalogue($name);

		$catalogue = $this->catalogueModel->getCatalogue($name);
	}

	/**
	 * @param  string $name
	 * @return CatalogueEntity
	 * @throws \Exception 
	 */
	public function get($name) {
		return $this->catalogueModel->getCatalogue($name);
	}

	public function getList() {
		return $this->catalogueModel->getCatalogueList();
	}

}