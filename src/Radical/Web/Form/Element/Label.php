<?php
namespace Radical\Web\Form\Element;

use Radical\Utility\HTML\Element;

class Label extends Element {
	protected $name;
	protected $element;
	protected $before;

	function __construct($name,Internal\FormElementBase $element, $before = false){
		$this->element = $element;
        $this->before = $before;
		
		if($element instanceof CheckBox){
			$element->html_override('');
		}
		
		//set for
		$attributes = array(); 
		if(isset($element->attributes['id'])){
			$attributes['for'] = &$element->attributes['id'];
		}else{
			$id = md5($name);
			$element->attributes['id'] = $id;
			$attributes['for'] = &$element->attributes['id']; 
		}
		
		parent::__construct('label',$attributes,$name);
	}
	
	function __toString(){
		if($this->element instanceof CheckBox){
			$this->element->html_override(null);

			$inner = $this->inner;
            if($this->before){
                $this->inner = (string)$this->element. $this->inner;
            }else{
			    $this->inner .= (string)$this->element;
            }

			$this->element->html_override('');
			
			$ret = parent::__toString();

			$this->inner = $inner;
			
			return $ret;
		}
		
		return parent::__toString();
	}
}