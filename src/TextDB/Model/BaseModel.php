<?php

namespace TextDB\Model;


use Database\Connection;
use Pimple;
use TextDB\Utils\Properties;

/**
* 
*/
class BaseModel
{
	/**
	 * @var Pimple
	 */
	protected $dependencies;

	/** 
	 * @var Connection
	 */
	protected $dbConnection;


	function __construct($dependencies)
	{
		$this->dependencies = $dependencies;

		$this->dbConnection = $this->dependencies['storageProvider']->getDB();
	}

	/**
	 * @param  string $entityClass
	 * @param  array $properties
	 * @return class The instance of the entityClass
	 */
	protected function convertToEntity($entityClass,$properties) {
		$propertiesObj = new Properties($properties);
		return new $entityClass($propertiesObj);
	}
}