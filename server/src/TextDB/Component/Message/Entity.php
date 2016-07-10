<?php

namespace TextDB\Component\Message;

use TextDB\Utils\Properties;
use TextDB\Enum\LanguageCodes;

/**
* 
*/
class Entity
{

	const EXCEPTION_EMPTY_IDENTIFIER = 0;
	const EXCEPTION_EMPTY_TEXT = 1;
	const EXCEPTION_EMPTY_LOCALE = 2;
	const EXCEPTION_EMPTY_CATALOGUE_NAME = 3;
	const EXCEPTION_INVALID_LOCALE = 4;
	const EXCEPTION_INVALID_IS_PLURAL_FORM = 5;

	const PLURAL_FORM_OFF = 0;
	const PLURAL_FORM_ON = 1;

	/**
	 * @param array
	 */
	public function __construct(Properties $properties)
	{
		$this->messagePK 	 = $properties->getValue('messagePK',null);
		$this->identifier 	 = $properties->getValue('identifier','');
		$this->text 		 = $properties->getValue('text','');
		$this->locale 		 = $properties->getValue('locale','');
		$this->catalogueName = $properties->getValue('catalogueName',null);
		$this->isPluralForm = $properties->getValue('isPluralForm',self::PLURAL_FORM_OFF);
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

	public function validate() 
	{
		# Check for empty values.
		$this->validateCheckEmptyValues();

		$this->validateLocale();
		$this->validatePluralForm();
	}

	private function validateCheckEmptyValues() {
		if(empty($this->identifier)) {
			throw new \Exception("Field cannot be empty: identifier", self::EXCEPTION_EMPTY_IDENTIFIER);
		}
		if(empty($this->text)) {
			throw new \Exception("Field cannot be empty: text", self::EXCEPTION_EMPTY_TEXT);
		}
		if(empty($this->locale)) {
			throw new \Exception("Field cannot be empty: locale", self::EXCEPTION_EMPTY_LOCALE);
		}
		if(empty($this->catalogueName)) {
			throw new \Exception("Field cannot be empty: catalogueName", self::EXCEPTION_EMPTY_CATALOGUE_NAME);
		}
	}

	private function validateLocale() {
		if(!LanguageCodes::exists($this->locale)) {
			$allowedValues = implode(',', LanguageCodes::getAll());
			throw new \Exception(
			  "Provided locale is invalid. Allowed values are: {$allowedValues}", 
				self::EXCEPTION_INVALID_LOCALE
			);
		}
	}

	private function validatePluralForm() {
		$allowedValues = [self::PLURAL_FORM_OFF,self::PLURAL_FORM_ON];
		if(!in_array($this->isPluralForm, $allowedValues)) {
				$allowedValuesStr = implode(',', $allowedValues);
				throw new \Exception(
					"Provided isPluralForm is invalid. Allowed values are: {$allowedValuesStr}", 
					self::EXCEPTION_INVALID_IS_PLURAL_FORM
				);
		}
	}

}
