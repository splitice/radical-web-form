<?php
namespace Radical\Web\Form\Element\Internal;

use Radical\Utility\HTML\Element;

abstract class FormElementBase extends Element {	
	function __construct($tag,$name){
		parent::__construct($tag,compact('name'));
	}
	
	function toHTML(){
		return (string)$this;
	}
}