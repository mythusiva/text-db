<?php

namespace TextDB\Provider;


use TextDB\Entity\Database as DatabaseConfig;
use \Database\Connectors\ConnectionFactory;
use Database\Connection;

/**
* 
*/
class Storage extends BaseProvider
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