<?php
namespace TextDB\Providers;


require __DIR__ . '/../../..' . '/vendor/autoload.php';


use TextDB\Entity\Database as DatabaseConfig;
use \Database\Connectors\ConnectionFactory;

/**
* A single database storage provider. This will be responsible
* for setting up a database if the database doesnt exist.
* Also getting data from said database.
*/
class Storage
{

	/** @var DatabaseConfig */
	private $dbConfiguration;

	private $dbConnection;
	
	function __construct(DatabaseConfig $dbConfig)
	{
		$this->dbConfiguration = $dbConfig;
		$this->connectToDB();
	}

	private function connectToDB() {
		$factory = new ConnectionFactory();
		$this->dbConnection = $factory->make((array)$this->dbConfiguration);
	}


	function getDB() {
		return $this->dbConnection;
	}
}