<?php 
class ControllerFriendlinksFriendlinks extends Controller {
     
  	public function index() {
		$this->document->setTitle("友情链接");

		$this->load->model('friendlinks/friendlinks');

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
		
		$friendlinks_total=$this->model_friendlinks_friendlinks->getTotalFriendlinks($data);
		
		$this->data['friendlinks'] = array();
		
		$this->load->model('tool/image');
		
		foreach ($friendlinks_total as $friendlink) {
			$sort_default[]=$friendlink['id'];
			
			$action = array();
			
			if ($friendlink['image_url'] && file_exists(DIR_IMAGE . $friendlink['image_url'])) {
				$image = $this->model_tool_image->resize($friendlink['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('friendlinks/friendlinks/edit', '&friendlink_id=' . $friendlink['id'])
			);
			
			$this->data['friendlinks'][$friendlink['id']]=array(
				"info" => $friendlink,
				"image" => $image,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('friendlinks/friendlinks/addnew');	
		$this->data['delete'] = $this->url->link('friendlinks/friendlinks/delete');	
		
		//render:
		$this->template = 'friendlinks/friendlinks_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("友情链接"); 
		
		$this->load->model('friendlinks/friendlinks');
		
		$this->model_friendlinks_friendlinks->deleteFriendlink($this->request->post);
	  		
		$this->session->data['success'] = "Delete friendlink success!";

		$url = '';
			
		$this->redirect($this->url->link('friendlinks/friendlinks', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
	}
	
	public function saveSort(){
		$this->load->model('friendlinks/friendlinks');
		$this->model_friendlinks_friendlinks->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("友情链接"); 
		
		$this->load->model('friendlinks/friendlinks');
		
		$this->model_friendlinks_friendlinks->addFriendlink($this->request->post);
	  		
		$this->session->data['success'] = "Add friendlink success!";

		$url = '';
			
		$this->redirect($this->url->link('friendlinks/friendlinks', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
	}
	
	public function addnew(){
		$this->document->setTitle("友情链接"); 
		
		$this->load->model('friendlinks/friendlinks');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('friendlinks/friendlinks');

    	$this->document->setTitle("友情链接");
		
		$this->load->model('friendlinks/friendlinks');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_friendlinks_friendlinks->editFriendlink($this->request->get['friendlink_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('friendlinks/friendlinks', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		if (!isset($this->request->get['friendlink_id'])) {
			$this->data['action'] = $this->url->link('friendlinks/friendlinks/insert');
		} else {
			$this->data['action'] = $this->url->link('friendlinks/friendlinks/update');
		}	
		$this->data['cancel'] = $this->url->link('friendlinks/friendlinks');
		
		//friendlink data
		$friendlink_info=array();	
		
		if (isset($this->request->get['friendlink_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$friendlink_info = $this->model_friendlinks_friendlinks->getFriendlink($this->request->get['friendlink_id']);
    	}

		$this->data['friendlink_info']	=	$friendlink_info;
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'friendlinks/friendlinks_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('friendlinks/friendlinks');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_friendlinks_friendlinks->update_friendlink($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('friendlinks/friendlinks', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

	}
  
}
?>
