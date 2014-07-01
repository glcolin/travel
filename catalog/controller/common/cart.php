<?php  
class ControllerCommonCart extends Controller {
	public function index() { 
    	
		$this->document->setTitle('购物篮');
		
		//check if login
		if (!$this->user->isLogged("front")){ 
			$this->redirect($this->url->link('common/login'));
		}
		
		$this->load->model('common/cart');
		
		$data=array(
			'user_id' => $this->user->getUserId()
		);
		$user_unpaid_orders = $this->model_common_cart->getUserUnpaidOrders($data);
		
		$this->data['orders'] = array();
		
		$this->data['integral'] = $this->user->getIntegral();
		
		$this->data['custom'] = '0|'.$this->user->getUserId();
		
		$attractions = $this->model_common_cart->getAttractions();
		$this->data['attractions'] = $attractions; 
		$this->data['fromcitys'] = $this->model_common_cart->getFromcitys();
		$this->data['endcitys'] = $this->model_common_cart->getEndcitys();
		$i=0;
		foreach($user_unpaid_orders as $user_unpaid_order){
			if(date('Y-m-d',strtotime($user_unpaid_order['departure_date'])) >= date('Y-m-d')){
				$this->data['custom'] .= ",".$user_unpaid_order['id'];
				//order
				$this->data['orders'][$i]['order_detail'] = $user_unpaid_order;
				$accommodation_arr = json_decode(htmlspecialchars_decode($user_unpaid_order['accommodation']),true);
				$accommodation_str = "";
				if($accommodation_arr){
					foreach($accommodation_arr as $key=>$room){
						$accommodation_str .= "房间".($key+1).": ";
						$accommodation_str .= "成人 ".$room[0].", ";
						$accommodation_str .= "小孩 ".$room[1]."; &nbsp;&nbsp;&nbsp;&nbsp;";
					}
				}
				$this->data['orders'][$i]['order_detail']['accommodation_str'] = $accommodation_str;
				
				//line
				$data=array(
					"id" => $user_unpaid_order['line']
				);
				$line = $this->model_common_cart->getLine($data);
				$this->data['orders'][$i]['line_detail'] = $line;

				$main_attractions = $line['main_attractions']?json_decode($line['main_attractions']):array();
				$main_attractions_str = "";
				foreach($main_attractions as $main_attraction){
					if(isset($attractions[$main_attraction])){
						if($main_attractions_str != ""){
							$main_attractions_str .= " , ";
						}    
						$main_attractions_str .= $attractions[$main_attraction];
					}    
				}
				$this->data['orders'][$i]['main_attractions_str'] = $main_attractions_str;
				
				$i++;
			}
		}
		$this->data['order_status'] = array(
			"paid"=>"已付款",
			"unpaid"=>"未付款",
			"cancel"=>"已取消",
			"outdate"=>"已过期"
		);
		
		//render:
		$this->template = 'common/cart.tpl';
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	public function deleteOrder(){
		$this->load->model('common/cart');
		$data=array(
			"id" => $this->request->post['order_id']
		);
		$this->model_common_cart->deleteOrder($data);
	}
	
}
?>