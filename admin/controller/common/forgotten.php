<?php
class ControllerCommonForgotten extends Controller {
	private $error = array();

	public function index() {
	
		$this->document->setTitle('Forgot Password');
		
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

    	
		//render:		
		$this->template = 'common/forgotten.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
								
		$this->response->setOutput($this->render());		
	}

	public function reset(){
		
		//load model
		$this->load->model('common/forgotten');
		
		//Post Email Validate:
		if (!isset($this->request->post['email'])) {
			$this->redirect($this->url->link('common/forgotten'));
		}
		
		$email = $this->request->post['email'];
		
		//Check if there is an account associated with the email
		if($this->model_common_forgotten->getTotalUserInfo($email) != 1){
			$this->session->data['error_warning'] = 'Sorry! There is no account associated with this email!';
			$this->redirect($this->url->link('common/forgotten'));
		}
		
		//retrieve user data
		$userInfo = $this->model_common_forgotten->getUserInfo($email);		
		$userIdInfo = $userInfo['user_id'];
		$passwordInfo = $userInfo['password'];
		
		//Send mail: 
		 
		$this->mail->IsSMTP(); // enable SMTP
		$this->mail->CharSet="UTF-8";
		$this->mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
		$this->mail->SMTPAuth = true; // authentication enabled
		$this->mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$this->mail->Host = "smtp.gmail.com";
		$this->mail->Port = 465; // or 587
		$this->mail->IsHTML(true);
		$this->mail->Username = "webmailingservice@gmail.com";
		$this->mail->Password = "webmailingservice1986";
		$this->mail->SetFrom('webmailingservice@gmail.com','Web Admin Panel Forgot Password');
		$this->mail->Subject = "Forgot Password and Reset";
		$this->mail->Body = '
			<br/><br/><br/>
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
					<td bgcolor="#003A88" height="20" align="center">
						<p style="color:#FFFFFF;font-weight:bold;font-size:16px;">Forgot Password?</p>
					</td>
				</tr>
				<tr>
					<td  height="300" align="center">
						Please click the link below to reset a new password: <br/><br/><br/>
						<a target="_blank" href="http://demo.369usa.com/admin/index.php?route=common/reset&u='.$userIdInfo.'&p='.$passwordInfo.'">
							http://demo.369usa.com/admin/index.php?route=common/reset&u='.$userIdInfo.'&p='.$passwordInfo.'
						</a>
					</td>
				</tr>
				<tr>
					<td bgcolor="#003A88" height="10">
						&nbsp;
					</td>
				</tr>
			</table>
			';
		$this->mail->AddAddress($email);
		if(!$this->mail->Send()){
			echo "Mailer Error: " . $this->mail->ErrorInfo;
			die();
		}
 	
		//render:		
		$this->template = 'common/reset.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
								
		$this->response->setOutput($this->render());	

	}
	
}
?>