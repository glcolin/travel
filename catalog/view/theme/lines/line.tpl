<?php echo $header;?>
<link type="text/css" href="./catalog/view/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type=text/javascript src="./catalog/view/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type=text/javascript src="./catalog/view/js/lrtk.js"></script>
<script type=text/javascript src="./catalog/view/js/order_rooms.js"></script>
<script type=text/javascript src="./catalog/view/js/json.js"></script>
<script type="text/javascript">
	var accommodation_fee = JSON.decode('<?php echo $line['accommodation_fee'];?>');
	var line_id = '<?php echo $line['id'];?>';
	$(function() {
		$('input[name="departuredate"]').datepicker();
	});
</script>

<script type="text/javascript">
function scrollDoor(){
}
scrollDoor.prototype = {
	sd : function(menus,divs,openClass,closeClass){
		var _this = this;
		if(menus.length != divs.length)
		{
			alert("菜单层数量和内容层数量不一样!");
			return false;
		}				
		for(var i = 0 ; i < menus.length ; i++)
		{	
			_this.$(menus[i]).value = i;				
			_this.$(menus[i]).onclick = function(){
					
				for(var j = 0 ; j < menus.length ; j++)
				{						
					_this.$(menus[j]).className = closeClass;
					_this.$(divs[j]).style.display = "none";
				}
				_this.$(menus[this.value]).className = openClass;	
				_this.$(divs[this.value]).style.display = "block";				
			}
		}
		},
	$ : function(oid){
		if(typeof(oid) == "string")
		return document.getElementById(oid);
		return oid;
	}
}
window.onload = function(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["m01","m02","m03"],["c01","c02","c03"],"sd01","sd02","sd03");
}
</script>

<div id="wrapper">
<!--网页主体内容开始-->
  <div id="main">
 
<!--sidebar left-->
<?php echo $column_left;?>
	
	<div class="f_r bb2 box mar_b_02  White1">
      <div class="beijing"><?php echo $line['title'];?></div>
	  <div class="f_l bb4 mar_b_02 mar_r_01 " >
	 <!-- 代码 开始 -->      
<div id=idTransformView>
<ul id=idSlider class=slider>
  <?php foreach($banners as $banner){?>
  <div style="POSITION: relative">
      <ul class=txtbg></ul>
      
      <a href="#" target="_blank"><img  src="./uploads/images/<?php echo $banner['src'];?>" width=271 height=169></a>
  </div>
  <?php }?>
</ul>
</div>

<div>
<ul id=idNum class=hdnum>
  <?php foreach($banners as $banner){?>
  <li><img src="./uploads/images/<?php echo $banner['src'];?>" width=61px height=45px></li>
  <?php }?>
</ul>
<script language=javascript>
  mytv("idNum","idTransformView","idSlider",169,4,true,2000,4,true,"onmouseover");
  //按钮容器aa，滚动容器bb，滚动内容cc，滚动宽度dd，滚动数量ee，滚动方向ff，延时gg，滚动速度hh，自动滚动ii，
  </script>
</div>
<!-- 代码 结束 -->
</div>
	  
<div class="f_r bb5  mar_b_02  ">
	<div class="neirong2">
		<table class="line-table" style="float:left;">
			<tr>
				<td class="col1">路线编号:</td>
				<td class="col2"><?php echo $line['serial_number'];?></td>
			</tr>
			<tr>
				<td class="col1">出发城市:</td>
				<td class="col2"><?php echo isset($fromcitys[$line['from_city']])?$fromcitys[$line['from_city']]:"";?></td>
			</tr>
			<tr>
				<td class="col1">主要景点:</td>
				<td class="col2">
				<?php 
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
				echo $main_attractions_str;
				?></td>
			</tr>
			<tr>
				<td class="col1">结束地点:</td>
				<td class="col2"><?php echo isset($endcitys[$line['end_city']])?$endcitys[$line['end_city']]:"";?></td>
			</tr>
			<tr>
				<td class="col1">积分点数:</td>
				<td class="col2"><b class="Orange"><?php echo $line['integral'];?>点</b></td>
			</tr>
		</table>
		<div style="width:120px;min-height:50px;border-top:2px #3CC800 solid;border-bottom:2px #3CC800 solid;float:right;background:#eee;padding:2px;">
			<?php if($line['original_price']){?>
				<span style="font-size:16px;">原价:</span><br/>
				<b style="font-size:20px;color:#D00;text-decoration:line-through;">$<?php echo $line['original_price'];?></b><br/>
			<?php }?>
			<span style="font-size:16px;">价格:</span><br/>
			<b style="font-size:20px;color:orange;">$<?php echo $line['price'];?></b>
		</div>
	</div>
</div>
</div>
	
<div class="f_r bb2 mar_b_02  White1" >
<table class="room-price-list" style="border-top-color:#3CC800;border-top-width: 2px;">
    <thead>
    	<tr><td colspan="7" class="center">房间费用</td></tr>
        <tr>
            <td class="center" rowspan="2">第一个人</td>
            <td class="center" colspan="2">第二个人</td>
            <td class="center" colspan="2">第三个人</td>
            <td class="center" colspan="2">第四个人</td>
        </tr>
        <tr>
            <td class="center">成人</td>
            <td class="center">小孩</td>
            <td class="center">成人</td>
            <td class="center">小孩</td>
            <td class="center">成人</td>
            <td class="center">小孩</td>
        </tr>
    </thead>

  <tr>
    <td class="center">$<?php echo $accommodation_fee[1][0];?></td>
    <td class="center">$<?php echo $accommodation_fee[2][0];?></td>
    <td class="center">$<?php echo $accommodation_fee[2][1];?></td>
    <td class="center">$<?php echo $accommodation_fee[3][0];?></td>
    <td class="center">$<?php echo $accommodation_fee[3][1];?></td>
    <td class="center">$<?php echo $accommodation_fee[4][0];?></td>
    <td class="center">$<?php echo $accommodation_fee[4][1];?></td>
  </tr>
</table>
</div>	   
 
	   
<?php if($boardinglocations){?>	   	   
<div class="f_r bb2 box mar_b_02  White1">
    <div class="beijing">订团表格</div>
    <form action="./index.php?route=lines/line/place_an_order" method="post" enctype="multipart/form-data">
      <input type="hidden" name="line_id" value="<?php echo $line['id'];?>" />
	  <table id="order_table" width="700" height="222" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="77">出发日期 ：</td>
            <td width="227">
                <input type="text" name="departuredate" size="30" value="" />
            </td>
          </tr>
          <tr>
            <td>上车地点 ： </td>
            <td>
            <select class="select1" name="boardinglocation">
            <?php foreach($boardinglocations as $boardinglocation){?>
                <option value="<?php echo $boardinglocations_all[$boardinglocation];?>"><?php echo $boardinglocations_all[$boardinglocation];?></option>
            <?php }?>
            </select>
            </td>
          </tr>
		  <tr>
            <td width="77">住宿情况：</td>
            <td colspan="1" style=" width:265px;">
                <a href="#" id="add_room"><img src="./catalog/view/images/add.png" /></a>
            </td>
            <td valign="top"></td>
          </tr>
          <tr>
            <td width="77"></td>
            <td colspan="1" style=" width:265px;">
                <table id="order_rooms_table" >
                    <tbody id="order_rooms_html">
                    </tbody>
                </table>
                <textarea id="order_rooms_data" name="order_rooms_data" style="display:none;"></textarea>
            </td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td>联 系 人 ：</td>
            <td><input class="text" type="text" name="contact" size="30" /></td>
            <td colspan="4">&nbsp;</td>
            </tr>
          <tr>
            <td>联系电话 ：</td>
            <td><input class="text" type="text" name="phone" size="30" /></td>
            <td colspan="4"><img src="./uploads/images/pic_23.jpg" width="100" height="30" class="check_fee"/>
            </td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td valign="top" colspan="2"><input type="submit" style="background-image:url(./uploads/images/pic_24.jpg);width: 130px;height: 35px;" value="" /> <span style="color:#FF0000"><?php echo $warning_order?$warning_order:($success_order?$success_order:'');?></span></td>
            <td colspan="4">&nbsp;</td>
            </tr>
        </table>
        </form>
 </div>
<?php }else{?>
<div class="f_r bb2 box mar_b_02  White1">
    <div class="beijing" style="height:27px;">订团表格(<span style="color:#FF0000;">此路线暂时不开放订购</span>)</div>
</div>   
<?php }?>		  
	  
  <div class="f_r bb2  mar_b_02  White1">
  <div class="beijing1">
 <div style="min-height:350px;">
	  
	  <div class="preview">
		<div class="scrolldoorFrame">
			<ul class="scrollUl">
				<li class="sd01" id="m01">详细介绍</li>
				<li class="sd02" id="m02">自费项用</li>
                <li class="sd03" id="m03">用户评论</li>
			</ul>
			<div class="bor03 cont">
			<div id="c01">
				<?php echo htmlspecialchars_decode($line['content']);?>
			</div>
			<div id="c02">
				<?php echo htmlspecialchars_decode($line['otherfee']);?>
			</div>	
			<div id="c03" class="hidden">
                <?php foreach($comments as $comment){?>
				<div class="xiantiao3"><ul>
				<li class="Price1"><?php echo $comment['title'];?></li>
				<li class="f_r">日期：<?php echo date('Y-m-d',strtotime($comment['create_date']));?></li>
				<li><?php echo $comment['content'];?></li>
				</ul></div>
                <?php }?>
				
                <form action="./index.php?route=lines/line/add_comment" method="post" enctype="multipart/form-data">
                <input type="hidden" name="line_id" value="<?php echo $line['id'];?>" />
				<table width="715" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#dddddd">
                  <tr>
                    <td height="31" colspan="2" background="./uploads/images/pic_27.jpg" bgcolor="#FFFFFF"  class="Price1">&nbsp;我要评论</td>
                    </tr>
                  <tr>
                    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr height="45">
                        <td width="15%" align="right" bgcolor="#eceaeb" class="xiantiao3">电子邮箱:&nbsp;&nbsp;&nbsp;</td>
                        <td width="1%" class="xiantiao3">&nbsp;</td>
                        <td width="84%" class="xiantiao3"><input class="text" type="text" name="comment_email" size="30" /></td>
                      </tr>
                      <tr height="45">
                        <td align="right" bgcolor="#eceaeb" class="xiantiao3">标 题:&nbsp;&nbsp;&nbsp;</td>
                        <td class="xiantiao3">&nbsp;</td>
                        <td class="xiantiao3"><input class="text" type="text" name="comment_title" size="30" /></td>
                      </tr>
                      <tr height="45">
                        <td align="right" bgcolor="#eceaeb" class="xiantiao3">评论内容：&nbsp;&nbsp;&nbsp;</td>
                        <td class="xiantiao3">&nbsp;</td>
                        <td class="xiantiao3">
                        <table width="100%" height="141" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td colspan="2" valign="middle"><textarea class="textarea2" name="comment_content"></textarea></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center"><span style="color:#FF0000"><?php echo $warning_comment?$warning_comment:($success_comment?$success_comment:'');?><input type="submit" value="" style="background-image:url(./uploads/images/pic_19.jpg);width: 83px;height: 24px;" /></td>
                          </tr>
                        </table>
                        
                        </td>
                      </tr>
                      
                    </table>
                    </td>
                    </tr>
                </table>
                </form>
                </div>
			</div>
		</div>
	</div>
	  
	  
	  </div>
	  </div>
	  </div>
	
    <div class="clear"></div>
  </div>
  <div class="clear"></div>


<?php echo $footer;?>