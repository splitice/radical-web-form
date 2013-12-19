<?php
namespace Radical\Web\Form\Element;

class CheckBox extends Internal\InputElement {
	function __construct($name,$value,$checked){
		parent::__construct('checkbox',$name,$value);
		if($checked == true){
			$this->attributes['checked'] = 'checked';
		}
	}
}