<?php echo $header;?>
<link type="text/css" href="./catalog/view/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type=text/javascript src="./catalog/view/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript">
	var grouptour_success = '<?php echo $grouptour_success;?>';
	$(function() {
		if(grouptour_success == 1){
			alert("提交成功");
		}
		$('input[name="departure_date"]').datepicker({ dateFormat: 'yy-mm-dd' });
		$('input[name="return_date"]').datepicker({ dateFormat: 'yy-mm-dd' });
	});
</script>
    
<div id="wrapper"> 
  <!--网页主体内容开始-->
  
  
  
  <div id="main">
  
  <?php echo $column_left_information;?>
  
  <div class="f_r bb2 box mar_b_02  White1">
  <div class="beijing">游游包团</div>
 


 
<form action="./index.php?route=grouptour/grouptour/add_grouptour" enctype="multipart/form-data" method="post">  
<table width="670" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#EEE;">

 <!-- division -->
<tr class="xiantiao" style="background:#FFF;font-weight:bold;">
<td>&nbsp;联系基本信息</td>
<td></td>
<td></td>
<td></td>
</tr>
  
<tr class="xiantiao">
<td width="20%" align="right">联系人姓名:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="name" size="30" /></td>
<td align="right"></td>
<td align="left"></td>
</tr>

<tr class="xiantiao">
<td align="right">联系人电话号码:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="phone" size="30" /></td>
<td width="11%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">联系人电子邮箱:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="email" size="30" /></td>
<td width="11%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">参团人数:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="number" size="5" /></td>
<td width="11%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">所在地:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="address" size="30" /></td>
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
<td><input class="text" type="text" name="departure_date" size="30" /></td>
<td align="right"></td>
<td align="left"></td>
</tr>

<tr class="xiantiao">
<td align="right">预计回程日期:&nbsp;&nbsp;</td>
<td><input class="text" type="text" name="return_date" size="30" /></td>
<td width="11%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">签证:&nbsp;&nbsp;</td>
<td>&nbsp;<input name="certificate" type="radio" value="已有" checked="checked">&nbsp;已有&nbsp;&nbsp;<input name="certificate" type="radio" value="未办理">&nbsp;未办理&nbsp;&nbsp;<input name="certificate" type="radio" value="正在办理">&nbsp;正在办理</td>
<td width="11%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">国际机票:&nbsp;&nbsp;</td>
<td>&nbsp;<input name="air_ticket" type="radio" value="已定" checked="checked">&nbsp;已定&nbsp;&nbsp;<input name="air_ticket" type="radio" value="未定">&nbsp;未定&nbsp;</td>
<td width="11%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">餐饮:&nbsp;&nbsp;</td>
<td>&nbsp;<input name="repast" type="radio" value="全程含餐" checked="checked">&nbsp;全程含餐&nbsp;&nbsp;<input name="repast" type="radio" value="全程不含餐">&nbsp;全程不含餐&nbsp;</td>
<td width="11%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">导游:&nbsp;&nbsp;</td>
<td>&nbsp;<input name="guide" type="radio" value="专业导游" checked="checked">&nbsp;专业导游&nbsp;&nbsp;<input name="guide" type="radio" value="司机兼导游">&nbsp;司机兼导游&nbsp;</td>
<td width="11%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right">租车:&nbsp;&nbsp;</td>
<td>&nbsp;<input name="taxi" type="radio" value="需要" checked="checked">&nbsp;需要&nbsp;&nbsp;<input name="taxi" type="radio" value="不需要">&nbsp;不需要&nbsp;</td>
<td width="11%" align="right"></td>
<td width="12%"></td>
</tr>

<tr class="xiantiao">
<td align="right" width="25%;">行程信息:&nbsp;&nbsp;</td>
<td colspan="3"><textarea name="message" style="line-height:25px;height:180px;width:420px;border:1px solid #dddddd;margin-top:8px;margin-bottom:8px;"></textarea></td>
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
<td colspan="3"><textarea name="other_message" style="line-height:25px;height:180px;width:420px;border:1px solid #dddddd;margin-top:8px;margin-bottom:8px;"></textarea></td>
</tr>

</table>
  
<input type="submit" style="margin:22px;height:50px;width:120px;font-size:17px;cursor:pointer;" value="提交表格" />
</form>  
  
  
  
  
  
  
  
  
  </div>
  
  
 <div class="clear"></div>
  </div>
  
  
  
  <div class="clear"></div>
  
<?php echo $footer;?>