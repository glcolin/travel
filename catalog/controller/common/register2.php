<?php  
class ControllerCommonRegister2 extends Controller {
	public function index() { 
    	
		$this->document->setTitle('注册');
		
		$user_id = 0;
		if(isset($this->request->get['user'])){
			$user_id = $this->request->get['user'];
		}
		
		$message = "邮件发送失败，可能系统繁忙，<a href='./index.php?route=common/register2/sendEmailAgain&user=".$user_id."' style='color:#FF0000;'>重新发送</a>。";
		if(isset($this->request->get['status'])){
			if($this->request->get['status']==1){
				$message = "激活邮件已经发送，请登陆你的申请邮箱进行激活。";
			}	
		}
		
		$this->data['message'] = $message;
		
		$this->template = 'common/register2.tpl';
		$this->children = array(
			'common/footer',
			'common/header'
		);
			
		//render:		
		$this->response->setOutput($this->render());
  	}
	
	public function sendEmailAgain(){
	
		if(isset($this->request->get['user'])){
			$this->load->model('common/register2');
			$userInfo = $this->model_common_register2->getUser($this->request->get['user']);
			$message = HTTP_SERVER."index.php?route=common/register3&user=".$userInfo['user_id']."&code=".$userInfo['activation_code'];
			//Send mail: 
			//subject
			$subject = 'Message from U-Save Travel Website';
			//body
			$body = '';
			$body .= '<p><b>请用浏览器打开下面链接激活账号:</b><br/> '.$message.' </p>';
		 
		 	$email = $userInfo['email'];
		 	
			//call phpmailer
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
			$this->mail->SetFrom('webmailingservice@gmail.com','U-Save trip');
			$this->mail->Subject = $subject;
			$this->mail->Body = $body;
			$this->mail->AddAddress($email);
			if($this->mail->Send()){
				$this->redirect($this->url->link('common/register2','status=1'));
			}
			
		}
		$this->redirect($this->url->link('common/register2',"user=".$this->request->get['user'].'&status=2'));
	}
	
}
?>