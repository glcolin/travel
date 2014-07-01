<?php  
class ControllerCommonLogin extends Controller { 
	          
	public function index() { 
    	
		$this->document->setTitle('Login Page');
		
		//Alert and Warning
		if (isset($this->session->data['warning'])) {
			$this->data['warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		} else {
			$this->data['warning'] = '';
		}

		if (isset($this->session->data['success'])) {
    		$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		//Username and password:
		if (isset($this->session->data['username'])) {
			$this->data['username'] = $this->session->data['username'];
		} else {
			$this->data['username'] = '';
		}
		
		if (isset($this->session->data['password'])) {
			$this->data['password'] = $this->session->data['password'];
		} else {
			$this->data['password'] = '';
		}
		
		//render:
		$this->template = 'common/login.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	public function login(){
		//Post Username and Password:
		//print_r($this->request->post);
		if (isset($this->request->post['username'])) {
			$this->session->data['username'] = $this->request->post['username'];
		} else {
			$this->session->data['username'] = '';
		}
		
		if (isset($this->request->post['password'])) {
			$this->session->data['password'] = $this->request->post['password'];
		} else {
			$this->session->data['password'] = '';
		}
		
		//check if login
		if ($this->user->isLogged()){
			$this->redirect($this->url->link('common/home'));
		}else{
			$this->index();
		}
	}

}  
?>