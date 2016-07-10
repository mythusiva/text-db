<?php

namespace TextDB\Component\Database;

use TextDB\Utils\Properties;

/**
* 
*/
class Entity
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
	/**
	 * @var string
	 */
	public $driver;
	/**
	 * @var string
	 */
	public $username;
	/**
	 * @var string
	 */
	public $password;
	/**
	 * Not used for sqlite
	 * @var string
	 */
	public $host;
	/**
	 * Used only for sqlite
	 * @var string
	 */
	public $database;
	/**
	 * @var string
	 */
	public $charset;
	/**
	 * @var string
	 */
	public $collation;
	/**
	 * @var bool
	 */
	public $lazy;
	/**
	 * @var array
	 */
	public $options;


}