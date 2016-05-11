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

	const EXCEPTION_NULL_CATALOGUE_NAME 	 = 1;

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
		$this->validateCatalogueName($name);
		return $this->catalogueModel->getCatalogue($name);
	}

	public function getList() {
		return $this->catalogueModel->getCatalogueList();
	}

	private function validateCatalogueName($name) {

		switch ($name) {
			case empty($name):
				throw new \Exception("The catalogue name cannot be empty.",self::EXCEPTION_NULL_CATALOGUE_NAME);
				break;

			default:
				break;
		}

	}

}