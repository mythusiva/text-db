<?php

namespace TextDB\Entity;


use TextDB\Utils\Properties;

/**
* 
*/
class Message
{
	/**
	 * @param array
	 */
	function __construct(Properties $properties)
	{
		$this->messagePK 	= $properties->getValue('messagePK',null);
		$this->identifier 	= $properties->getValue('identifier','');
		$this->text 		= $properties->getValue('text','');
		$this->locale 		= $properties->getValue('locale','');
		$this->catalogueFK 	= $properties->getValue('catalogueFK',null);
	}

	/** 
	 * @var int
	 */
	public $messagePK;
	
	/**
	 * @var string
	 */
	public $identifier;

	/**
	 * @var string
	 */
	public $text;

	/**
	 * @var string The language code of the text.
	 */
	public $locale;

	/** 
	 * @var int
	 */
	public $catalogueFK;

}