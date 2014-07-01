<?php  
class ControllerInformationsInformation extends Controller {
	public function index() {
		$this->document->setTitle("旅游资讯");
	
		$this->load->model('informations/information');
		
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
		
		//get information information
		$data=array(
			"id" => $this->request->get['id']
		);
		$information = $this->model_informations_information->getInformation($data);
		$this->data['information'] = $information;
		
		$this->data['author'] = $this->model_informations_information->getAuthorName($information['author']);
		
		$this->session->data['seokeywords'] = $information['seo_keywords'];
		$this->session->data['seodescription'] = $information['seo_description'];
	
		$categories = $this->model_informations_information->getCategories();
		
		$this->data['categories'] = array();
		foreach($categories as $category){
			$data=array(
				'category' => $category['id'],
				'start' => 0,
				'limit' => 5
			);
			$items = $this->model_informations_information->getInformations($data);
			$this->data['categories'][$category['id']] = array(
				"info" => $category,
				"items" => $items
			);
		}
	
		$this->template = 'informations/information.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left_information'
		);
										
		$this->response->setOutput($this->render());
	}
	
	public function check_fee(){
		echo $this->count_price($this->request->post);
	}
	
	public function count_price($post){
		$this->load->model('informations/information');
		$order_rooms_data = json_decode(htmlspecialchars_decode($post['order_rooms_data']),true);
		$data=array(
			"id" => $post['id']
		);
		$information = $this->model_informations_information->getInformation($data);
		$accommodation_fee = json_decode($information['accommodation_fee'],true);

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
		return $total_price;
	}
	
	public function place_an_order(){
		if ($this->user->isLogged("front")){
			$this->load->model('informations/information');
			$data=$this->request->post;
			$data['user_id']=$this->user->getUserId();
			$data['total_price']=$this->count_price($this->request->post);
			$this->model_informations_information->place_an_order($data);
			$this->session->data['success_order'] = "下单成功，请你的个人中心付款";
			$this->redirect($this->url->link('informations/information','id='.$this->request->post['id']));
		}
		else{
			$this->session->data['warning_order'] = "请先登录";
			$this->redirect($this->url->link('informations/information','id='.$this->request->post['id']));
		}
	}
}
?>