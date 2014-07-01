<?php  
class ControllerCommonColumnLeft extends Controller {
	protected function index() {
		$this->load->model('common/column_left');
		
		$data=array(
			"hot"=>1
		);
		$this->data['hotlines'] = $this->model_common_column_left->getLines($data);
		
		$this->data['contactus'] = $this->model_common_column_left->getContactUs();
		
		$this->data['areas'] = $this->model_common_column_left->getAreas();
		
		$this->data['area'] = isset($this->request->get['area'])?($this->request->get['area']?$this->request->get['area']:""):"";
		
		$this->data['fromcitys'] = $this->model_common_column_left->getFromcitys();
		
		$this->data['endcitys'] = $this->model_common_column_left->getEndcitys();
		
		$this->data['specialareas'] =  $this->model_common_column_left->getSpecialAreas();
		
		$this->data['show'] = 0;
		if($this->request->get['route'] == "cruises/cruises" || $this->request->get['route'] == "cruises/cruise"){
			$this->data['area'] = 19;
		}
		else{
			$this->data['show'] = 1;
		}
		
		//search variable
		$this->data['search_days'] = isset($this->session->data['search_days'])?$this->session->data['search_days']:"";
		$this->data['search_fromcity'] = isset($this->session->data['search_fromcity'])?$this->session->data['search_fromcity']:"";
		$this->data['search_endcity'] = isset($this->session->data['search_endcity'])?$this->session->data['search_endcity']:"";
		
		$this->template = 'common/column_left.tpl';
								
		$this->render();
	}
}
?>