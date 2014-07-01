<?php echo $header;?>
<script language="javascript" src="./catalog/view/js/verification_code.js"></script>
<script type="text/javascript">
	function verify_register(){
		var sign = true;
		$("#name_tips").text('');
		
		if(!$('input[name="email_f"]').val()){
			set_warning('input[name="email_f"]',true);
			sign = false;
		}
		else{
			if(!checkemail($('input[name="email_f"]').val())){
				set_warning('input[name="email_f"]',true);
				sign = false;
			}
			else{
				set_warning('input[name="email_f"]',false);
			}	
		}
		
		if(!$('input[name="username_f"]').val()){
			set_warning('input[name="username_f"]',true);
			sign = false;
		}
		else{
			if($('input[name="username_f"]').val().length>=2){
				$.ajax({
					type: 'post',
					url : 'index.php?route=common/register/checkUser',
					dataType : "text",
					async : false,
					data: {
						   username_f : $('input[name="username_f"]').val()
					},
					success: function (data) {
						if(data=="false"){
							set_warning('input[name="username_f"]',true);
							sign = false;
							$("#name_tips").text('（用户名已经存在）');
						}
						else{
							set_warning('input[name="username_f"]',false);
						}
					}
				});
			}
			else{
				set_warning('input[name="username_f"]',true);
				sign = false;
			}	
		}

		if(!$('input[name="password_f"]').val()){
			set_warning('input[name="password_f"]',true);
			sign = false;
		}
		else{
			if($('input[name="password_f"]').val() != $('input[name="password_verify_f"]').val()){
				set_warning('input[name="password_verify_f"]',true);
				sign = false;
			}
			else{
				set_warning('input[name="password_verify_f"]',false);
			}
			set_warning('input[name="password_f"]',false);	
		}
		
		if(!validate()){
			sign = false;
		}
		
		if(sign){
			return true;
		}
		return false;
	}
	
	function set_warning(element,status){
		if(status){
			$(element).attr("style","border: 2px solid #FF0000;");
		}
		else{
			$(element).attr("style","border: 1px solid #DDDDDD;");
		}
	}
	
	function checkemail(str){
		//在JavaScript中，正则表达式只能使用"/"开头和结束，不能使用双引号
		var Expression=/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; 
		var objExp=new RegExp(Expression);
		if(objExp.test(str)==true){
			return true;
		}else{
			return false;
		}
	}
</script>
<div id="wrapper">
  <!--网页主体内容开始-->
  <div class="White"> <img src="./catalog/view/images/pic_06.jpg" width="961" height="56" /><br />
  <form action="./index.php?route=common/register/userRegister" method="post" enctype="multipart/form-data" onsubmit="return verify_register();">
    <table width="961" border="0" cellpadding="0" cellspacing="0"  class="log_form">
      <tr>
        <td width="73" align="right">注册邮箱：</td>
        <td width="196" align="center" ><input class="text" type="text" name="email_f" size="25" /></td>
        <td width="692" style="font-size:12px" >请输入您常用的电子邮箱，将用于登录、接受订单通知等。</td>
      </tr>
      <tr>
        <td align="right">用户姓名：</td>
        <td align="center"><input class="text" type="text" name="username_f" size="25" /></td>
        <td style="font-size:12px">不少于2个字符，可以是汉字或拼音。<span id="name_tips" style="color:#FF0000;"></span></td>
      </tr>
      <tr>
        <td align="right">密码：</td>
        <td align="center"><input class="text" type="password" name="password_f" size="25" /></td>
        <td style="font-size:12px">5-12个字符，可以由数字、英文、符号组成。</td>
      </tr>
      <tr>
        <td align="right">确认密码：</td>
        <td align="center"><input class="text" type="password" name="password_verify_f" size="25" /></td>
        <td style="font-size:12px">请再输入一次密码</td>
      </tr>
      <tr>
        <td align="right">验证码：</td>
        <td align="center"><input id="input1" class="text" type="text" name="verification_code" size="25" /></td>
        <td style="font-size:12px"><input type="text" disabled="disabled" id="checkCode" class="unchanged" style="width: 80px" /> <span  style="cursor:pointer" onclick="createCode();">看不清楚,换一张</span></td>
      </tr>
      <tr>
        <td colspan="3" height="50"><input type="submit" value="" style="background-image:url('./catalog/view/images/pic_07.jpg');width: 132px; height: 36px;cursor: pointer;" /></td>
      </tr>
      <tr>
        <td colspan="3" style="font-size:12px">点击上面的“同意以下协议并注册”，即表示您同意接受下面的优胜旅游客户协议。</td>
      </tr>
      <tr>
        <td height="120" colspan="3"><label>
          <textarea class="textarea" name="textarea">请在预定和购买优胜旅游的旅行产品前，请仔细阅读本“订购协议”的各项条款，以便您能全面了解双方的权利和责任。一旦您订购旅游产品，本公司将认为您已经仔细阅读、充分理解并完全同意所有规定和相关内容。优胜旅游有权在任何时候对其订购须知的内容或条款进行部分或全部修改, 并不予以通知。您的资格
您必须是18周岁或18周岁以上的个人。如果您未满18周岁, 您可以在父母或法律监护人的带领下参加并订购优胜旅游的旅游产品。</textarea>
          </label></td>
      </tr>
    </table>
  </div>
</div>
<?php echo $footer;?>