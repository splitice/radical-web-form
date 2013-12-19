<?php
namespace Radical\Web\Form\Builder\Internal;

use Radical\Basic\Arr\Object\CollectionObject;

class FormRow extends CollectionObject {
	function toHTML(){
		$ret = '<div class="row">';
		foreach($this->data as $r){
			$ret .= $r->toHTML();
		}
		return $ret.'</div>';
	}
}