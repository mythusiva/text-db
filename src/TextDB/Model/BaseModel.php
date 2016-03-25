<?php

/**
* 
*/
class BaseModel
{

	protected $dbConnection;
	
	function __construct(StorageProvider $storageProvider)
	{
		$this->dbConnection = $storageProvider->getDB;
	}
}