<?php

namespace TextDB\Model;


use Database\Connection;
use Pimple;

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
}