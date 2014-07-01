<?php 
class ControllerContactusContactus extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("联系我们");

		$this->load->model('contactus/contactus');

		$this->getForm();
		
  	}
	
	protected function getForm() {
    	if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

 		if (isset($this->error['meta_description'])) {
			$this->data['error_meta_description'] = $this->error['meta_description'];
		} else {
			$this->data['error_meta_description'] = array();
		}		
   
   		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = array();
		}	
		
   		if (isset($this->error['model'])) {
			$this->data['error_model'] = $this->error['model'];
		} else {
			$this->data['error_model'] = '';
		}		
     	
		if (isset($this->error['date_available'])) {
			$this->data['error_date_available'] = $this->error['date_available'];
		} else {
			$this->data['error_date_available'] = '';
		}	

		$url = '';				
		
		$this->data['action'] = $this->url->link('contactus/contactus/update');

      	$content = $this->model_contactus_contactus->getContactUs();
		$this->data['content']	=	$content?$content:"";
		
		$qq_information = $this->model_contactus_contactus->getQQInformation();
		$this->data['qq_information']	=	$qq_information?$qq_information:"";
										
		$this->template = 'contactus/contactus.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
			
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('contactus/contactus');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_contactus_contactus->update_banner($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('contactus/contactus'));
		}

	}
  
}
?>
