<?php  
class ControllerInformationsInformations extends Controller {
	public function index() {
		$this->document->setTitle("ยรำฮืสัถ");
	
		$this->load->model('informations/informations');
		
		$category = "";
		$this->data['category'] = "";
		if(isset($this->request->get['category'])){
			$this->data['category'] = $this->request->get['category'];
			$category = $this->request->get['category'];
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$limit = 10;
		
		//get informations
		$data=array(
			'category' => $this->data['category'],
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
		$informations = $this->model_informations_informations->getInformations($data);
		$this->data['informations'] = $informations;
		$data=array(
			'category' => $this->data['category']
		);
		$informations_all = $this->model_informations_informations->getInformations($data);
		$items_count = count($informations_all);
	
		//pagination
		$route = $this->request->get['route'];
		
		$pagination = new Pagination();
		$pagination->total = $items_count;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link($route, 'category='.$category.'&page={page}', 'SSL');
		$this->data['pagination'] = $pagination->render();
	
		$categories = $this->model_informations_informations->getCategories();
		
		$this->data['categories'] = array();
		foreach($categories as $category){
			$data=array(
				'category' => $category['id'],
				'start' => 0,
				'limit' => 5
			);
			$items = $this->model_informations_informations->getInformations($data);
			$this->data['categories'][$category['id']] = array(
				"info" => $category,
				"items" => $items
			);
		}
	
		$this->template = 'informations/informations.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left_information'
		);
								
		$this->response->setOutput($this->render());
	}
}
?>