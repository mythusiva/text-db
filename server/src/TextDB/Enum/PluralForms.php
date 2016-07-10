<?php

namespace TextDB\Enum;

use CommerceGuys\Enum\AbstractEnum;

class PluralForms use AbstractEnum 
{
	const ZERO = 'zero';
	const ONE = 'one';
	const TWO = 'two';
	const FEW = 'few';
	const MANY  = 'many';
	const OTHER = 'other';
}