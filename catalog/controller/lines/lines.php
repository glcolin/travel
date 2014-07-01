<?php  
class ControllerLinesLines extends Controller {
	public function index() {
		$this->document->setTitle("бцсноъб╥");
	
		$this->load->model('lines/lines');
		
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$limit = 10;
		
		$fromcity = "";
		$endcity = "";
		$attraction = "";
		$days = "";
		$area = "";
		$url = "";
		
		if (isset($this->request->get['fromcity'])) {
			$fromcity = $this->request->get['fromcity'];
			$url .= "fromcity=".$fromcity;
		}
		if (isset($this->request->get['attraction'])) {
			$attraction = $this->request->get['attraction'];
			$url .= "&attraction=".$attraction;
		}
		if (isset($this->request->get['days'])) {
			$days = $this->request->get['days'];
			$url .= "&days=".$days;
		}
		if (isset($this->request->get['area'])) {
			$area = $this->request->get['area'];
			$url .= "&area=".$area;
		}

		if($this->request->post){
			//if($this->request->post['search_days']){
				$days = $this->request->post['search_days'];
				$this->session->data['search_days'] = $days;
			//}
			//if($this->request->post['search_fromcity']){
				$fromcity = $this->request->post['search_fromcity'];
				$this->session->data['search_fromcity'] = $fromcity;
			//}
			//if($this->request->post['search_endcity']){
				$endcity = $this->request->post['search_endcity'];
				$this->session->data['search_endcity'] = $endcity;
			//}
		}

		$this->data['fromcity'] = $fromcity;
		$this->data['attraction'] = $attraction;
		$this->data['days'] = $days;
		$this->data['area'] = $area;
		
		//get lines
		$data=array(
			'from_city' => $fromcity,
			'end_city' => $endcity,
			'attraction' => $attraction,
			'days' => $days,
			'area' => $area,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
		$this->data['lines'] = $this->model_lines_lines->getLines($data);
		
		$data=array(
			'from_city' => $fromcity,
			'end_city' => $endcity,
			'attraction' => $attraction,
			'days' => $days,
			'area' => $area
		);
		$items_count = count($this->model_lines_lines->getLines($data));
		
		$this->data['attractions'] = $this->model_lines_lines->getAttractions();
		$this->data['fromcitys'] = $this->model_lines_lines->getFromcitys();
		$this->data['alldays'] = $this->model_lines_lines->getAlldays();
		$this->data['endcitys'] = $this->model_lines_lines->getEndcitys();

		//pagination
		$route = $this->request->get['route'];
		
		$pagination = new Pagination();
		$pagination->total = $items_count;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link($route, $url.'&page={page}', 'SSL');
		$this->data['pagination'] = $pagination->render();

		$this->template = 'lines/lines.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left'
		);
								
		$this->response->setOutput($this->render());
	}
}
?>