<?php
namespace Radical\Web\Form\Database;

use Radical\Database\SQL\Parse\CreateTable\ColumnReference;
use Radical\Web\Form\Element;

class Enum extends Internal\DatabaseFormElementBase {
	static function is($t){
		return $t instanceof \Radical\Database\SQL\Parse\Types\Enum;
	}
	
	function getFormElement($name, $value, ColumnReference $relation = null){
		$options = array();
		foreach($this->type->getOptions() as $o){
			$selected = ($o == $value);
			$options[] = new Element\Select\Option($o,$o,$selected);
		}
		return new Element\SelectBox($name,$options);
	}
}