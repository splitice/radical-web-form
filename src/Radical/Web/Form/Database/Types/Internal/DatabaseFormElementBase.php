<?php
namespace Radical\Web\Form\Database\Internal;

class DatabaseFormElementBase {
	protected $type;
	
	function __construct($type){
		$this->type = $type;
	}
}