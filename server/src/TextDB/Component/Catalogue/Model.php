<?php 

namespace TextDB\Component\Catalogue;

use TextDB\Component\Base\Model as BaseModel;
use TextDB\Component\Catalogue\Entity as CatalogueEntity;
use TextDB\Utils\EntityHelper;
use TextDB\Component\Catalogue\ListItemEntity as CatalogueListItemEntity;

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
					 ->fetchAll('SELECT c.*, coalesce(count(m.catalogue_name),0) as num_texts
								FROM catalogue c
								LEFT JOIN message m ON c.name = m.catalogue_name
								GROUP BY c.name
								ORDER BY c.date_created DESC');

		$calalogueList = [];
		foreach ($rows as $rowArray) {
			$catalogueListItemEntity = EntityHelper::createEntity(
				CatalogueListItemEntity::class, 
				[
					'catalogueName' => $rowArray['name'],
					'textsCount' => $rowArray['num_texts']	
				]
			);
			$catalogueListItemEntity->dateCreated = $rowArray['date_created'];
			$catalogueList[] = $catalogueListItemEntity;
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

}