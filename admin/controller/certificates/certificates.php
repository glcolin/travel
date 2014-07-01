<?php 
class ControllerCertificatesCertificates extends Controller {
     
  	public function index() {
		$this->document->setTitle("签证");

		$this->load->model('certificates/certificates');

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
		
		$certificates_total=$this->model_certificates_certificates->getTotalCertificates($data);
		
		$this->data['certificates'] = array();
		
		$this->data['categories'] = $this->model_certificates_certificates->getCategories();
		
		$this->load->model('tool/image');
		
		foreach ($certificates_total as $certificate) {
			$sort_default[]=$certificate['id'];
			
			$action = array();
			
			if ($certificate['image_url'] && file_exists(DIR_IMAGE . $certificate['image_url'])) {
				$image = $this->model_tool_image->resize($certificate['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('certificates/certificates/edit', '&certificate_id=' . $certificate['id'])
			);
			
			$this->data['certificates'][$certificate['id']]=array(
				"info" => $certificate,
				"image" => $image,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('certificates/certificates/addnew');	
		$this->data['delete'] = $this->url->link('certificates/certificates/delete');	
		
		//render:
		$this->template = 'certificates/certificates_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("签证"); 
		
		$this->load->model('certificates/certificates');
		
		$this->model_certificates_certificates->deleteCertificate($this->request->post);
	  		
		$this->session->data['success'] = "Delete certificate success!";

		$url = '';
			
		$this->redirect($this->url->link('certificates/certificates', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
	}
	
	public function saveSort(){
		$this->load->model('certificates/certificates');
		$this->model_certificates_certificates->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("签证"); 
		
		$this->load->model('certificates/certificates');
		
		$this->model_certificates_certificates->addCertificate($this->request->post);
	  		
		$this->session->data['success'] = "Add certificate success!";

		$url = '';
			
		$this->redirect($this->url->link('certificates/certificates', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
	}
	
	public function addnew(){
		$this->document->setTitle("签证"); 
		
		$this->load->model('certificates/certificates');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('certificates/certificates');

    	$this->document->setTitle("签证");
		
		$this->load->model('certificates/certificates');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_certificates_certificates->editCertificate($this->request->get['certificate_id'], $this->request->post);
			
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
			
			$this->redirect($this->url->link('certificates/certificates', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		if (!isset($this->request->get['certificate_id'])) {
			$this->data['action'] = $this->url->link('certificates/certificates/insert');
		} else {
			$this->data['action'] = $this->url->link('certificates/certificates/update');
		}	
		$this->data['cancel'] = $this->url->link('certificates/certificates');
		
		//certificate data
		$certificate_info=array();	
		
		if (isset($this->request->get['certificate_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$certificate_info = $this->model_certificates_certificates->getCertificate($this->request->get['certificate_id']);
    	}

		$this->data['certificate_info']	=	$certificate_info;
		
		$this->data['categories'] = $this->model_certificates_certificates->getCategories();
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'certificates/certificates_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('certificates/certificates');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_certificates_certificates->update_certificate($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('certificates/certificates', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

	}
  
}
?>
