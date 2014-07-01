<?php 
class ControllerInformationsCategories extends Controller {
     
  	public function index() {
		$this->document->setTitle("旅游资讯分类");

		$this->load->model('informations/categories');

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
		
		$categories_total=$this->model_informations_categories->getTotalCategories($data);
		
		$this->data['categories'] = array();
		
		foreach ($categories_total as $category) {
			$sort_default[]=$category['id'];
			
			$action = array();
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('informations/categories/edit', '&category_id=' . $category['id'])
			);
			
			$this->data['categories'][$category['id']]=array(
				"info" => $category,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('informations/categories/addnew');	
		$this->data['delete'] = $this->url->link('informations/categories/delete');	
		
		//render:
		$this->template = 'informations/categories_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("旅游资讯分类"); 
		
		$this->load->model('informations/categories');
		
		$this->model_informations_categories->deleteCategory($this->request->post);
	  		
		$this->session->data['success'] = "Delete category success!";

		$url = '';
			
		$this->redirect($this->url->link('informations/categories'));
		
	}
	
	public function saveSort(){
		$this->load->model('informations/categories');
		$this->model_informations_categories->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("旅游资讯分类"); 
		
		$this->load->model('informations/categories');
		
		$this->model_informations_categories->addCategory($this->request->post);
	  		
		$this->session->data['success'] = "Add category success!";

		$url = '';
			
		$this->redirect($this->url->link('informations/categories'));	
	}
	
	public function addnew(){
		$this->document->setTitle("旅游资讯分类"); 
		
		$this->load->model('informations/categories');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('informations/categories');

    	$this->document->setTitle("旅游资讯分类");
		
		$this->load->model('informations/categories');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_informations_categories->editCategory($this->request->get['category_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('informations/categories'));
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
		if (!isset($this->request->get['category_id'])) {
			$this->data['action'] = $this->url->link('informations/categories/insert');
		} else {
			$this->data['action'] = $this->url->link('informations/categories/update');
		}	
		$this->data['cancel'] = $this->url->link('informations/categories');
		
		//category data
		$category_info=array();	
		
		if (isset($this->request->get['category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$category_info = $this->model_informations_categories->getCategory($this->request->get['category_id']);
    	}

		$this->data['category_info']	=	$category_info;
		
		//render:
		$this->template = 'informations/categories_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('informations/categories');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_informations_categories->update_category($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('informations/categories'));
		}

	}
  
}
?>
