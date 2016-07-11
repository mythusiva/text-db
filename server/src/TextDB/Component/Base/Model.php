<?php

namespace TextDB\Component\Base;

use \Database\Connection;
use \Pimple;
use TextDB\Utils\Properties;

/**
* 
*/
class Model
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

		$this->dbConnection = $this->dependencies['databaseProvider']->getDB();
	}
}
