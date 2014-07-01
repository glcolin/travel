<?php echo $header;?>

<link type="text/css" href="./catalog/view/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type=text/javascript src="./catalog/view/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript">
	var ticket_success = '<?php echo $ticket_success;?>';
	$(function() {
		if(ticket_success == 1){
			alert("提交成功");
		}
		$('input[name="departure_date"]').datepicker({ dateFormat: 'yy-mm-dd' });
		$('input[name="return_date"]').datepicker({ dateFormat: 'yy-mm-dd' });
	});
</script>

<div id="wrapper"> 
  <!--网页主体内容开始-->
  <div id="main">
    <div id="Hop2Widget" style="margin-top:30px;float:left;"><!--start-->
		<script type="text/javascript" id="loadHop2WidgetProperties">
		hop2_widget_client = "hop2";
		hop2_widget_width = 275;
		hop2_widget_height = 450;
		hop2_widget_size = "275x450";
		hop2_widget_url = "www.Hop2.com";
		hop2_cid = "K2J5P8";
		hop2_target = "www.Hop2.com";
		hop2_lng = "zh_cn";
		</script>
		<script id="loadHop2Widget" type="text/javascript" src="http://s3.amazonaws.com/www.hop2.com/js/widgetload.js"></script>
	</div><!--end form-->
	
	<div style="float:left;width:680px;margin-top:30px;margin-left:20px;margin-bottom:30px;border-top:2px #3CC800 solid;background:#FFF;">
		<h3 style="font-size:16px;font-weight:bold;padding:5px;">订票说明</h3>
		<p style="font-size:13px;line-height:2em;padding:5px;">	在本网站订购飞机票不仅是十分平宜,而且也十分简单方便.填写左边的表格能马上在网上通过信用卡订购各种各样的各个行班的飞机票.但同时,你也能选择通过填写以下的表格并提交,我们会迅速查看你的要求,并在很短的时间内进行回复,并帮助您快速订购到你所需要的机票.
		</p>
	</div>
	
	<div style="float:left;width:680px;min-height:400px;margin-left:20px;margin-bottom:30px;border-top:2px #3CC800 solid;background:#FFF;padding-top:10px;">

		
		
<form id="flights" action="./index.php?route=book/flight/add_ticket" enctype="multipart/form-data" method="post"> 
<h3 style="font-size:16px;font-weight:bold;padding:5px;margin-bottom:10px;">机票咨询表格</h3>	
 		
<table width="670" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#EEE;">

<tr class="xiantiao">
<td width="20%" align="right">联系人姓名:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="name" size="30" /></td>
<td align="right"></td>
<td align="left"></td>
</tr>

<tr class="xiantiao">
<td align="right">联系人电话号码:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="phone" size="30" /></td>
<td width="42%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">联系人电子邮箱:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="email" size="30" /></td>
<td width="42%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">机票类型:&nbsp;&nbsp;</td>
<td>&nbsp;<input name="ticket_type" type="radio" value="来回" checked="checked" />
来回
<input name="ticket_type" type="radio" value="单程" />
单程</td>
<td width="42%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">出发地:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="departure_address" size="30" /></td>
<td width="42%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">目的地:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="destination_address" size="30" /></td>
<td width="42%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">出发日期:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="departure_date" size="30" /></td>
<td width="42%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">回程日期:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="return_date" size="30" /></td>
<td width="42%" align="left" style="color:red;">&nbsp;&nbsp;(如果是单程机票,此处可以留空)</td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">旅客数量:&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;大人:&nbsp;
<select name="adult_number">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>
&nbsp;&nbsp;小孩:&nbsp;
<select name="child_number">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>
</td>
<td width="42%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right"></td>
<td><input type="submit" value=" 提交 "/></td>
<td width="42%" align="left"></td>
<td width="12%"></td>
</tr>

</table>

		</form>
	</div>
	
	<div style="clear:both;"></div>
	
  </div>
  
  <script>
  //$('document').ready(function(){
  //	document.getElementById("Engine").contentWindow.document.body.style.backgroundColor="blue";
  </script>
  
<?php echo $footer;?>
