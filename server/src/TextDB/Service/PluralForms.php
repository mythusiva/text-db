<?

namespace TextDB\Service;

use TextDB\Service\BaseService;
use TextDB\Enum\PluralForms as PluralFormsEnum;

/**
* 
*/
class PluralForms extends BaseService
{
	/* Create a locale entity here after... */
	protected $baseLocale;
	
	public function __construct($dependencies)
	{
		$this->baseLocale = $dependencies['settings']['defaultLocale'];

		parent::__construct();
	}


}