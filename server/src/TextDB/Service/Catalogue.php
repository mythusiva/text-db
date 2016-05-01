<?php

namespace TextDB\Service;


use TextDB\Service\BaseService;
use TextDB\Entity\Catalogue as CatalogueEntity;
use TextDB\Model\Catalogue as CatalogueModel;

/**
* 
*/
class Catalogue extends BaseService
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
	 */
	public function get($name) {
		return $this->catalogueModel->getCatalogue($name)
	}

}