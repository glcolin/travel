<?php   
class ControllerCommonHome extends Controller {   
	public function index() {
	 
		$this->document->setTitle('Admin Home');
		
		$this->load->model('common/home');
		
		$this->data['latest_users'] = $this->model_common_home->getLatesetUsers();
		
		$this->data['latest_orders'] = $this->model_common_home->getLatesetOrders();
		
		$this->data['order_status'] = array(
			"paid"=>"已付款",
			"unpaid"=>"未付款",
			"cancel"=>"已取消",
			"outdate"=>"已过期"
		);
		
		$this->template = 'common/home.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	public function login() {
		
	}
	
}
?>