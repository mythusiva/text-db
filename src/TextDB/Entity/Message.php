<?php

namespace TextDB\Entity;


/**
* 
*/
class Message
{
	/** 
	 * @var int
	 */
	protected $messagePK;
	
	/**
	 * @var string
	 */
	protected $identifier;

	/**
	 * @var string
	 */
	protected $text;


	/**
	 * @var string The language code of the text.
	 */
	protected $locale;

	/** 
	 * @var int
	 */
	protected $catalogueFK;

}