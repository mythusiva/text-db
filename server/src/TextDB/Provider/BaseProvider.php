<?php

namespace TextDB\Provider;


use Pimple;

/**
* 
*/
class BaseProvider
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