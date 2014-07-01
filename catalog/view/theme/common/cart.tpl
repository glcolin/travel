<?php echo $header;?>
<script type=text/javascript src="./catalog/view/js/cart.js"></script>

<script type="text/javascript">
$(function(){
	var integral = '<?php echo $integral;?>';
	var using_integral = parseInt($("#using_integral").val());
	var subtotal = parseInt($("#subtotal").text());
	var total = parseInt(subtotal - using_integral);
	var custom_var = $('input[name="custom"]').val();
	var custom_arr = custom_var.split('|');
	custom_arr[0] = using_integral;
	$('input[name="custom"]').val(custom_arr[0]+'|'+custom_arr[1]);
	$("#discount").text(using_integral);
	$("#total").text(total);
	$('input[name="discount_amount_cart"]').val(using_integral);
	
	$("#using_integral").change(function(){
		using_integral = parseInt($("#using_integral").val());
		total = parseInt(subtotal - using_integral);
		
		if(integral < using_integral) using_integral = integral;
		if(total < 0) total = 0;
		if(subtotal < using_integral) using_integral = parseInt(subtotal);
		
		custom_arr[0] = using_integral;
		$('input[name="custom"]').val(custom_arr[0]+'|'+custom_arr[1]);
		$("#using_integral").val(using_integral);
		$("#discount").text(using_integral);
		$("#total").text(total);
		$('input[name="discount_amount_cart"]').val(using_integral);
	});
})
</script>

<style>
.cart-main{
	min-height:600px;
}
.cart-status img{
	width:100%;
}
.cart-title {
vertical-align:middle; 
margin-top:10px;
text-align:left;
}
.cart-title img{
float:left;
}
.cart-message{
margin-top:10px;
margin-bottom:20px;
text-align:left;
}
.cart-status{
	color:#11B000
}
.cart-items{
text-align:left;
}
.cart-items table > tr{
min-height:50px;
}
</style>

<div id="wrapper"> 
<!--网页主体内容开始-->
  <div id="main">
  	<!--网页主体内容开始-->
  	<div class="White cart-main" align="center">
   		<div class="cart-status"><img src="./catalog/view/images/cart1.png" /></div>
        <div class="cart-message"><span class="cart-status">温馨提示: </span>1.选购清单中的商品无法保留库存，请你及时结算。 2.商品的价格和库存将以订单提交时为准。</div>
		<div style="border:2px #ddd solid;padding:5px;">
			<table style="border:2px #ddd solid;width:100%;padding:5px;">
				<tr style="border-bottom:1px #eee solid;min-height:50px;padding:5px;font-weight:bold;font-size:120%;background:#eee;" height="50">
					<td style="text-align:center;width:60px;">删除选项</td>
					<td style="text-align:center;">详细信息</td>
                    <td style="text-align:center;width:150px;">积分</td>
					<td style="text-align:center;width:150px;">单价</td>
				</tr>
                <?php $total_price=0;?>
                <?php foreach($orders as $order){?>
				<tr style="border-bottom:1px #eee solid;min-height:50px;padding:5px;">
					<td style="text-align:center;width:60px;"><a href="#" data-id="<?php echo $order['order_detail']['id'];?>" class="cart-delete"><img src="/catalog/view/images/del.png"/></a></td>
					<td style="padding:15px;padding-left:50px;"><?php echo 
                    "<b style='color:#3CC800'>路线信息:</b>"."<br>".
                    "<b>路线名称:</b>".$order['line_detail']['title']."<br>".
                    "<b>路线编号:</b>".$order['line_detail']['serial_number']."<br>".
                    (isset($fromcitys[$order['line_detail']['from_city']])?"<b>出发城市:</b>".$fromcitys[$order['line_detail']['from_city']]:"")."<br>".
                    $order['main_attractions_str']."<br>".
                    (isset($endcitys[$order['line_detail']['end_city']])?"<b>结束城市:</b>".$endcitys[$order['line_detail']['end_city']]:"")."<br>".
                    
                    "<b style='color:#3CC800'>订单信息:</b>"."<br>".
                    "<b>出发日期:</b>".$order['order_detail']['departure_date']."<br>".
                    "<b>上车地点:</b>".$order['order_detail']['boarding_location']."<br>".
                    "<b>房间信息:</b>".$order['order_detail']['accommodation_str']."<br>".
                    "<b>联系人名字:</b>".$order['order_detail']['contact']."<br>".
                    "<b>联系人电话:</b>".$order['order_detail']['phone']."<br>";
                    ?></td>
                    <td style="text-align:center;width:60px;color:orange;"><?php echo $order['order_detail']['integral'];?>点</td>
					<td style="text-align:center;width:60px;">$<?php echo $order['order_detail']['total_price'];?></td>
				</tr>
                <?php $total_price += $order['order_detail']['total_price'];?>
                <?php }?>
			</table>
		</div>
        <p style="text-align:right;padding:20px;font-size:16px;font-weight:bold;padding-bottom:0;padding-right:25px;">可用积分： <font style='color:#FFA500'><?php echo $integral;?></font>, 本次使用积分:<input type="text" onkeyup="value=value.replace(/[^\d]/g,'')" style="text-align:center" size="5" id="using_integral" name="using_integral" value="0" /></p>
        <p style="text-align:right;padding:20px;font-size:16px;font-weight:bold;padding-bottom:0;padding-right:25px;">小计: <font style='color:#3CC800'>$<span id="subtotal"><?php echo $total_price;?></span></font></p>
        <p style="text-align:right;padding:20px;font-size:16px;font-weight:bold;padding-bottom:0;padding-right:25px;">- 折扣值: <font style='color:#3CC800'>$<span id="discount">0</span></font></p>
		<p style="text-align:right;padding:20px;font-size:16px;font-weight:bold;padding-bottom:0;padding-right:25px;">(实际支付)总计: <font style='color:#3CC800'>$<span id="total"><?php echo $total_price;?></span></font></p>
		<p style="text-align:right;padding:20px;cursor:pointer;"><img onclick="$('#paypal_form').submit();" src="catalog/view/images/paynow.png" width="180" border="0" /></p>
    </div>

<!-- Begin PayPal Button -->
<form style="display:none;" action="https://www.paypal.com/cgi-bin/webscr" method="post" class="paypal_btn" id="paypal_form"> 
	<input type="hidden" value="utf-8" name="charset"> 
	<input type="hidden" name="cmd" value="_cart"> 
	<input type="hidden" name="upload" value="1"> 
	<input type="hidden" name="business" value="glcolin@hotmail.com">
	<input type="hidden" name="currency_code" value="US"> 
	<?php $i = 0;?>
	<?php foreach($orders as $order){?>
		<?php $i++;?>
		<input type="hidden" name="item_name_<?php echo $i;?>" value="<?php echo $order['line_detail']['title'];?>"> 
		<input type="hidden" name="amount_<?php echo $i;?>" value="<?php echo $order['order_detail']['total_price'];?>"> 
		<input type="hidden" name="quantity_<?php echo $i;?>" value="1"> 
	<?php }?>
	<input type="hidden" name="discount_amount_cart" value="0"> 
	<input TYPE="hidden" name="return" value="http://usavetrip.com">
	<input TYPE="hidden" name="cancel_return" value="http://usavetrip.com/index.php?route=common/cart">
	<input type="hidden" name="notify_url" value="http://usavetrip.com/index.php?route=common/payment/paypal_ipn"> 
	<input type="hidden" name="custom" value="<?php echo $custom;?>">
	<input style="display:none;" type="image" src="images/paypal_btn.jpg" width="150" height="30" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"> 
</form>
<!-- End PayPal Button -->

<?php echo $footer;?>