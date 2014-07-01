<?php  
class ControllerCommonOrderdetail extends Controller {
	public function index() { 
    	
		$this->document->setTitle('个人中心');
		
		//check if login
		if (!$this->user->isLogged("front")){ 
			$this->redirect($this->url->link('common/login'));
		}
		
		$this->data['username'] = $this->user->getUsername();
		
		$this->load->model('common/orderdetail');
		
		$data=array(
			'order_id' => $this->request->get['order_id']
		);
		$orderdetail = $this->model_common_orderdetail->getOrderDetail($data);
		$this->data['orderdetail'] = $orderdetail;
		$accommodation_arr = json_decode(htmlspecialchars_decode($orderdetail['accommodation']),true);
		$accommodation_str = "";
		if($accommodation_arr){
			foreach($accommodation_arr as $key=>$room){
				$accommodation_str .= "房间".($key+1).": ";
				$accommodation_str .= "成人 ".$room[0].", ";
				$accommodation_str .= "小孩 ".$room[1]."; &nbsp;&nbsp;&nbsp;&nbsp;";
			}
		}
		$this->data['orderdetail']['accommodation_str'] = $accommodation_str;
		
		$this->data['order_status'] = array(
			"paid"=>"已付款",
			"unpaid"=>"未付款",
			"cancel"=>"已取消",
			"outdate"=>"已过期"
		);
		
		$data=array(
			"id" => $orderdetail['line']
		);
		$line = $this->model_common_orderdetail->getLine($data);
		$this->data['line'] = $line;
		
		$data=array(
			"id" => $orderdetail['boarding_location']
		);
		$this->data['boardinglocation'] = $this->model_common_orderdetail->getBoardinglocation($data);
		
		//render:
		$this->template = 'common/orderdetail.tpl';
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left'
		);
				
		$this->response->setOutput($this->render());
  	}
	
}
?>