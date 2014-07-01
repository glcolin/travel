<?php  
class ControllerAboutAbout extends Controller {
	public function index() {
	
		$this->document->setTitle("联系我们");
		$this->load->model('about/about');
		
		$this->data['contact_left'] = $this->model_about_about->getAboutLeft();
		$this->data['contact_right'] = $this->model_about_about->getAboutRight();
		
		$this->template = 'about/about.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left_information'
		);
										
		$this->response->setOutput($this->render());
	}

}
?>