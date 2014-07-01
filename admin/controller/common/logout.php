<?php       
class ControllerCommonLogout extends Controller {   
	public function index() { 
    	$this->user->logout();

		$this->redirect($this->url->link('common/login'));
  	}
}  
?>