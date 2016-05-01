<?php

namespace TextDB\Service;


use Pimple;

/**
* 
*/
class BaseService
{
	
	/**
	 * @var Pimple
	 */
	protected $dependencies;

	function __construct($dependencies)
	{
		$this->dependencies = $dependencies;
	}

}