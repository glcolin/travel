<?php  
class ControllerCommonColumnLeftInformation extends Controller {
	protected function index() {
		$this->load->model('common/column_left_information');
		
		$data=array(
			"wonderful" => 1
		);
		$this->data['wonderful_informations'] = $this->model_common_column_left_information->getInformations($data);
		
		$this->template = 'common/column_left_information.tpl';
								
		$this->render();
	}
}
?>