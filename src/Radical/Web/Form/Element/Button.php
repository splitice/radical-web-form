<?php
namespace Radical\Web\Form\Element;

class Button extends Internal\InputElement {
	function __construct($value = '',$type = 'button'){
		parent::__construct($type,null,$value);
	}
}