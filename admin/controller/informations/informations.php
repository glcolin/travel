<?php 
class ControllerInformationsInformations extends Controller {
     
  	public function index() {
		$this->document->setTitle("旅游资讯");

		$this->load->model('informations/informations');

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
		
		$informations_total=$this->model_informations_informations->getTotalInformations($data);
		
		$this->data['informations'] = array();
		
		$this->data['categories'] = $this->model_informations_informations->getCategories();
		
		$this->load->model('tool/image');
		
		foreach ($informations_total as $information) {
			$sort_default[]=$information['id'];
			
			$action = array();
			
			if ($information['image_url'] && file_exists(DIR_IMAGE . $information['image_url'])) {
				$image = $this->model_tool_image->resize($information['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('informations/informations/edit', '&information_id=' . $information['id'])
			);
			
			$this->data['informations'][$information['id']]=array(
				"info" => $information,
				"image" => $image,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('informations/informations/addnew');	
		$this->data['delete'] = $this->url->link('informations/informations/delete');	
		
		//render:
		$this->template = 'informations/informations_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("旅游资讯"); 
		
		$this->load->model('informations/informations');
		
		$this->model_informations_informations->deleteInformation($this->request->post);
	  		
		$this->session->data['success'] = "Delete information success!";

		$url = '';
			
		$this->redirect($this->url->link('informations/informations', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
	}
	
	public function saveSort(){
		$this->load->model('informations/informations');
		$this->model_informations_informations->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("旅游资讯"); 
		
		$this->load->model('informations/informations');
		
		$this->model_informations_informations->addInformation($this->request->post);
	  		
		$this->session->data['success'] = "Add information success!";

		$url = '';
			
		$this->redirect($this->url->link('informations/informations', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
	}
	
	public function addnew(){
		$this->document->setTitle("旅游资讯"); 
		
		$this->load->model('informations/informations');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('informations/informations');

    	$this->document->setTitle("旅游资讯");
		
		$this->load->model('informations/informations');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_informations_informations->editInformation($this->request->get['information_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('informations/informations', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		if (!isset($this->request->get['information_id'])) {
			$this->data['action'] = $this->url->link('informations/informations/insert');
		} else {
			$this->data['action'] = $this->url->link('informations/informations/update');
		}	
		$this->data['cancel'] = $this->url->link('informations/informations');
		
		//information data
		$information_info=array();	
		
		if (isset($this->request->get['information_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$information_info = $this->model_informations_informations->getInformation($this->request->get['information_id']);
    	}

		$this->data['information_info']	=	$information_info;
		
		$this->data['categories'] = $this->model_informations_informations->getCategories();
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'informations/informations_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('informations/informations');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_informations_informations->update_information($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('informations/informations', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

	}
  
}
?>
