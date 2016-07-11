<?

namespace TextDB\Utils;

/**
* 
*/
class EntityHelper
{
	/**
	 * @param  string $entityClass
	 * @param  array $properties
	 * @return class The instance of the entityClass
	 */
	public static function createEntity($entityClass,$properties) {
		$propertiesObj = new Properties($properties);
		return new $entityClass($propertiesObj);
	}	
}