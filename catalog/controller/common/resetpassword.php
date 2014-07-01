<?php  
class ControllerCommonResetpassword extends Controller {
	public function index() { 
    	
		$this->document->setTitle('购物篮');
		
		//check if login
		if (!$this->user->isLogged("front")){ 
			$this->redirect($this->url->link('common/login'));
		}
		
		if (isset($this->session->data['warning'])) {
			$this->data['warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		} else {
			$this->data['warning'] = '';
		}
		
		$this->load->model('common/resetpassword');
		
		$this->data['username'] = $this->user->getUsername();
		
		//render:
		$this->template = 'common/resetpassword.tpl';
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	public function resetPassword(){
		$this->load->model('common/resetpassword');
		//check if login
		if (!$this->user->isLogged("front")){ 
			$this->redirect($this->url->link('common/login'));
		}

		if(md5($this->request->post['old_password']) != $this->user->getPassword()){
			$this->session->data['warning'] = '你输入的旧密码不正确';
			$this->redirect($this->url->link('common/resetpassword'));
		}
		
		if($this->request->post['new_password'] != $this->request->post['new_password2']){
			$this->session->data['warning'] = '新密码与重复密码不一样';
			$this->redirect($this->url->link('common/resetpassword'));
		}
		
		$this->user->updatePassword($this->request->post['new_password']);
		$this->session->data['password_f'] = $this->request->post['new_password'];
		$this->user->isLogged();
		$this->session->data['warning'] = '密码修改成功';
		$this->redirect($this->url->link('common/resetpassword'));
	}
	
}
?>