<?php echo $header;?>

<script language="javascript" src="./catalog/view/js/verification_code.js"></script>

<div id="wrapper"> 
  <!--网页主体内容开始-->
  <div class="White" align="center"><br />
    <br />
    <br />
    <table width="880" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td><img src="./uploads/images/pic_10.jpg" width="370" height="54" /></td>
      </tr>
      <tr>
        <td width="53%" align="right" valign="bottom"><p><a href="./index.php?route=common/register"><img src="./uploads/images/pic_08.jpg" width="509" height="216" /></a></p>        </td>
        <td width="28%" valign="top"><table width="82%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="./uploads/images/pic_11.jpg" width="370" height="54" /></td>
            </tr>
          <tr>
            <td background="./uploads/images/pic_15.jpg">
            	<?php if($isLogged==1){?>
                 <table width="81%" height="139" border="0" cellpadding="0" cellspacing="0"> 
                	<tr><td colspan="2" rowspan="4" align="center"><?php echo $success;?></td></tr>
                    <tr><td colspan="2" align="center"><a href="./index.php?route=common/logout" class="button button-secondary">退出</a></td></tr>
                 </table>   
                <?php }else{?>
                <form action="./index.php?route=common/login/login" method="post" enctype="multipart/form-data" onsubmit="return validate();">
                <div style="color:#FF0000"><?php echo $warning;?></div>
                <table width="81%" height="115" border="0" cellpadding="0" cellspacing="0"> 
                    <tr>
                        <td width="24%" align="right" class="Writing">用户名：</td>
                        <td width="76%" ><input name="username_f" type="text" class="text1" size="30" value="" /></td>
                    </tr>
                    <tr>
                        <td align="right" class="Writing">密　码：</td>
                        <td><input name="password_f" type="password" autocomplete="off" class="text1" size="30" value="<?php echo $password_f;?>"/></td>
                    </tr>
                    <tr>
                        <td align="right" class="Writing">验证码： </td>
                        <td>
                        	<input id="input1"  name="verification_code" type="text" class="text1" size="15" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right" class="Writing"></td>
                        <td>
                        	<input type="text" disabled="disabled" id="checkCode" class="unchanged" style="width: 80px" /> <span  style="cursor:pointer" onclick="createCode();">看不清楚,换一张</span>
                        </td>
                    </tr>
                </table>
                <br />
                <table width="75%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="59%" align="right"><input type="submit" value="登陆" class="button button-primary"/></td>
                        <td width="41%" align="right"><input type="reset" value="重置" class="button button-secondary"/></td>
                    </tr>
                </table>
                </form>
                <?php }?>
                <br />
            </td>
          </tr>
          <tr>
            <td><img src="./uploads/images/pic_16.jpg" width="370" height="9" /></td>
          </tr>
          
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="56%">&nbsp;</td>
            <td width="44%" height="117" align="left"><img src="./uploads/images/pic_12.jpg" width="386" height="123" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table>
  </div>
</div>

<?php echo $footer;?>