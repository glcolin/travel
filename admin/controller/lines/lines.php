<?php 
class ControllerLinesLines extends Controller {
     
  	public function index() {
		$this->document->setTitle("旅游线路");

		$this->load->model('lines/lines');

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
		
		//filter
		$filter_str='';			
		$this->data['filter_area']='';				
		if (isset($this->request->get['filter_area'])) {
			$this->data['filter_area']=$this->request->get['filter_area'];
			$filter_str .= "&filter_area=".$this->request->get['filter_area'];
		}
		
		$data=array(
			"filter_area"=>$this->data['filter_area']
		);
		
		$lines_total=$this->model_lines_lines->getTotalLines($data);
		
		$this->data['lines'] = array();
		
		$this->data['areas'] = $this->model_lines_lines->getAreas();
		
		$this->data['fromcitys'] = $this->model_lines_lines->getFromcitys();
		$this->data['endcitys'] = $this->model_lines_lines->getEndcitys();
		
		$this->load->model('tool/image');
		
		foreach ($lines_total as $line) {
			$sort_default[]=$line['id'];
			
			$action = array();
			
			if ($line['image_url'] && file_exists(DIR_IMAGE . $line['image_url'])) {
				$image = $this->model_tool_image->resize($line['image_url'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$action[] = array(
				'text' => 'Edit',
				'href' => $this->url->link('lines/lines/edit', '&line_id=' . $line['id'].$filter_str)
			);
			
			$this->data['lines'][$line['id']]=array(
				"info" => $line,
				"image" => $image,
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('lines/lines/addnew',$filter_str );	
		$this->data['delete'] = $this->url->link('lines/lines/delete',$filter_str );	
		
		//render:
		$this->template = 'lines/lines_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	public function delete(){
    	$this->document->setTitle("旅游线路"); 
		
		$this->load->model('lines/lines');
		
		$this->model_lines_lines->deleteLine($this->request->post);
	  		
		$this->session->data['success'] = "Delete line success!";

		$url = '';
		
		//filter
		$filter_str='';			
		$this->data['filter_area']='';				
		if (isset($this->request->get['filter_area'])) {
			$this->data['filter_area']=$this->request->get['filter_area'];
			$filter_str .= "&filter_area=".$this->request->get['filter_area'];
		}
			
		$this->redirect($this->url->link('lines/lines',$filter_str ));
		
	}
	
	public function saveSort(){
		$this->load->model('lines/lines');
		$this->model_lines_lines->saveSort($this->request->post);
	}	
	
	public function insert(){
    	$this->document->setTitle("旅游线路"); 
		
		$this->load->model('lines/lines');
		
		//filter
		$filter_str='';			
		$this->data['filter_area']='';				
		if (isset($this->request->get['filter_area'])) {
			$this->data['filter_area']=$this->request->get['filter_area'];
			$filter_str .= "&filter_area=".$this->request->get['filter_area'];
		}
		
		$this->model_lines_lines->addLine($this->request->post);
	  		
		$this->session->data['success'] = "Add line success!";

		$url = '';
			
		$this->redirect($this->url->link('lines/lines',$filter_str));	
	}
	
	public function addnew(){
		$this->document->setTitle("旅游线路"); 
		
		$this->load->model('lines/lines');
		
		$this->getForm();
	}	
	
	public function edit() {
    	//$this->language->load('lines/lines');

    	$this->document->setTitle("旅游线路");
		
		$this->load->model('lines/lines');
		
		$this->session->data['success']="";
		
		//filter
		$filter_str='';			
		$this->data['filter_area']='';				
		if (isset($this->request->get['filter_area'])) {
			$this->data['filter_area']=$this->request->get['filter_area'];
			$filter_str .= "&filter_area=".$this->request->get['filter_area'];
		}	
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_lines_lines->editLine($this->request->get['line_id'], $this->request->post);
			
			$this->session->data['success'] = "Changes have been saved!";
			
			$url = '';
			
			$this->redirect($this->url->link('lines/lines',$filter_str));
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
			
		//filter
		$filter_str='';			
		$this->data['filter_area']='';				
		if (isset($this->request->get['filter_area'])) {
			$this->data['filter_area']=$this->request->get['filter_area'];
			$filter_str .= "&filter_area=".$this->request->get['filter_area'];
		}	
			
		//buttons
		if (!isset($this->request->get['line_id'])) {
			$this->data['action'] = $this->url->link('lines/lines/insert',$filter_str);
		} else {
			$this->data['action'] = $this->url->link('lines/lines/update',$filter_str);
		}	
		$this->data['cancel'] = $this->url->link('lines/lines',$filter_str);
		
		//line data
		$line_info=array();	
		
		if (isset($this->request->get['line_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$line_info = $this->model_lines_lines->getLine($this->request->get['line_id']);
    	}

		$this->data['line_info']	=	$line_info;
		
		if(isset($line_info['accommodation_fee'])){		
			$this->data['accommodation_fee'] = json_decode($line_info['accommodation_fee'],true);
		}
		else{
			$this->data['accommodation_fee'] = array(1=>array(0=>0,1=>0), 2=>array(0=>0,1=>0), 3=>array(0=>0,1=>0), 4=>array(0=>0,1=>0));
		}	
		
		$this->data['areas'] = $this->model_lines_lines->getAreas();
		$this->data['fromcitys'] = $this->model_lines_lines->getFromcitys();
		$this->data['endcitys'] = $this->model_lines_lines->getEndcitys();
		
		$attractions = $this->model_lines_lines->getAttractions();
		$this->data['attractions'] = $attractions?$attractions:array();
		$this->data['attractions_selected'] = isset($line_info['main_attractions'])?($line_info['main_attractions']?json_decode($line_info['main_attractions']):array()):array();
		
		$boardinglocations = $this->model_lines_lines->getBoardingLocations();
		$this->data['boardinglocations'] = $boardinglocations?$boardinglocations:array();
		$this->data['boardinglocations_selected'] = isset($line_info['boarding_locations'])?($line_info['boarding_locations']?json_decode($line_info['boarding_locations']):array()):array();
		
		$this->data['token'] = rand(1, 100000000);
		
		$this->session->data['token'] = $this->data['token'];
		
		//render:
		$this->template = 'lines/lines_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function update() {

		$this->load->model('lines/lines');
	
		$url="";
		
		//filter
		$filter_str='';			
		$this->data['filter_area']='';				
		if (isset($this->request->get['filter_area'])) {
			$this->data['filter_area']=$this->request->get['filter_area'];
			$filter_str .= "&filter_area=".$this->request->get['filter_area'];
		}	
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				
			$this->model_lines_lines->update_line($this->request->post);
				
			$this->session->data['success'] = "Changes have been saved!";
			
			$this->redirect($this->url->link('lines/lines',$filter_str));
		}

	}
  
}
?>
