<?php

namespace TextDB\Component\Base;

use Pimple;

/**
* 
*/
class Service
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