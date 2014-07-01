<?php 
class ControllerMainseoMainseo extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->document->setTitle("主页SEO");

		$this->load->model('mainseo/mainseo');

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
		
		$this->data['action'] = $this->url->link('mainseo/mainseo/update');

      	$main_seo_keywords = $this->model_mainseo_mainseo->getMainSeoKeywords();
		$this->data['main_seo_keywords']	=	$main_seo_keywords?$main_seo_keywords:"";
		
		$main_seo_description = $this->model_mainseo_mainseo->getMainSeoDescription();
		$this->data['main_seo_description']	=	$main_seo_description?$main_seo_description:"";
										
		$this->template = 'mainseo/mainseo.tpl';
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

		$this->load->model('mainseo/mainseo');
	
		$url="";
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_mainseo_mainseo->update_mainseo($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('mainseo/mainseo'));
		}

	}
  
}
?>
