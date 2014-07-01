<?php  
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle("优胜旅游");
		
		$this->load->model('common/home');
	
		$data=array(
			"category" => 1
		);
		$this->data['wonderful_informations'] = $this->model_common_home->getInformations($data);
		
		$data=array(
			"category" => 2,
			"limit" => 10
		);
		$this->data['recommend_informations'] = $this->model_common_home->getInformations($data);
		
		$data=array(
			"limit"=>8
		);
		$this->data['informations'] = $this->model_common_home->getInformations($data);
	
		$data=array(
			"limit"=>8
		);
		$this->data['certificates'] = $this->model_common_home->getCertificates($data);
	
		$this->data['content_banners'] = $this->model_common_home->getBanners();
		
		$data=array(
			"type"=>"hotline"
		);
		$this->data['hotlinebanners'] = $this->model_common_home->getOtherBanners($data);
		
		$data=array(
			"type"=>"recommendline"
		);
		$this->data['recommendlinebanners'] = $this->model_common_home->getOtherBanners($data);

		$this->data['friendlinks'] = $this->model_common_home->getTotalFriendlinks();
		
		$this->data['areas'] = $this->model_common_home->getAreas();
		
		$data=array(
			"latest" => "yes",
			"limit"=>6
		);
		$this->data['latest_lines'] = $this->model_common_home->getLines($data);
		
		$data=array(
			"hot" => "1",
			"limit"=>6
		);
		$this->data['recommend_lines'] = $this->model_common_home->getLines($data);
		
		$data=array(
			"limit"=>4
		);
		$this->data['specialLines'] = $this->model_common_home->getSpecialLines($data);
		
		$this->data['fromcitys'] = $this->model_common_home->getFromcitys();
		
		$this->data['endcitys'] = $this->model_common_home->getEndcitys();
		
		$this->data['specialareas'] =  $this->model_common_home->getSpecialAreas();
		
		$this->session->data['seokeywords'] = $this->model_common_home->getMainSeoKeywords();
		$this->session->data['seodescription'] = $this->model_common_home->getMainSeoDescription();
	
		$this->template = 'common/home.tpl';
		
		$this->children = array(
			'common/footer',
			'common/contactus',
			'common/header'
		);
										
		$this->response->setOutput($this->render());
	}
}
?>