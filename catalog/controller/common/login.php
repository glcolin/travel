<?php  
class ControllerCommonLogin extends Controller {
	public function index() { 
    	
		$this->document->setTitle('登陆');
		
		//check if login
		$this->data['isLogged'] = 0 ;
		if ($this->user->isLogged("front")){
			$this->session->data['success'] = "Hi,".$this->session->data['username_f'];
			$this->data['isLogged'] = 1;
		}else{
			$this->session->data['password_f'] = "";
		}
		
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
		if (isset($this->session->data['username_f'])) {
			$this->data['username_f'] = $this->session->data['username_f'];
		} else {
			$this->data['username_f'] = '';
		}
		
		if (isset($this->session->data['password_f'])) {
			$this->data['password_f'] = $this->session->data['password_f'];
		} else {
			$this->data['password_f'] = '';
		}

		if(isset($_SERVER['HTTP_REFERER']) && $this->data['warning']==''){
			$this->session->data['backurl'] = $_SERVER['HTTP_REFERER'];
		}	
		
		$this->template = 'common/login.tpl';
		$this->children = array(
			'common/footer',
			'common/header'
		);
			
		//render:		
		$this->response->setOutput($this->render());
  	}
	
	public function login(){
		//Post Username and Password:
		if (isset($this->request->post['username_f'])) {
			$this->session->data['username_f'] = $this->request->post['username_f'];
		} else {
			$this->session->data['username_f'] = '';
		}
		
		if (isset($this->request->post['password_f'])) {
			$this->session->data['password_f'] = $this->request->post['password_f'];
		} else {
			$this->session->data['password_f'] = '';
		}
		
		//check if login
		if ($this->user->isLogged("front")){ 
			$this->session->data['success'] = "Hi,".$this->session->data['username_f'];
			//$this->redirect($this->url->link('common/login'));
			if(isset($this->session->data['backurl'])){
				$this->redirect($this->session->data['backurl']);
			}
			else{
				$this->index();
			}
		}else{
			$this->index();
		}
	}
}
?>