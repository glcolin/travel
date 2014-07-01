<?php 
class ControllerEndcitysEndcitys extends Controller {
     
  	public function index() {
		$this->document->setTitle("结束地点");

		$this->load->model('endcitys/endcitys');

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
		
		$endcitys_total=$this->model_endcitys_endcitys->getTotalEndcitys($data);
		
		$this->data['endcitys'] = array();
		
		foreach ($endcitys_total as $endcity) {
			$sort_default[]=$endcity['id'];
			
			$action = array();
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('endcitys/endcitys/edit', '&endcity_id=' . $endcity['id'])
			);
			
			$this->data['endcitys'][$endcity['id']]=array(
				"info" => $endcity,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('endcitys/endcitys/addnew');	
		$this->data['delete'] = $this->url->link('endcitys/endcitys/delete');	
		
		//render:
		$this->template = 'endcitys/endcitys_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("结束地点"); 
		
		$this->load->model('endcitys/endcitys');
		
		$this->model_endcitys_endcitys->deleteEndcity($this->request->post);
	  		
		$this->session->data['success'] = "Delete endcity success!";

		$url = '';
			
		$this->redirect($this->url->link('endcitys/endcitys', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
	}
	
	public function saveSort(){
		$this->load->model('endcitys/endcitys');
		$this->model_endcitys_endcitys->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("结束地点"); 
		
		$this->load->model('endcitys/endcitys');
		
		$this->model_endcitys_endcitys->addEndcity($this->request->post);
	  		
		$this->session->data['success'] = "Add endcity success!";

		$url = '';
			
		$this->redirect($this->url->link('endcitys/endcitys', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
	}
	
	public function addnew(){
		$this->document->setTitle("结束地点"); 
		
		$this->load->model('endcitys/endcitys');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('endcitys/endcitys');

    	$this->document->setTitle("结束地点");
		
		$this->load->model('endcitys/endcitys');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_endcitys_endcitys->editEndcity($this->request->get['endcity_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('endcitys/endcitys', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		if (!isset($this->request->get['endcity_id'])) {
			$this->data['action'] = $this->url->link('endcitys/endcitys/insert');
		} else {
			$this->data['action'] = $this->url->link('endcitys/endcitys/update');
		}	
		$this->data['cancel'] = $this->url->link('endcitys/endcitys');
		
		//endcity data
		$endcity_info=array();	
		
		if (isset($this->request->get['endcity_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$endcity_info = $this->model_endcitys_endcitys->getEndcity($this->request->get['endcity_id']);
    	}

		$this->data['endcity_info']	=	$endcity_info;
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'endcitys/endcitys_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('endcitys/endcitys');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_endcitys_endcitys->update_endcity($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('endcitys/endcitys', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

	}
  
}
?>
