<?php  
class ControllerCommonPersonalcenter extends Controller {
	public function index() { 
    	
		$this->document->setTitle('购物篮');
		
		//check if login
		if (!$this->user->isLogged("front")){ 
			$this->redirect($this->url->link('common/login'));
		}
		
		$this->load->model('common/personalcenter');
		
		$data=array(
			'user_id' => $this->user->getUserId()
		);
		$user_paid_orders = $this->model_common_personalcenter->getUserPaidOrders($data);
		
		$this->data['orders'] = $user_paid_orders;
		
		foreach($user_paid_orders as $key=>$user_paid_order){
				//line
				$data=array(
					"id" => $user_paid_order['line']
				);
				$line = $this->model_common_personalcenter->getLine($data);
				$this->data['orders'][$key]['line_title'] = $line['title'];			
		}
		
		$this->data['username'] = $this->user->getUsername();
		
		//render:
		$this->template = 'common/personalcenter.tpl';
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	
}
?>