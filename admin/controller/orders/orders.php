<?php 
class ControllerOrdersOrders extends Controller {
     
  	public function index() {
		$this->document->setTitle("订单管理");

		$this->load->model('orders/orders');

		$this->getList();
		
  	}
	
	protected function getList() {	
		
		//Alert and Warning
		if (isset($this->session->data['warning'])) {
			$this->data['warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		} else {
			$this->data['warning'] = '';
		}

		if (isset($this->session->data['success'])) {
    		$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$filter_number = "";
		if (isset($this->request->get['filter_number'])) {
			$filter_number = $this->request->get['filter_number'];
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		$limit = 30;
		
		$this->data['filter_number'] = $filter_number;
		$data = array(
			'filter_number' => $filter_number,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
		$orders=$this->model_orders_orders->getTotalOrders($data);
		$data = array(
			'filter_number' => $filter_number
		);
		$orders_total=$this->model_orders_orders->getTotalOrders($data);
		$items_count=count($orders_total);
		
		//pagination
		$route = $this->request->get['route'];
		
		$pagination = new Pagination();
		$pagination->total = $items_count;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link($route, 'filter_number='.$filter_number.'&page={page}');
		$this->data['pagination'] = $pagination->render();
		
		$this->data['orders'] = array();
		
		foreach ($orders as $order) {
			$sort_default[]=$order['id'];
			
			$action = array();
			
			$action[] = array(
				'text' => 'View',
				'href' => $this->url->link('orders/orders/edit', '&id=' . $order['id'])
			);
			
			$this->data['orders'][$order['id']]=array(
				"info" => $order,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('orders/orders/addnew');	
		$this->data['delete'] = $this->url->link('orders/orders/delete');	
		
		//render:
		$this->template = 'orders/orders_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	/*public function saveSort(){
		$this->load->model('orders/orders');
		$this->model_orders_orders->saveSort($this->request->post);
	}	*/
	
	
	public function edit() {
    	//$this->language->load('orders/orders');

    	$this->document->setTitle("订单管理");
		
		$this->load->model('orders/orders');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_orders_orders->editOrder($this->request->get['id'], $this->request->post);
			
			$this->session->data['success'] = "Changes have been saved!";
			
			$url = '';
			
			$this->redirect($this->url->link('orders/orders', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
	}	
	
	protected function getForm() {
    	
		//Alert and Warning
		if (isset($this->session->data['warning'])) {
			$this->data['warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		} else {
			$this->data['warning'] = '';
		}

		if (isset($this->session->data['success'])) {
    		$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
			
		//buttons
		if (!isset($this->request->get['id'])) {
			$this->data['action'] = $this->url->link('orders/orders/insert');
		} else {
			$this->data['action'] = $this->url->link('orders/orders/update');
		}	
		$this->data['cancel'] = $this->url->link('orders/orders');
		
		//order data
		$order_info=array();	
		$unpaidOrders=array();	
		$paidOrders=array();	
		$lines=array();
		
		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$order_info = $this->model_orders_orders->getOrder($this->request->get['id']);
			$lines = $this->model_orders_orders->getTotalLines();
    	}

		$this->data['order_info']	=	$order_info;
		$this->data['lines']	=	$lines;
		
		//order detail
		$this->data['orders'] = array();

		$i=0;
		$user_unpaid_orders[0] = $order_info;
		foreach($user_unpaid_orders as $user_unpaid_order){
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
			$line = $this->model_orders_orders->getLine($data);
			$this->data['orders'][$i]['line_detail'] = $line;
			
			$attractions = $this->model_orders_orders->getAttractions();
			$this->data['attractions'] = $attractions; 
			$this->data['fromcitys'] = $this->model_orders_orders->getFromcitys();
			$this->data['endcitys'] = $this->model_orders_orders->getEndcitys();
			
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
		
		$this->data['order_status'] = array(
			"paid"=>"已付款",
			"unpaid"=>"未付款",
			"cancel"=>"已取消",
			"outdate"=>"已过期"
		);
		
		//render:
		$this->template = 'orders/orders_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
  
}
?>
