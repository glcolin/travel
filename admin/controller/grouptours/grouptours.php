<?php 
class ControllerGrouptoursGrouptours extends Controller {
     
  	public function index() {
		$this->document->setTitle("包团管理");

		$this->load->model('grouptours/grouptours');

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
		$grouptours=$this->model_grouptours_grouptours->getTotalGrouptours($data);
		$data = array(
			'filter_number' => $filter_number
		);
		$grouptours_total=$this->model_grouptours_grouptours->getTotalGrouptours($data);
		$items_count=count($grouptours_total);
		
		//pagination
		$route = $this->request->get['route'];
		
		$pagination = new Pagination();
		$pagination->total = $items_count;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link($route, 'filter_number='.$filter_number.'&page={page}');
		$this->data['pagination'] = $pagination->render();
		
		$this->data['grouptours'] = array();
		
		foreach ($grouptours as $grouptour) {
			$sort_default[]=$grouptour['id'];
			
			$action = array();
			
			$action[] = array(
				'text' => 'View',
				'href' => $this->url->link('grouptours/grouptours/edit', '&id=' . $grouptour['id'])
			);
			
			$this->data['grouptours'][$grouptour['id']]=array(
				"info" => json_decode($grouptour['content'],true),
				"number" => $grouptour['number'],
				"create_date" => $grouptour['create_date'],
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('grouptours/grouptours/addnew');	
		$this->data['delete'] = $this->url->link('grouptours/grouptours/delete');	
		
		//render:
		$this->template = 'grouptours/grouptours_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	/*public function saveSort(){
		$this->load->model('grouptours/grouptours');
		$this->model_grouptours_grouptours->saveSort($this->request->post);
	}	*/
	
	
	public function edit() {
    	//$this->language->load('grouptours/grouptours');

    	$this->document->setTitle("包团管理");
		
		$this->load->model('grouptours/grouptours');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_grouptours_grouptours->editGrouptour($this->request->get['id'], $this->request->post);
			
			$this->session->data['success'] = "Changes have been saved!";
			
			$url = '';
			
			$this->redirect($this->url->link('grouptours/grouptours', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			$this->data['action'] = $this->url->link('grouptours/grouptours/insert');
		} else {
			$this->data['action'] = $this->url->link('grouptours/grouptours/update');
		}	
		$this->data['cancel'] = $this->url->link('grouptours/grouptours');
		
		//grouptour data
		$grouptour_info=array();	
		$unpaidGrouptours=array();	
		$paidGrouptours=array();	
		$lines=array();
		
		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$grouptour_info = $this->model_grouptours_grouptours->getGrouptour($this->request->get['id']);
    	}

		$this->data['grouptour_info'] = array(
			"info" => $grouptour_info,
			"content" => json_decode($grouptour_info['content'],true)
			);
		
		//render:
		$this->template = 'grouptours/grouptours_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
  
}
?>
