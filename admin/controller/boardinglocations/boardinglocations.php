<?php 
class ControllerBoardinglocationsBoardinglocations extends Controller {
     
  	public function index() {

		$this->document->setTitle("上车地点");

		$this->load->model('boardinglocations/boardinglocations');

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
		
		$boardinglocations_total=$this->model_boardinglocations_boardinglocations->getTotalBoardinglocations($data);
		
		$this->data['boardinglocations'] = array();
		
		foreach ($boardinglocations_total as $boardinglocation) {
			$sort_default[]=$boardinglocation['id'];
			
			$action = array();
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('boardinglocations/boardinglocations/edit', '&boardinglocation_id=' . $boardinglocation['id'])
			);
			
			$this->data['boardinglocations'][$boardinglocation['id']]=array(
				"info" => $boardinglocation,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('boardinglocations/boardinglocations/addnew');	
		$this->data['delete'] = $this->url->link('boardinglocations/boardinglocations/delete');	
		
		//render:
		$this->template = 'boardinglocations/boardinglocations_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("上车地点"); 
		
		$this->load->model('boardinglocations/boardinglocations');
		
		$this->model_boardinglocations_boardinglocations->deleteBoardinglocation($this->request->post);
	  		
		$this->session->data['success'] = "Delete boardinglocation success!";

		$url = '';
			
		$this->redirect($this->url->link('boardinglocations/boardinglocations', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
	}
	
	public function saveSort(){
		$this->load->model('boardinglocations/boardinglocations');
		$this->model_boardinglocations_boardinglocations->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("上车地点"); 
		
		$this->load->model('boardinglocations/boardinglocations');
		
		$this->model_boardinglocations_boardinglocations->addBoardinglocation($this->request->post);
	  		
		$this->session->data['success'] = "Add boardinglocation success!";

		$url = '';
			
		$this->redirect($this->url->link('boardinglocations/boardinglocations', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
	}
	
	public function addnew(){
		$this->document->setTitle("上车地点"); 
		
		$this->load->model('boardinglocations/boardinglocations');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('boardinglocations/boardinglocations');

    	$this->document->setTitle("上车地点");
		
		$this->load->model('boardinglocations/boardinglocations');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_boardinglocations_boardinglocations->editBoardinglocation($this->request->get['boardinglocation_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('boardinglocations/boardinglocations', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		if (!isset($this->request->get['boardinglocation_id'])) {
			$this->data['action'] = $this->url->link('boardinglocations/boardinglocations/insert');
		} else {
			$this->data['action'] = $this->url->link('boardinglocations/boardinglocations/update');
		}	
		$this->data['cancel'] = $this->url->link('boardinglocations/boardinglocations');
		
		//boardinglocation data
		$boardinglocation_info=array();	
		
		if (isset($this->request->get['boardinglocation_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$boardinglocation_info = $this->model_boardinglocations_boardinglocations->getBoardinglocation($this->request->get['boardinglocation_id']);
    	}

		$this->data['boardinglocation_info']	=	$boardinglocation_info;
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'boardinglocations/boardinglocations_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('boardinglocations/boardinglocations');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_boardinglocations_boardinglocations->update_boardinglocation($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('boardinglocations/boardinglocations', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

	}
  
}
?>
