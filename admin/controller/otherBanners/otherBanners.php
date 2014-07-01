<?php 
class ControllerOtherBannersOtherBanners extends Controller {
     
  	public function index() {
		$this->document->setTitle("其他广告图片");

		$this->load->model('otherBanners/otherBanners');

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
		
		$otherBanners_total=$this->model_otherBanners_otherBanners->getTotalOtherBanners($data);
		
		$this->data['otherBanners'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($otherBanners_total as $otherBanner) {
			$sort_default[]=$otherBanner['id'];
			
			$action = array();
			
			if ($otherBanner['image_url'] && file_exists(DIR_IMAGE . $otherBanner['image_url'])) {
				$image = $this->model_tool_image->resize($otherBanner['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('otherBanners/otherBanners/edit', '&otherBanner_id=' . $otherBanner['id'])
			);
			
			$this->data['otherBanners'][$otherBanner['id']]=array(
				"info" => $otherBanner,
				"image" => $image,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('otherBanners/otherBanners/addnew');	
		$this->data['delete'] = $this->url->link('otherBanners/otherBanners/delete');	
		
		$this->data['types'] = array("hotline"=>"热门路线广告","recommendline"=>"推荐路线广告","other"=>"其他");
		
		//render:
		$this->template = 'otherBanners/otherBanners_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("其他广告图片"); 
		
		$this->load->model('otherBanners/otherBanners');
		
		$this->model_otherBanners_otherBanners->deleteOtherBanner($this->request->post);
	  		
		$this->session->data['success'] = "Delete otherBanner success!";

		$url = '';
			
		$this->redirect($this->url->link('otherBanners/otherBanners', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
	}
	
	public function saveSort(){
		$this->load->model('otherBanners/otherBanners');
		$this->model_otherBanners_otherBanners->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("其他广告图片"); 
		
		$this->load->model('otherBanners/otherBanners');
		
		$this->model_otherBanners_otherBanners->addOtherBanner($this->request->post);
	  		
		$this->session->data['success'] = "Add otherBanner success!";

		$url = '';
			
		$this->redirect($this->url->link('otherBanners/otherBanners', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
	}
	
	public function addnew(){
		$this->document->setTitle("其他广告图片"); 
		
		$this->load->model('otherBanners/otherBanners');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('otherBanners/otherBanners');

    	$this->document->setTitle("其他广告图片");
		
		$this->load->model('otherBanners/otherBanners');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_otherBanners_otherBanners->editOtherBanner($this->request->get['otherBanner_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('otherBanners/otherBanners', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		if (!isset($this->request->get['otherBanner_id'])) {
			$this->data['action'] = $this->url->link('otherBanners/otherBanners/insert');
		} else {
			$this->data['action'] = $this->url->link('otherBanners/otherBanners/update');
		}	
		$this->data['cancel'] = $this->url->link('otherBanners/otherBanners');
		
		//otherBanner data
		$otherBanner_info=array();	
		
		if (isset($this->request->get['otherBanner_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$otherBanner_info = $this->model_otherBanners_otherBanners->getOtherBanner($this->request->get['otherBanner_id']);
    	}

		$this->data['otherBanner_info']	=	$otherBanner_info;
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'otherBanners/otherBanners_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('otherBanners/otherBanners');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_otherBanners_otherBanners->update_otherBanner($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('otherBanners/otherBanners', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

	}
  
}
?>
