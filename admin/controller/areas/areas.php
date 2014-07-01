<?php 
class ControllerAreasAreas extends Controller {
     
  	public function index() {
		$this->document->setTitle("分区");

		$this->load->model('areas/areas');

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
		
		$areas_total=$this->model_areas_areas->getTotalAreas($data);
		
		$this->data['areas'] = array();
		
		foreach ($areas_total as $area) {
			$sort_default[]=$area['id'];
			
			$action = array();
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('areas/areas/edit', '&area_id=' . $area['id'])
			);
			
			$this->data['areas'][$area['id']]=array(
				"info" => $area,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('areas/areas/addnew');	
		$this->data['delete'] = $this->url->link('areas/areas/delete');	
		
		//render:
		$this->template = 'areas/areas_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("分区"); 
		
		$this->load->model('areas/areas');
		
		$this->model_areas_areas->deleteArea($this->request->post);
	  		
		$this->session->data['success'] = "Delete area success!";

		$url = '';
			
		$this->redirect($this->url->link('areas/areas'));
		
	}
	
	public function saveSort(){
		$this->load->model('areas/areas');
		$this->model_areas_areas->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("分区"); 
		
		$this->load->model('areas/areas');
		
		$this->model_areas_areas->addArea($this->request->post);
	  		
		$this->session->data['success'] = "Add area success!";

		$url = '';
			
		$this->redirect($this->url->link('areas/areas'));	
	}
	
	public function addnew(){
		$this->document->setTitle("分区"); 
		
		$this->load->model('areas/areas');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('areas/areas');

    	$this->document->setTitle("分区");
		
		$this->load->model('areas/areas');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_areas_areas->editArea($this->request->get['area_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('areas/areas'));
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
		if (!isset($this->request->get['area_id'])) {
			$this->data['action'] = $this->url->link('areas/areas/insert');
		} else {
			$this->data['action'] = $this->url->link('areas/areas/update');
		}	
		$this->data['cancel'] = $this->url->link('areas/areas');
		
		//area data
		$area_info=array();	
		
		if (isset($this->request->get['area_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$area_info = $this->model_areas_areas->getArea($this->request->get['area_id']);
    	}

		$this->data['area_info']	=	$area_info;
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'areas/areas_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('areas/areas');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_areas_areas->update_area($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('areas/areas'));
		}

	}
  
}
?>
