<?php
namespace Radical\Web\Form\Element;

use Radical\Web\Form\Element\Select\Option;
use Radical\Web\Form\Element\Select\OptionGroup;

class SelectBox extends Internal\FormElementBase {
	public function setValue($value) {
		if(is_array($value)){
			$this->inner = $value;
		}else{
			$this->setSelected($this->inner, $value);
		}
	}
	function __construct($name,$options = array(), $selected = null){
		parent::__construct('select',$name);
		$this->inner = $options;
		if($selected !== null){
			$this->setSelected($this->inner, $selected);
		}
	}

	/**
	 * @param $value
	 */
	private function setSelected($search, $value)
	{
		foreach ($search as $v) {
			if ($v instanceof Option) {
				if ($v->getValue() == $value) {
					foreach ($this->inner as $vc) {
						$vc->setSelected(false);
					}
					$v->setSelected(true);
					break;
				}
			}else if($v instanceof OptionGroup){
				$this->setSelected($v->inner, $value);
			}
		}
	}
}
