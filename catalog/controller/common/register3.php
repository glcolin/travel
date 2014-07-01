<?php  
class ControllerCommonRegister3 extends Controller {
	public function index() { 
    	
		$this->document->setTitle('注册');
		
		$message = "";
		
		if(isset($this->request->get['user']) && isset($this->request->get['code'])){
			$this->load->model('common/register3');
			$activation_code = $this->model_common_register3->getActivationCode($this->request->get['user']);
			if($this->request->get['code'] == $activation_code['activation_code']){
				$this->model_common_register3->setUserStatus($this->request->get['user']);
				$message = "账号激活成功，请<a href='./index.php?route=common/login' style='color:#0000FF'>登陆</a>进行订购。";
			}
		}
		
		if(!$message){
			$this->redirect($this->url->link('common/register2','status=1'));
		}
		
		$this->data['message'] = $message;

		$this->template = 'common/register3.tpl';
		$this->children = array(
			'common/footer',
			'common/header'
		);
			
		//render:		
		$this->response->setOutput($this->render());
  	}
}
?>