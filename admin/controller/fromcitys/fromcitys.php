<?php 
class ControllerFromcitysFromcitys extends Controller {
     
  	public function index() {
		$this->document->setTitle("出发城市");

		$this->load->model('fromcitys/fromcitys');

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
		
		$data = array();
		
		$fromcitys_total=$this->model_fromcitys_fromcitys->getTotalFromcitys($data);
		
		$this->data['fromcitys'] = array();
		
		foreach ($fromcitys_total as $fromcity) {
			$sort_default[]=$fromcity['id'];
			
			$action = array();
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('fromcitys/fromcitys/edit', '&fromcity_id=' . $fromcity['id'])
			);
			
			$this->data['fromcitys'][$fromcity['id']]=array(
				"info" => $fromcity,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('fromcitys/fromcitys/addnew');	
		$this->data['delete'] = $this->url->link('fromcitys/fromcitys/delete');	
		
		//render:
		$this->template = 'fromcitys/fromcitys_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("出发城市"); 
		
		$this->load->model('fromcitys/fromcitys');
		
		$this->model_fromcitys_fromcitys->deleteFromcity($this->request->post);
	  		
		$this->session->data['success'] = "Delete fromcity success!";

		$url = '';
			
		$this->redirect($this->url->link('fromcitys/fromcitys', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
	}
	
	public function saveSort(){
		$this->load->model('fromcitys/fromcitys');
		$this->model_fromcitys_fromcitys->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("出发城市"); 
		
		$this->load->model('fromcitys/fromcitys');
		
		$this->model_fromcitys_fromcitys->addFromcity($this->request->post);
	  		
		$this->session->data['success'] = "Add fromcity success!";

		$url = '';
			
		$this->redirect($this->url->link('fromcitys/fromcitys', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
	}
	
	public function addnew(){
		$this->document->setTitle("出发城市"); 
		
		$this->load->model('fromcitys/fromcitys');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('fromcitys/fromcitys');

    	$this->document->setTitle("出发城市");
		
		$this->load->model('fromcitys/fromcitys');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_fromcitys_fromcitys->editFromcity($this->request->get['fromcity_id'], $this->request->post);
			
			$this->session->data['success'] = "Changes have been saved!";
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	
		
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
					
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('fromcitys/fromcitys', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		if (!isset($this->request->get['fromcity_id'])) {
			$this->data['action'] = $this->url->link('fromcitys/fromcitys/insert');
		} else {
			$this->data['action'] = $this->url->link('fromcitys/fromcitys/update');
		}	
		$this->data['cancel'] = $this->url->link('fromcitys/fromcitys');
		
		//fromcity data
		$fromcity_info=array();	
		
		if (isset($this->request->get['fromcity_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$fromcity_info = $this->model_fromcitys_fromcitys->getFromcity($this->request->get['fromcity_id']);
    	}

		$this->data['fromcity_info']	=	$fromcity_info;
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'fromcitys/fromcitys_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('fromcitys/fromcitys');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_fromcitys_fromcitys->update_fromcity($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('fromcitys/fromcitys', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

	}
  
}
?>
