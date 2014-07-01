<?php 
class ControllerCommonHeader extends Controller {
	protected function index() {
	
		$this->data['title'] = $this->document->getTitle(); 
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		
		$this->template = 'common/header.tpl';
		
		//login or not
		$this->data['login'] = 0;
		if ($this->user->isLogged()){
			$this->data['login'] = 1;
			$this->data['login_username'] = $this->user->getUsername();
		}
		
		$this->render();
	}
}
?>