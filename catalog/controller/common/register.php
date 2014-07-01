<?php  
class ControllerCommonRegister extends Controller {
	public function index() { 
    	
		$this->document->setTitle('注册');
		
		$this->template = 'common/register.tpl';
		$this->children = array(
			'common/footer',
			'common/header'
		);
			
		//render:		
		$this->response->setOutput($this->render());
  	}
	
	public function userRegister(){
		$this->load->model('common/register');
		$activation_code = $this->randstr();
		$this->request->post['activation_code'] = $activation_code;
		$register_id = $this->model_common_register->addUser($this->request->post);
		$message = HTTP_SERVER."index.php?route=common/register3&user=".$register_id."&code=".$activation_code;
		//Send mail: 
		//subject
		$subject = 'Message from U-Save Travel Website';
		//body
		$body = '';
		$body .= '<p><b>请用浏览器打开下面链接激活账号:</b><br/> '.$message.' </p>';
	 	
		$email = $this->request->post['email_f'];
		
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
		else{
			$this->redirect($this->url->link('common/register2',"user=".$register_id.'&status=2'));
		}
	}
	
	public function checkUser(){
		$this->load->model('common/register');
		echo $this->model_common_register->checkUser($this->request->post);
	}
	
	//random string
	public function randstr($len=8) { 
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; 
		// characters to build the password from 
		mt_srand((double)microtime()*1000000*getmypid()); 
		// seed the random number generater (must be done) 
		$password=''; 
		while(strlen($password)<$len) 
		$password.=substr($chars,(mt_rand()%strlen($chars)),1); 
		return $password; 
	}
}
?>