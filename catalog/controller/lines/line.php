<?php  
class ControllerLinesLine extends Controller {
	public function index() {
		$this->document->setTitle("旅游线路");
	
		$this->load->model('lines/line');
		
		if (isset($this->session->data['warning_order'])) {
			$this->data['warning_order'] = $this->session->data['warning_order'];
			unset($this->session->data['warning_order']);
		} else {
			$this->data['warning_order'] = '';
		}

		if (isset($this->session->data['success_order'])) {
    		$this->data['success_order'] = $this->session->data['success_order'];
			unset($this->session->data['success_order']);
		} else {
			$this->data['success_order'] = '';
		}
		
		if (isset($this->session->data['warning_comment'])) {
			$this->data['warning_comment'] = $this->session->data['warning_comment'];
			unset($this->session->data['warning_comment']);
		} else {
			$this->data['warning_comment'] = '';
		}

		if (isset($this->session->data['success_comment'])) {
    		$this->data['success_comment'] = $this->session->data['success_comment'];
			unset($this->session->data['success_comment']);
		} else {
			$this->data['success_comment'] = '';
		}
		
		//get line information
		$data=array(
			"id" => $this->request->get['line_id']
		);
		$line = $this->model_lines_line->getLine($data);
		$this->data['line'] = $line;
		
		$departuredates = explode(',',$line['departure_dates']);
		foreach($departuredates as $key => $departuredate){
			if(date('Y-m-d',strtotime($departuredate)) <= date('Y-m-d')){
				unset($departuredates[$key]);
			}
		}
		$this->data['departuredates'] = $departuredates;
		$this->data['banners'] = $line['images']?json_decode(htmlspecialchars_decode($line['images']),true):array();
		
		$this->data['boardinglocations_all'] = $this->model_lines_line->getBoardingLocations();
		$this->data['boardinglocations'] = $line['boarding_locations']?json_decode($line['boarding_locations']):array();
		$this->data['attractions'] = $this->model_lines_line->getAttractions();
		$this->data['fromcitys'] = $this->model_lines_line->getFromcitys();
		$this->data['endcitys'] = $this->model_lines_line->getEndcitys();
		
		if($line['accommodation_fee']){		
			$this->data['accommodation_fee'] = json_decode($line['accommodation_fee'],true);
		}
		else{
			$this->data['accommodation_fee'] = array(1=>array(0=>0,1=>0), 2=>array(0=>0,1=>0), 3=>array(0=>0,1=>0), 4=>array(0=>0,1=>0));
		}	
		
		$data=array(
			"line_id" => $this->request->get['line_id']
		);
		$comments = $this->model_lines_line->getComments($data);
		$this->data['comments'] = $comments?$comments:array();
		
		$this->session->data['seokeywords'] = $line['seo_keywords'];
		$this->session->data['seodescription'] = $line['seo_description'];
		
		$this->template = 'lines/line.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left'
		);
										
		$this->response->setOutput($this->render());
	}
	
	public function check_fee(){
		echo $this->count_price($this->request->post);
	}
	
	public function count_price($post){
		$this->load->model('lines/line');
		$order_rooms_data = $post['order_rooms_data']?json_decode(htmlspecialchars_decode($post['order_rooms_data']),true):array();
		$data=array(
			"id" => $post['line_id']
		);
		$line = $this->model_lines_line->getLine($data);
		$accommodation_fee = json_decode($line['accommodation_fee'],true);

		$total_price = 0;
		foreach($order_rooms_data as $order_room_data){
			$k=0;
			foreach($order_room_data as $person_type=>$person_number){
				for($i=1;$i<=$person_number;$i++){
					if($person_type==0){
						$k++;
						$total_price += $accommodation_fee[$i][$person_type];
					}
					else{
						$total_price += $accommodation_fee[$i+$k][$person_type];
					}	
				}
			}
		}
		return $total_price+$line['price'];
	}
	
	public function place_an_order(){
		if ($this->user->isLogged("front")){
			$this->load->model('lines/line');
			$data=$this->request->post;
			$data['user_id']=$this->user->getUserId();
			$data['total_price']=$this->count_price($this->request->post);
			$query_data=array(
				"id" => $data['line_id']
			);
			$line = $this->model_lines_line->getLine($query_data);
			$data['integral'] = $line['integral'];
			$this->model_lines_line->place_an_order($data);
			//$this->session->data['success_order'] = "下单成功，请你的购物车付款";
			$this->redirect($this->url->link('common/cart'));
		}
		else{
			//$this->session->data['warning_order'] = "请先登录";
			$this->redirect($this->url->link('common/login'));
		}
	}
	
	public function add_comment(){
		if ($this->user->isLogged("front")){
			$this->load->model('lines/line');
			$data=$this->request->post;
			$data['user_id']=$this->user->getUserId();
			$this->model_lines_line->add_comment($data);
			$this->session->data['success_comment'] = "评论成功";
			$this->redirect($this->url->link('lines/line','line_id='.$this->request->post['line_id']));
		}
		else{
			//$this->session->data['warning_comment'] = "请先登录";
			$this->redirect($this->url->link('common/login'));
		}
	}
	
}
?>