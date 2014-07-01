<?php  
class ControllerCommonPayment extends Controller {
	
	public function paypal_ipn(){
	
		//reading raw POST data from input stream. reading pot data from $_POST may cause serialization issues since POST data may contain arrays
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval)
		{
		  $keyval = explode ('=', $keyval);
		  if (count($keyval) == 2)
			 $myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc'))
		{
		   $get_magic_quotes_exits = true;
		} 
		foreach ($myPost as $key => $value)
		{        
		   if($get_magic_quotes_exits == true && get_magic_quotes_gpc() == 1)
		   { 
				$value = urlencode(stripslashes($value)); 
		   }
		   else
		   {
				$value = urlencode($value);
		   }
		   $req .= "&$key=$value";
		}
		 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.paypal.com/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www.paypal.com'));
		// In wamp like environment where the root authority certificate doesn't comes in the bundle, you need
		// to download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
		// of the certificate as shown below.
		// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
		$res = curl_exec($ch);
		curl_close($ch);

		/*
		echo '<pre>';
		print_r($_POST);
		die();
		*/

		//Variables:
		$receiver_email = 'glcolin@hotmail.com';

		//check receiver and currency code
		if($_POST['receiver_email'] != $receiver_email){
			die('Err - 001');
		}
		if($_POST['mc_currency'] != 'USD'){
			die('Err - 002');
		}

		 if (strcmp ($res, "VERIFIED") == 0) {
			// check the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your Primary PayPal email
			// check that payment_amount/payment_currency are correct
			// process payment
			if($payment_status =='Completed'){
	
				//retrieve data	
				$integral = $this->user->getIntegral();
				//$this->request->post['custom'] = "0|2,6,7,8";
				$custom_arr = explode("|",$this->request->post['custom']);
				$using_integral = $custom_arr[0]?$custom_arr[0]:0;
				$using_integral = $using_integral<=$integral?$using_integral:$integral;
				$custom_str = $custom_arr[1];
				$arr = explode(",",$custom_str);
				$user_id = $arr[0];
				unset($arr[0]);
				$order_ids = $arr;
				
				$data=array(
					'order_ids' => $order_ids
				);
				$user_unpaid_orders = $this->model_common_payment->getUserUnpaidOrders($data);
				
				$this->data['orders'] = array();
		
				$i=0;
				$total_price = 0;
				$total_integral = 0;
				$orders_number = "";
				
				$attractions = $this->model_common_payment->getAttractions();
				$this->data['attractions'] = $attractions; 
				$fromcitys = $this->model_common_payment->getFromcitys();
				$endcitys = $this->model_common_payment->getEndcitys();
				foreach($user_unpaid_orders as $user_unpaid_order){
					if(date('Y-m-d',strtotime($user_unpaid_order['departure_date'])) >= date('Y-m-d')){
						//order
						$this->data['orders'][$i]['order_detail'] = $user_unpaid_order;
						$accommodation_arr = json_decode(htmlspecialchars_decode($user_unpaid_order['accommodation']),true);
						$accommodation_str = "";
						if($accommodation_arr){
							foreach($accommodation_arr as $key=>$room){
								$accommodation_str .= "房间".($key+1).": ";
								$accommodation_str .= "成人 ".$room[0].", ";
								$accommodation_str .= "小孩 ".$room[1]."; &nbsp;&nbsp;&nbsp;&nbsp;";
							}
						}
						$this->data['orders'][$i]['order_detail']['accommodation_str'] = $accommodation_str;
						
						//line
						$data=array(
							"id" => $user_unpaid_order['line']
						);
						$line = $this->model_common_payment->getLine($data);
						$this->data['orders'][$i]['line_detail'] = $line;
						
						$main_attractions = $line['main_attractions']?json_decode($line['main_attractions']):array();
						$main_attractions_str = "";
						foreach($main_attractions as $main_attraction){
							if(isset($attractions[$main_attraction])){
								if($main_attractions_str != ""){
									$main_attractions_str .= " , ";
								}    
								$main_attractions_str .= $attractions[$main_attraction];
							}    
						}
						$this->data['orders'][$i]['main_attractions_str'] = $main_attractions_str;
						
						$total_price += $user_unpaid_order['total_price'];
						$total_integral += $user_unpaid_order['integral'];
						
						if($i==0){
							$orders_number = $user_unpaid_order['number'];
						}
						else{
							$orders_number .= ','.$user_unpaid_order['number'];
						}
						
						$i++;
					}
				}
				
				$total_price_result = $total_price - $using_integral;
				$integral_result = $integral - $using_integral + $total_integral;
				
				$data = array(
					"user_id" => $this->user->getUserId(),
					"integral" => $integral_result
				);
				$this->model_common_payment->updateUserIntegral($data);
				
				$data=array(
					'order_ids' => $order_ids
				);
				$this->model_common_payment->updateUserUnpaidOrders($data);
				//send text message
				
				$orders = $this->data['orders'];
				
				//Send mail: 
				//subject
				$subject = '旅游线路订单 - U-Save Travel Website';
				//body
				$body = '';
				$body .= '<div><b>订单号: '.$orders_number.'</b></div>';
				$body .= '
				<div style="border:2px #ddd solid;padding:5px;">
					<table style="border:2px #ddd solid;width:100%;padding:5px;">
						<tr style="border-bottom:1px #eee solid;min-height:50px;padding:5px;font-weight:bold;font-size:120%;background:#eee;" height="50">
							<td style="text-align:center;">详细信息</td>
							<td style="text-align:center;width:150px;">积分</td>
							<td style="text-align:center;width:150px;">单价</td>
						</tr>';
						
						foreach($orders as $order){
						$body .= '<tr style="border-bottom:1px #eee solid;min-height:50px;padding:5px;">
							<td style="padding:15px;padding-left:50px;">'.
							'<b style="color:#3CC800">路线信息:</b>'."<br>".
							'<b>路线名称:</b>'.$order['line_detail']['title']."<br>".
							'<b>路线编号:</b>'.$order['line_detail']['serial_number']."<br>".
							(isset($fromcitys[$order['line_detail']['from_city']])?'<b>出发城市:</b>'.$fromcitys[$order['line_detail']['from_city']]:"")."<br>".
							$order['main_attractions_str']."<br>".
							(isset($endcitys[$order['line_detail']['end_city']])?'<b>结束城市:</b>'.$endcitys[$order['line_detail']['end_city']]:"")."<br>".
		
							'<b style="color:#3CC800">订单信息:</b>'."<br>".
							'<b>出发日期:</b>'.$order['order_detail']['departure_date']."<br>".
							'<b>上车地点:</b>'.$order['order_detail']['boarding_location']."<br>".
							'<b>房间信息:</b>'.$order['order_detail']['accommodation_str']."<br>".
							'<b>联系人名字:</b>'.$order['order_detail']['contact']."<br>".
							'<b>联系人电话:</b>'.$order['order_detail']['phone']."<br>".
							'</td>
							<td style="text-align:center;width:60px;color:orange;">'.$order['order_detail']['integral'].'点</td>
							<td style="text-align:center;width:60px;">$'.$order['order_detail']['total_price'].'</td>
						</tr>';
						}
			$body .= '</table>
				</div>
				<p style="text-align:right;padding:20px;font-size:16px;font-weight:bold;padding-bottom:0;padding-right:25px;">小计: <font style="color:#3CC800">$<span id="subtotal">'.$total_price.'</span></font></p>
				<p style="text-align:right;padding:20px;font-size:16px;font-weight:bold;padding-bottom:0;padding-right:25px;">- 折扣值: <font style="color:#3CC800">$<span id="discount">'.$using_integral.'</span></font></p>
				<p style="text-align:right;padding:20px;font-size:16px;font-weight:bold;padding-bottom:0;padding-right:25px;">(实际支付)总计: <font style="color:#3CC800">$<span id="total">'.$total_price_result.'</span></font></p>
			</div>
				';
			 
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
				$this->mail->SetFrom('webmailingservice@gmail.com','HanlanTravel.com');
				$this->mail->Subject = $subject;
				$this->mail->Body = $body;
				$this->mail->AddAddress($email);
				if($this->mail->Send()){
					
				}
			
			}//end payment_status
		}// end strcmp($res, "VERIFIED")==0
		
	}//end paypal_ipn
	
}
?>