<?php
namespace Radical\Web\Form\Database;

use Radical\Database\SQL\Parse\CreateTable\ColumnReference;
use Radical\Web\Form\Element;

class ZZUnknown extends Internal\DatabaseFormElementBase {
	static function is($t){
		return true;
	}
	
	function getFormElement($name,$value,ColumnReference $relation = null){
		if($relation){
			$class = $relation->getTableClass();
			if($class){
				if($class::getAll()->getCount() <= static::MAX_RELATED){
					$options = array();
					foreach($class::getAll() as $o){
						$ov = $o->getSQLField($relation->getColumn());
						$selected = ($ov == $value);
						$n = (string)$o;
						$options[] = new Element\Select\Option($ov,$n,$selected);
					}
					return new Element\SelectBox($name,$options);
				}
			}
		}
		return new Element\TextInput($name,$value);
	}
}