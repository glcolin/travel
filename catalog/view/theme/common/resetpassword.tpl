<?php echo $header;?>

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
margin-bottom:10px;
text-align:left;
}
.cart-status{
	color:#11B000
}
#info-table{
	margin:5px;
	width:670px;
}
#info-table thead{
	background:#11B000;
	color:#FFF;
	font-weight:bold;
}
#info-table tr.odd{
	background:#eeeeee;
}
#info-table td{
	padding-left:5px;
}
#info-table a{
	color:#11B000;
}
#info-table tbody tr{
	height:50px;
}
#info-table tbody input{
	border:1px #ddd solid;
	font-size:14px;
}
.active{
	background:url('./catalog/view/images/greenarrow.png') 0 12px no-repeat;
}
</style>

<div id="wrapper"> 
<!--网页主体内容开始-->
  <div id="main">
  	<!--网页主体内容开始-->
  	<div class="White cart-main" align="center">
   		<div class="cart-status"><img src="./catalog/view/images/member-center.png" /></div>
        <div class="cart-message">&nbsp;你好, <span class="cart-status"><?php echo $username;?></span>! 欢迎您来到会员中心.</div>
		  
		<div class="box f_l mods_02 mar_b_02 mar_r_01">
			<h2 class="tilv" style="text-align:left;padding-left:30px;">选项</h2>
		  <ul>
			<li style="padding-top:10px;padding-bottom:10px;padding-left:20px;border-bottom:1px solid #eeeeee;list-style:none;text-align:left;"><a href="./index.php?route=common/personalcenter">交易记录</a></li>
			<li style="padding-top:10px;padding-bottom:10px;padding-left:20px;border:0px;list-style:none;text-align:left;" class="active"><a href="./index.php?route=common/resetpassword">重设密码</a></li>
		  </ul>
		</div><!-- end left div-->
		
		<div class="box2 mar_b_02" style="float:right;width:690px;min-height:475px;border:1px #eeeeee solid;">
			<div class="titlA" style="width:680px;border-bottom:0;font-weight:normal;font-size:13px;text-align:left;">
            <form action="./index.php?route=common/resetpassword/resetPassword" method="post" enctype="multipart/form-data">
			<table id="info-table">
				<thead>
					<tr>
						<td width="100">重设密码</td>
						<td>&nbsp;</td>
					</tr>
				</thead>
				<tbody>
                	<?php if($warning){?>
                    <tr>
						<td colspan="2" style="color:#FF0000"><?php echo $warning;?></td>
					</tr>
                    <?php }?>
					<tr>
						<td class="first">旧密码:</td>
						<td><input type="password" name="old_password" size="30" /></td>
					</tr>
					<tr>
						<td class="first">新密码:</td>
						<td><input type="password" name="new_password" size="30" /></td>
					</tr>
					<tr>
						<td class="first">重复密码:</td>
						<td><input type="password" name="new_password2" size="30" /></td>
					</tr>
					<tr>
						<td width="100"></td>
						<td><button>&nbsp;&nbsp;&nbsp;提交&nbsp;&nbsp;&nbsp;</button></td>
					</tr>
				</tbody>
			</table>
            </form>
			</div>
		</div><!-- end right div-->


</div>

	</div>
  </div><!-- end main -->

<?php echo $footer;?>