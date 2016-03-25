<?php

namespace TextDB\Entity;


/**
* 
*/
class Message
{
	
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

}