<?php echo $header;?>

<div id="wrapper"> 
  <!--网页主体内容开始-->
  <div id="main">

<!--sidebar left-->
<?php echo $column_left;?>

<div class="f_r youb">

<div class="box2 mar_b_02">
<div class="titlA"><a href="#" onClick="preview('gift')">分类搜索 &gt;&gt;</a></div>


<div id="gift"  style=" display:">
<script language="JavaScript"> 
function preview(DivId) 
{ 
  if(document.getElementById(DivId).style.display=='none') 
   { document.getElementById(DivId).style.display=''; } 
   else 
   { document.getElementById(DivId).style.display='none'; } 
   
} 
function download(file){ 
  window.location.href=file; 
} 
</script> 
<div class="list">
<b>出发城市：</b>
	<a href="./index.php?route=lines/lines&fromcity=&attraction=<?php echo $attraction;?>&days=<?php echo $days;?>&area=<?php echo $area;?>" <?php echo $fromcity==""?'class="vvn"':'';?>>所有</a>
    <?php foreach($fromcitys as $key=>$value){?>
    <a href="./index.php?route=lines/lines&fromcity=<?php echo $key;?>&attraction=<?php echo $attraction;?>&days=<?php echo $days;?>&area=<?php echo $area;?>" <?php echo $fromcity==$key?'class="vvn"':'';?>><?php echo $value;?></a>
    <?php }?>
</div>


<div class="list">
<b>旅游景点：</b>
	<a href="./index.php?route=lines/lines&fromcity=<?php echo $fromcity;?>&attraction=&days=<?php echo $days;?>&area=<?php echo $area;?>" <?php echo $attraction==""?'class="vvn"':'';?>>所有</a>
    <?php foreach($attractions as $key=>$value){?>
    <a href="./index.php?route=lines/lines&fromcity=<?php echo $fromcity;?>&attraction=<?php echo $key;?>&days=<?php echo $days;?>&area=<?php echo $area;?>" <?php echo $attraction==$key?'class="vvn"':'';?>><?php echo $value;?></a>
    <?php }?>
</div>

<div class="list">
<b>旅游天数：</b>
	<a href="./index.php?route=lines/lines&fromcity=<?php echo $fromcity;?>&attraction=<?php echo $attraction;?>&days=&area=<?php echo $area;?>" <?php echo $days==""?'class="vvn"':'';?>>所有</a>
	<?php foreach($alldays as $key=>$value){?>
    <a href="./index.php?route=lines/lines&fromcity=<?php echo $fromcity;?>&attraction=<?php echo $attraction;?>&days=<?php echo $value;?>&area=<?php echo $area;?>" <?php echo $days==$value?'class="vvn"':'';?>><?php echo $value;?>天</a>
    <?php }?>
</div>
</div>


</div>

<div class="box3 box f_l  mar_b_02">


<?php foreach($lines as $line){?>
<div class="f_l box4" style="margin-bottom:20px;">
<div class="title5" style="margin-bottom:10px;border-bottom:1px dashed #ccc;"><a href="index.php?route=lines/line&line_id=<?php echo $line['id'];?>"><?php echo $line['title'];?></a></div>
<div class="f_l mar_b_02" style="margin-right:20px;"><a href="index.php?route=lines/line&line_id=<?php echo $line['id'];?>"><img src="./uploads/images/<?php echo $line['image_url'];?>" width="204" height="139" /></a></div>
<div class="wzs f_l">
<table class="line-table" style="float:left;" >
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
<?php }?>

<div class="pagination"><?php echo $pagination; ?></div>

</div>
</div>


    <div class="clear"></div>
  </div>

<?php echo $footer;?>