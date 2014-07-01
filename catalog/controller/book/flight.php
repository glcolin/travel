<?php  
class ControllerBookFlight extends Controller {
	public function index() {
	
		$this->document->setTitle("机票搜索");
		
		if (isset($this->session->data['ticket_success'])) {
    		$this->data['ticket_success'] = $this->session->data['ticket_success'];
			unset($this->session->data['ticket_success']);
		} else {
			$this->data['ticket_success'] = 0;
		}	
		
		$this->template = 'book/flight.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left'
		);
										
		$this->response->setOutput($this->render());
	}
	
	public function add_ticket(){
		$this->load->model('book/flight');
		$content = $this->request->post;
		$this->session->data['ticket_success'] = 0;
		$number = "TK".date('Ymdhis');
		$this->model_book_flight->add_ticket($content,$number);
		$this->session->data['ticket_success'] = 1;

		//Send mail: 
		//subject
		$subject = '机票咨询 '.$number.' - U-Save Travel Website';
		//body
		$body = '';
		$body .= '<div><b>编号: '.$number.'</b></div>';
		$body .= '
		<div>
		<table width="670" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#EEE;">
		
		<tr class="xiantiao">
		<td width="20%" align="right">联系人姓名:&nbsp;&nbsp;</td>
		<td>'.$content['name'].'</td>
		<td align="right"></td>
		<td align="left"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">联系人电话号码:&nbsp;&nbsp;</td>
		<td>'.$content['phone'].'</td>
		<td width="42%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">联系人电子邮箱:&nbsp;&nbsp;</td>
		<td>'.$content['email'].'</td>
		<td width="42%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">机票类型:&nbsp;&nbsp;</td>
		<td>'.$content['ticket_type'].'</td>
		<td width="42%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">出发地:&nbsp;&nbsp;</td>
		<td>'.$content['departure_address'].'</td>
		<td width="42%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">目的地:&nbsp;&nbsp;</td>
		<td>'.$content['destination_address'].'</td>
		<td width="42%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">出发日期:&nbsp;&nbsp;</td>
		<td>'.$content['departure_date'].'</td>
		<td width="42%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">回程日期:&nbsp;&nbsp;</td>
		<td>'.$content['return_date'].'</td>
		<td width="42%"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">旅客数量:&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;大人:&nbsp;
		'.$content['adult_number'].'
		&nbsp;&nbsp;小孩:&nbsp;
		'.$content['child_number'].'
		</td>
		<td width="42%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		</table>
		</div>';
	 
		$email = $content['email'];
		
		//call phpmailer
		$this->mail->IsSMTP(); // enable SMTP
		$this->mail->CharSet="UTF-8";
		$this->mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
		$this->mail->SMTPAuth = true; // authentication enabled
		$this->mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$this->mail->Host = "smtp.gmail.com";
		$this->mail->Port = 465; // or 587
		$this->mail->IsHTML(true);
		$this->mail->Username = "webmailingservice@gmail.com";
		$this->mail->Password = "webmailingservice1986";
		$this->mail->SetFrom('webmailingservice@gmail.com','HanlanTravel.com');
		$this->mail->Subject = $subject;
		$this->mail->Body = $body;
		$this->mail->AddAddress($email);
		if($this->mail->Send()){
			
		}
		
		$this->redirect($this->url->link('book/flight'));
	}
}
?>