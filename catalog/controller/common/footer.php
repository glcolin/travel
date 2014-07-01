<?php  
class ControllerCommonFooter extends Controller {
	protected function index() {
		$this->load->model('common/footer');
		
		$this->data['qq_information'] = $this->model_common_footer->getQQInformation();
		
		$this->template = 'common/footer.tpl';
		
		$this->render();
	}
}
?>