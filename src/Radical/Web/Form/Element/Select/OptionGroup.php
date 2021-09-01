<?php
namespace Radical\Web\Form\Element\Select;

use Radical\Utility\HTML\Element;

class OptionGroup extends Element {
	function __construct($label, $inner = array()){
		parent::__construct('optgroup', $inner);
		$this->attributes['label'] = $label;
	}

	function setSelected($state){
		foreach($this->inner as $o){
			$o->setSelected($state);
		}
	}
}