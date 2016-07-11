<?php 

namespace TextDB\Component\Catalogue;

use TextDB\Component\Base\Model as BaseModel;
use TextDB\Component\Catalogue\Entity as CatalogueEntity;

/**
* 
*/
class Model extends BaseModel
{

	function __construct($dependencies)
	{
		parent::__construct($dependencies);
	}

	function getCatalogue($catalogueName) {

		$row = $this->dbConnection
					->table('catalogue')
					->where('name','=',$catalogueName)
					->first();

		return $this->convertToEntity($row);
	}

	function getCatalogueList() {
		$rows = $this->dbConnection
					 ->table('catalogue')
					 ->get();

		$calalogueList = [];
		foreach ($rows as $rowArray) {
			$catalogueList[] = $this->convertToEntity($rowArray);
		}

		return $catalogueList;
	}

	/**
	 * @param  CatalogueEntity $catalogue
	 */
	function createCatalogue(CatalogueEntity $catalogue) {
		$data = [
			'name' => $catalogue->catalogueName,
			'date_created' => date(MYSQL_DATETIME_FORMAT)
		];

		$this->dbConnection
			->table('catalogue')
			->insertIgnore($data);
	}


	protected function convertToEntity($row) {
		$catalogueEntity = parent::convertToEntity(CatalogueEntity::class,[
 			'catalogueName' => $row['name']
		]);
		$catalogueEntity->dateCreated = $row['date_created'];

		return $catalogueEntity;
	}

}