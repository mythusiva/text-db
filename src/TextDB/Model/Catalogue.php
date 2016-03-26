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
 			'cataloguePK' => $row['catalogue_pk'],
 			'catalogueTitle' => $row['name']
		]);
		# Maintained only by the DB triggers.
		$catalogueEntity->dateCreated = $row['date_created'];

		return $catalogueEntity;
	}

}