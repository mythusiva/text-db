<?php 

namespace TextDB\Model;


use TextDB\Model\BaseModel;
use TextDB\Entity\Catalogue as CatalogueEntity;

/**
* 
*/
class Catalogue extends BaseModel
{

	function __construct($dependencies)
	{
		parent::__construct($dependencies);
	}

	/**
	 * @param  string $catalogueName
	 * @return bool
	 */
	function createCatalogue($catalogueName) {
		$data = [
			'name' => $catalogueName
		];

		$this->dbConnection->table('catalogue')->insertIgnore($data);
		return true;
	}

}