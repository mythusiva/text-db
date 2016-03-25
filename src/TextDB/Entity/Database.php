<?php

namespace TextDB\Entity;

/**
* 
*/
class Database
{

	public $driver;
	public $username = null;
	public $password = null;
	public $host = ''; # not for sqlite
	public $database = ''; # database path for sqlite
	public $charset = 'utf8';
	public $collation = 'utf8_unicode_ci';
	public $lazy = true;
	public $options = [];

}