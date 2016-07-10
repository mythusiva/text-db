<?php

namespace TextDB\Component\Database;

use TextDB\Provider\BaseProvider;
use TextDB\Component\Database\Entity as DatabaseConfig;
use \Database\Connectors\ConnectionFactory;
use \Database\Connection;

/**
* 
*/
class Provider extends BaseProvider
{

	/** 
	 * @var DatabaseConfig
	 */
	private $dbConfiguration;

	/**
	 * @var Connection
	 */
	private $dbConnection;

	function __construct($dependencies)
	{
		parent::__construct($dependencies);

		$this->dbConfiguration = $this->dependencies['databaseEntity'];

		$this->connectToDB();
	}

	private function connectToDB() {
		$factory = new ConnectionFactory();
		$this->dbConnection = $factory->make((array)$this->dbConfiguration);
	}

	/**
	 * @return Connection
	 */
	function getDB() {
		return $this->dbConnection;
	}
}