<?php
namespace Radical\Web\Form;
class DatabaseFormElement {
	const TYPES_EXPR = '\\Radical\\Web\\Form\\Database\\Types\\*';
	
	static function get($fromType){
		foreach(\Radical\Core\Libraries::get(self::TYPES_EXPR) as $class){
			if($class::is($fromType)){
				return new $class($fromType);
			}
		}
	}
}