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
	 * @param  string $catalogueName
	 */
	function createCatalogue($catalogueName) {
		$data = [
			'name' => $catalogueName
		];

		$this->dbConnection
			->table('catalogue')
			->insertIgnore($data);
	}


	protected function convertToEntity($row) {
		$catalogueEntity = parent::convertToEntity(CatalogueEntity::class,[
 			'catalogueName' => $row['name']
		]);
		# Maintained only by the DB triggers.
		$catalogueEntity->dateCreated = $row['date_created'];

		return $catalogueEntity;
	}

}