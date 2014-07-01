<?php  
class ControllerGrouptourGrouptour extends Controller {
	public function index() {
		$this->document->setTitle("旅游包团");
	
		//$this->load->model('grouptour/grouptour');
	
		if (isset($this->session->data['grouptour_success'])) {
    		$this->data['grouptour_success'] = $this->session->data['grouptour_success'];
			unset($this->session->data['grouptour_success']);
		} else {
			$this->data['grouptour_success'] = 0;
		}	
	
		$this->template = 'grouptour/grouptour.tpl';
		
		$this->children = array(
			'common/footer',
			'common/header',
			'common/column_left_information'
		);
								
		$this->response->setOutput($this->render());
	}
	
	public function add_grouptour(){
		$this->load->model('grouptour/grouptour');
		$content = $this->request->post;
		$number = "GT".date('Ymdhis');
		$this->model_grouptour_grouptour->add_grouptour($content,$number);
		$this->session->data['grouptour_success'] = 1;

		//Send mail: 
		//subject
		$subject = 'Grouptour order '.$number.' - U-Save Travel Website';
		//body
		$body = '';
		$body .= '<div><b>订单号: '.$number.'</b></div>';
		$body .= '
		<div>
		<table width="670" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#EEE;">
		<tr class="xiantiao" style="background:#FFF;font-weight:bold;">
		<td>&nbsp;联系基本信息</td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		  
		<tr class="xiantiao">
		<td width="20%" align="right">联系人姓名:&nbsp;&nbsp;</td>
		<td>'.$content['name'].'</td>
		<td align="right"></td>
		<td align="left"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">联系人电话号码:&nbsp;&nbsp;</td>
		<td>'.$content['phone'].'</td>
		<td width="11%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">联系人电子邮箱:&nbsp;&nbsp;</td>
		<td>'.$content['email'].'</td>
		<td width="11%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">参团人数:&nbsp;&nbsp;</td>
		<td>'.$content['number'].'</td>
		<td width="11%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">所在地:&nbsp;&nbsp;</td>
		<td>'.$content['address'].'</td>
		<td width="11%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		 <!-- division -->
		<tr class="xiantiao" style="background:#FFF;font-weight:bold;">
		<td>&nbsp;旅游行程基本信息</td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		  
		<tr class="xiantiao">
		<td width="20%" align="right">预计出发日期:&nbsp;&nbsp;</td>
		<td>'.$content['departure_date'].'</td>
		<td align="right"></td>
		<td align="left"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">预计回程日期:&nbsp;&nbsp;</td>
		<td>'.$content['return_date'].'</td>
		<td width="11%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">签证:&nbsp;&nbsp;</td>
		<td>'.$content['certificate'].'</td>
		<td width="11%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">国际机票:&nbsp;&nbsp;</td>
		<td>'.$content['air_ticket'].'</td>
		<td width="11%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">餐饮:&nbsp;&nbsp;</td>
		<td>'.$content['repast'].'</td>
		<td width="11%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">导游:&nbsp;&nbsp;</td>
		<td>'.$content['guide'].'</td>
		<td width="11%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right">租车:&nbsp;&nbsp;</td>
		<td>'.$content['taxi'].'</td>
		<td width="11%" align="right"></td>
		<td width="12%"></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right" width="25%;">行程信息:&nbsp;&nbsp;</td>
		<td colspan="3">'.$content['message'].'</td>
		</tr>
		
		 <!-- division -->
		<tr class="xiantiao" style="background:#FFF;font-weight:bold;">
		<td>&nbsp;其它信息</td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		
		<tr class="xiantiao">
		<td align="right" width="25%;">其它说明:&nbsp;&nbsp;</td>
		<td colspan="3">'.$content['other_message'].'</td>
		</tr>
		
		</table>
		</div>';
	 
		$email = "glcolin@hotmail.com";
		
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
		$this->mail->SetFrom('webmailingservice@gmail.com','U-Save trip');
		$this->mail->Subject = $subject;
		$this->mail->Body = $body;
		$this->mail->AddAddress($email);
		if($this->mail->Send()){
		}
		
		/*$headers[] = "X-Mailer: PHP";  
		$headers[] = "MIME-Version: 1.0";  
		$headers[] = "Content-type: text/html; charset=utf8";
		mail($email,$subject,$body,join("\r\n", $headers));*/
		
		$this->redirect($this->url->link('grouptour/grouptour'));
	}
}
?>