<?php 
class ControllerAttractionsAttractions extends Controller {
     
  	public function index() {
		$this->document->setTitle("旅游景点");

		$this->load->model('attractions/attractions');

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
		
		$attractions_total=$this->model_attractions_attractions->getTotalAttractions($data);
		
		$this->data['attractions'] = array();
		
		foreach ($attractions_total as $attraction) {
			$sort_default[]=$attraction['id'];
			
			$action = array();
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('attractions/attractions/edit', '&attraction_id=' . $attraction['id'])
			);
			
			$this->data['attractions'][$attraction['id']]=array(
				"info" => $attraction,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('attractions/attractions/addnew');	
		$this->data['delete'] = $this->url->link('attractions/attractions/delete');	
		
		//render:
		$this->template = 'attractions/attractions_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("旅游景点"); 
		
		$this->load->model('attractions/attractions');
		
		$this->model_attractions_attractions->deleteAttraction($this->request->post);
	  		
		$this->session->data['success'] = "Delete attraction success!";

		$url = '';
			
		$this->redirect($this->url->link('attractions/attractions', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
	}
	
	public function saveSort(){
		$this->load->model('attractions/attractions');
		$this->model_attractions_attractions->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("旅游景点"); 
		
		$this->load->model('attractions/attractions');
		
		$this->model_attractions_attractions->addAttraction($this->request->post);
	  		
		$this->session->data['success'] = "Add attraction success!";

		$url = '';
			
		$this->redirect($this->url->link('attractions/attractions', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
	}
	
	public function addnew(){
		$this->document->setTitle("旅游景点"); 
		
		$this->load->model('attractions/attractions');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('attractions/attractions');

    	$this->document->setTitle("旅游景点");
		
		$this->load->model('attractions/attractions');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_attractions_attractions->editAttraction($this->request->get['attraction_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('attractions/attractions', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		if (!isset($this->request->get['attraction_id'])) {
			$this->data['action'] = $this->url->link('attractions/attractions/insert');
		} else {
			$this->data['action'] = $this->url->link('attractions/attractions/update');
		}	
		$this->data['cancel'] = $this->url->link('attractions/attractions');
		
		//attraction data
		$attraction_info=array();	
		
		if (isset($this->request->get['attraction_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$attraction_info = $this->model_attractions_attractions->getAttraction($this->request->get['attraction_id']);
    	}

		$this->data['attraction_info']	=	$attraction_info;
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'attractions/attractions_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('attractions/attractions');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_attractions_attractions->update_attraction($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('attractions/attractions', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

	}
  
}
?>
