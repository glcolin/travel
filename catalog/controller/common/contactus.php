<?php  
class ControllerCommonContactUs extends Controller {
	protected function index() {
		$this->load->model('common/contactus');
		
		$this->data['contactus'] = $this->model_common_contactus->getContactUs();
		
		$this->template = 'common/contactus.tpl';
								
		$this->render();
	}
}
?>