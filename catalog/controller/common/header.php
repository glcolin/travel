<?php   
class ControllerCommonHeader extends Controller {
	protected function index() {
		$this->load->model('common/header');
		
		/*$data=array(
			"class_type"=>$class_type,
			"language_id"=>$language
		);
		$this->data['top_banner'] = $this->model_common_header->getTopBanner($data);*/
		
		//check if login
		$this->data['isLogged'] = 0 ;
		if ($this->user->isLogged("front")){
			$this->session->data['success'] = "Hi,".$this->session->data['username_f'];
			$this->data['isLogged'] = 1;
			$this->data['username_f'] = $this->session->data['username_f'];
		}
		
		$route = isset($this->request->get['route'])?$this->request->get['route']:'common/home';
		 
		$this->data['route'] = $route;
		
		$seokeywords = '旅游,优胜旅游,优胜,u-save,usavetrip';
		$seodescription = '旅游,优胜旅游,优胜,u-save,usavetrip';
		$seokeywords = isset($this->session->data['seokeywords'])?($this->session->data['seokeywords']?$this->session->data['seokeywords']:$seokeywords):$seokeywords;
		$seodescription = isset($this->session->data['seodescription'])?($this->session->data['seodescription']?$this->session->data['seodescription']:$seodescription):$seodescription;
		$this->data['seokeywords'] = $seokeywords;
		$this->data['seodescription'] = $seodescription;
		
		$week_arr = array(0=>"日",1=>"一",2=>"二",3=>"三",4=>"四",5=>"五",6=>"六");
		$this->data['today'] = date('Y年m月d日 星期').$week_arr[idate('w')];
		
		$this->template = 'common/header.tpl';
		
    	$this->render();
	} 	
}
?>
