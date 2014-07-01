<?php   
class ControllerToolReset extends Controller {  
 
	public function index() {
	 
		$this->document->setTitle('Reset Password');
		
		//Alert and Warning
		if (isset($this->session->data['error_warning'])) {
			$this->data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
    		$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		//render
		$this->template = 'tool/reset.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	public function reset() {
	
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){
		
			//retrieve POST vars
			$oldPassword = $this->request->post['oldpassword'];
			$newpassword = $this->request->post['newpassword'];
			$newpassword2 = $this->request->post['newpassword2'];
			
			//Check if Old password is correct
			if( md5($oldPassword) != $this->user->getPassword()){
				$this->session->data['error_warning'] = 'Incorrect Password';
				$this->redirect($this->url->link('tool/reset'));
			}
			
			//Check if passwords match
			if( $newpassword != $newpassword2 ){
				$this->session->data['error_warning'] = 'Passwords are not matched!';
				$this->redirect($this->url->link('tool/reset'));
			}
			
			//Check if only alphbet and digits in password
			if(!ctype_alnum($newpassword)){
				$this->session->data['error_warning'] = 'Password can only contain letters and digits!';
				$this->redirect($this->url->link('tool/reset'));
			}
			
			//Check if password's length greater or equal to  6
			if(!(strlen($newpassword) >= 6)){
				$this->session->data['error_warning'] = 'Password\'s length must be at least 6!';
				$this->redirect($this->url->link('tool/reset'));
			}
		
			//Update Password
			$this->user->updatePassword($newpassword);
			$this->session->data['success'] = 'Password has been successfully changed!';
			
		}
		
		//return page
		$this->redirect($this->url->link('tool/reset'));
		
	}
	
}
?>