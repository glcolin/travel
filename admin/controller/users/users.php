<?php 
class ControllerUsersUsers extends Controller {
     
  	public function index() {
		$this->document->setTitle("用户管理");

		$this->load->model('users/users');

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
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		$limit = 30;
		
		$data = array(
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
		$users=$this->model_users_users->getTotalUsers($data);
		$data = array();
		$users_total=$this->model_users_users->getTotalUsers($data);
		$items_count=count($users_total);
		
		//pagination
		$route = $this->request->get['route'];
		
		$pagination = new Pagination();
		$pagination->total = $items_count;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link($route, 'page={page}');
		$this->data['pagination'] = $pagination->render();
		
		$this->data['users'] = array();
		
		foreach ($users as $user) {
			$sort_default[]=$user['user_id'];
			
			$action = array();
			
			$action[] = array(
				'text' => 'View',
				'href' => $this->url->link('users/users/edit', '&user_id=' . $user['user_id'])
			);
			
			$this->data['users'][$user['user_id']]=array(
				"info" => $user,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('users/users/addnew');	
		$this->data['delete'] = $this->url->link('users/users/delete');	
		
		//render:
		$this->template = 'users/users_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	/*public function saveSort(){
		$this->load->model('users/users');
		$this->model_users_users->saveSort($this->request->post);
	}	*/
	
	
	public function edit() {
    	//$this->language->load('users/users');

    	$this->document->setTitle("用户管理");
		
		$this->load->model('users/users');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_users_users->editUser($this->request->get['user_id'], $this->request->post);
			
			$this->session->data['success'] = "Changes have been saved!";
			
			$url = '';
			
			$this->redirect($this->url->link('users/users', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		if (!isset($this->request->get['user_id'])) {
			$this->data['action'] = $this->url->link('users/users/insert');
		} else {
			$this->data['action'] = $this->url->link('users/users/update');
		}	
		$this->data['cancel'] = $this->url->link('users/users');
		
		//user data
		$user_info=array();	
		$unpaidOrders=array();	
		$paidOrders=array();	
		$lines=array();
		
		if (isset($this->request->get['user_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$user_info = $this->model_users_users->getUser($this->request->get['user_id']);
			$data = array(
				"user_id" => $this->request->get['user_id'],
				"status" => "unpaid"
			);
			$unpaidOrders = $this->model_users_users->getUserOrders($data);
			$data = array(
				"user_id" => $this->request->get['user_id'],
				"status" => "paid"
			);
			$paidOrders = $this->model_users_users->getUserOrders($data);
			$lines = $this->model_users_users->getTotalLines();
    	}

		$this->data['user_info']	=	$user_info;
		$this->data['unpaidOrders']	=	$unpaidOrders;
		$this->data['paidOrders']	=	$paidOrders;
		$this->data['lines']	=	$lines;
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'users/users_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
  
}
?>
