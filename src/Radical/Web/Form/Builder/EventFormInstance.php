<?php
namespace Radical\Web\Form\Builder;
use Radical\Web\Form\Element\HiddenInput;
use Radical\Web\Security\Adapter\ISecurityAdapter;
use Radical\Web\Security\Keys\Key;

class EventFormInstance extends FormInstance {
	const EVENT_HANDLER = '__rp_eventA';
	const EVENT_METHOD = '__rp_eventB';
	
	private $eventHandler;
	private $eventMethod;
	
	private function getSecurityFieldElement(Key $securityField){
		return new HiddenInput($securityField->getField(), $securityField->getId());
	}
	
	function __construct($handler,$method='execute'){
		parent::__construct();
		
		//store even description
		$this->eventHandler = $handler;
		$this->eventMethod = $method;
		
		//Build security field
		/** @var ISecurityAdapter $ks */
		$ks = \Splitice\ResourceFactory::getInstance()->get('event_storage');
		$securityField = $ks->newKey(array($this,'Execute'));

		//Event details
		$this->hidden(self::EVENT_HANDLER,$securityField->Store(@serialize($handler)));
		$this->hidden(self::EVENT_METHOD,base64_encode($securityField->Encrypt($this->eventMethod)));
		
		//Security event
		$this->Add($this->getSecurityFieldElement($securityField));
		
		//Ensure its post, security fields only work on post requests currently.
		$this->method('post');
        if(isset($_SERVER['QUERY_STRING'])) {
            $this->action('?' . $_SERVER['QUERY_STRING']);
        }
	}
	
	function string_before(){
		$this->form->writeEndTag = false;
		$ret = (string)$this->form;
		$this->form->writeEndTag = true;
		return $ret;
	}
	
	function string_after(){
		return '</form>';
	}
	
	function execute($data = null){
		//data from post
		if($data === null){
			$data = Key::getData();
		}
		
		//Clean up event data
		unset($data[self::EVENT_HANDLER],$data[self::EVENT_METHOD]);
		
		//execute event
		return call_user_func(array($this->eventHandler,$this->eventMethod), $data);
	}
}