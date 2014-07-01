<?php 
class ControllerHomeBannersHomeBanners extends Controller {
     
  	public function index() {
		$this->document->setTitle("主页旗帜广告");

		$this->load->model('homeBanners/homeBanners');

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
		
		$homeBanners_total=$this->model_homeBanners_homeBanners->getTotalHomeBanners($data);
		
		$this->data['homeBanners'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($homeBanners_total as $homeBanner) {
			$sort_default[]=$homeBanner['id'];
			
			$action = array();
			
			if ($homeBanner['image_url'] && file_exists(DIR_IMAGE . $homeBanner['image_url'])) {
				$image = $this->model_tool_image->resize($homeBanner['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('homeBanners/homeBanners/edit', '&homeBanner_id=' . $homeBanner['id'])
			);
			
			$this->data['homeBanners'][$homeBanner['id']]=array(
				"info" => $homeBanner,
				"image" => $image,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('homeBanners/homeBanners/addnew');	
		$this->data['delete'] = $this->url->link('homeBanners/homeBanners/delete');	
		
		//render:
		$this->template = 'homeBanners/homeBanners_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("主页旗帜广告"); 
		
		$this->load->model('homeBanners/homeBanners');
		
		$this->model_homeBanners_homeBanners->deleteHomeBanner($this->request->post);
	  		
		$this->session->data['success'] = "Delete homeBanner success!";

		$url = '';
			
		$this->redirect($this->url->link('homeBanners/homeBanners', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
	}
	
	public function saveSort(){
		$this->load->model('homeBanners/homeBanners');
		$this->model_homeBanners_homeBanners->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("主页旗帜广告"); 
		
		$this->load->model('homeBanners/homeBanners');
		
		$this->model_homeBanners_homeBanners->addHomeBanner($this->request->post);
	  		
		$this->session->data['success'] = "Add homeBanner success!";

		$url = '';
			
		$this->redirect($this->url->link('homeBanners/homeBanners', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
	}
	
	public function addnew(){
		$this->document->setTitle("主页旗帜广告"); 
		
		$this->load->model('homeBanners/homeBanners');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('homeBanners/homeBanners');

    	$this->document->setTitle("主页旗帜广告");
		
		$this->load->model('homeBanners/homeBanners');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_homeBanners_homeBanners->editHomeBanner($this->request->get['homeBanner_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('homeBanners/homeBanners', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		if (!isset($this->request->get['homeBanner_id'])) {
			$this->data['action'] = $this->url->link('homeBanners/homeBanners/insert');
		} else {
			$this->data['action'] = $this->url->link('homeBanners/homeBanners/update');
		}	
		$this->data['cancel'] = $this->url->link('homeBanners/homeBanners');
		
		//homeBanner data
		$homeBanner_info=array();	
		
		if (isset($this->request->get['homeBanner_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$homeBanner_info = $this->model_homeBanners_homeBanners->getHomeBanner($this->request->get['homeBanner_id']);
    	}

		$this->data['homeBanner_info']	=	$homeBanner_info;
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'homeBanners/homeBanners_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('homeBanners/homeBanners');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_homeBanners_homeBanners->update_homeBanner($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('homeBanners/homeBanners', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

	}
  
}
?>
