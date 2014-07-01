<?php   
class ControllerCommonReset extends Controller {  
 
	public function index() {
	 
		$this->document->setTitle('Forgot and Reset Password');
		
		//Load Model
		$this->load->model('common/forgotten');
		
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
		
		//check if GET isset
		if(!isset($this->request->get['u']) || !isset($this->request->get['p'])){
			die('<h2>ACCESS DENIED!</h2>');
		}
		
		//set variables
		$id = $this->request->get['u'];
		$password = $this->request->get['p'];
		
		//Check if there is an account associated with the id and password
		if($this->model_common_forgotten->getTotalUserInfoByIDandPassword($id,$password) != 1){
			die('<h2>ACCESS DENIED OR YOUR RESET URL HAS EXPIRED!</h2>');
		}
		
		//Set Data
		$this->data['id'] = $id;
		$this->data['password'] = $password;
		
		//render
		$this->template = 'common/resetpassword.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	public function reset() {
	
		//Load Model
		$this->load->model('common/forgotten');
	
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){
		
			//retrieve POST vars
			$id = $this->request->post['userID'];
			$oldpassword = $this->request->post['oldpassword'];
			$newpassword = $this->request->post['newpassword'];
			$newpassword2 = $this->request->post['newpassword2'];
			
			//Check if there is an account associated with the id and password
			if($this->model_common_forgotten->getTotalUserInfoByIDandPassword($id,$oldpassword) != 1){
				die('<h2>ACCESS DENIED OR YOUR RESET URL HAS EXPIRED!</h2>');
			}
				
			//Check if passwords match
			if( $newpassword != $newpassword2 ){
				$this->session->data['error_warning'] = 'Passwords are not matched!';
				$this->redirect($this->url->link('common/reset','u='.$id.'&p='.$oldpassword));
			}
			
			//Check if only alphbet and digits in password
			if(!ctype_alnum($newpassword)){
				$this->session->data['error_warning'] = 'Password can only contain letters and digits!';
				$this->redirect($this->url->link('common/reset','u='.$id.'&p='.$oldpassword));
			}
			
			//Check if password's length greater or equal to  6
			if(!(strlen($newpassword) >= 6)){
				$this->session->data['error_warning'] = 'Password\'s length must be at least 6!';
				$this->redirect($this->url->link('common/reset','u='.$id.'&p='.$oldpassword));
			}
		
			//Update Password
			$this->model_common_forgotten->updatePassword($id,$oldpassword,$newpassword);
			$this->session->data['success'] = 'Password has been successfully changed!';
			
		}
		
		//return page
		$this->redirect($this->url->link('common/login'));
		
	}
	
}
?>