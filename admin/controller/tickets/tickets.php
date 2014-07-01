<?php 
class ControllerTicketsTickets extends Controller {
     
  	public function index() {
		$this->document->setTitle("机票管理");

		$this->load->model('tickets/tickets');

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
		
		$filter_number = "";
		if (isset($this->request->get['filter_number'])) {
			$filter_number = $this->request->get['filter_number'];
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		$limit = 30;
		
		$this->data['filter_number'] = $filter_number;
		$data = array(
			'filter_number' => $filter_number,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
		$tickets=$this->model_tickets_tickets->getTotalTickets($data);
		$data = array(
			'filter_number' => $filter_number
		);
		$tickets_total=$this->model_tickets_tickets->getTotalTickets($data);
		$items_count=count($tickets_total);
		
		//pagination
		$route = $this->request->get['route'];
		
		$pagination = new Pagination();
		$pagination->total = $items_count;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link($route, 'filter_number='.$filter_number.'&page={page}');
		$this->data['pagination'] = $pagination->render();
		
		$this->data['tickets'] = array();
		
		foreach ($tickets as $ticket) {
			$sort_default[]=$ticket['id'];
			
			$action = array();
			
			$action[] = array(
				'text' => 'View',
				'href' => $this->url->link('tickets/tickets/edit', '&id=' . $ticket['id'])
			);
			
			$this->data['tickets'][$ticket['id']]=array(
				"info" => json_decode($ticket['content'],true),
				"number" => $ticket['number'],
				"create_date" => $ticket['create_date'],
				"action" => $action
			);
		}
		
		//button url:	
		$this->data['insert'] = $this->url->link('tickets/tickets/addnew');	
		$this->data['delete'] = $this->url->link('tickets/tickets/delete');	
		
		//render:
		$this->template = 'tickets/tickets_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		
		$this->response->setOutput($this->render());
	}
	
	/*public function saveSort(){
		$this->load->model('tickets/tickets');
		$this->model_tickets_tickets->saveSort($this->request->post);
	}	*/
	
	
	public function edit() {
    	//$this->language->load('tickets/tickets');

    	$this->document->setTitle("机票管理");
		
		$this->load->model('tickets/tickets');
		
		$this->session->data['success']="";
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_tickets_tickets->editTicket($this->request->get['id'], $this->request->post);
			
			$this->session->data['success'] = "Changes have been saved!";
			
			$url = '';
			
			$this->redirect($this->url->link('tickets/tickets', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			
		//buttons
		if (!isset($this->request->get['id'])) {
			$this->data['action'] = $this->url->link('tickets/tickets/insert');
		} else {
			$this->data['action'] = $this->url->link('tickets/tickets/update');
		}	
		$this->data['cancel'] = $this->url->link('tickets/tickets');
		
		//ticket data
		$ticket_info=array();	
		$unpaidTickets=array();	
		$paidTickets=array();	
		$lines=array();
		
		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$ticket_info = $this->model_tickets_tickets->getTicket($this->request->get['id']);
    	}

		$this->data['ticket_info'] = array(
			"info" => $ticket_info,
			"content" => json_decode($ticket_info['content'],true)
			);
		
		//render:
		$this->template = 'tickets/tickets_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
  
}
?>
