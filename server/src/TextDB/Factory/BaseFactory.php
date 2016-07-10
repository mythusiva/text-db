<?php

namespace TextDB\Factory;


use Pimple;

/**
* 
*/
class BaseFactory
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