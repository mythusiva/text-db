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
		$this->messagePK 	 = $properties->getValue('messagePK',null);
		$this->identifier 	 = $properties->getValue('identifier','');
		$this->text 		 = $properties->getValue('text','');
		$this->locale 		 = $properties->getValue('locale','');
		$this->catalogueName = $properties->getValue('catalogueName',null);
		$this->isPluralForm = $properties->getValue('isPluralForm',0);
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
	 * @var string The catalogue name is a foreign key.
	 */
	public $catalogueName;

	/**
	 * @var int For plural forms value is 1.
	 */
	public $isPluralForm;

}