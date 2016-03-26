<?php

namespace TextDB\Entity;


use TextDB\Utils\Properties;

/**
* 
*/
class Database
{

	/**
	 * @param array
	 */
	function __construct(Properties $properties)
	{
		$this->driver 		= $properties->getValue('driver',null);
		$this->username 	= $properties->getValue('username',null);
		$this->password 	= $properties->getValue('password',null);
		$this->host 		= $properties->getValue('host','');
		$this->database 	= $properties->getValue('database','');
		$this->charset 		= $properties->getValue('charset','utf8');
		$this->collation 	= $properties->getValue('collation','utf8_unicode_ci');
		$this->lazy 		= $properties->getValue('lazy',true);
		$this->options 		= $properties->getValue('options',[]);
	}

	public $driver;
	public $username;
	public $password;
	public $host; # not for sqlite
	public $database; # database path for sqlite
	public $charset;
	public $collation;
	public $lazy;
	public $options;

}