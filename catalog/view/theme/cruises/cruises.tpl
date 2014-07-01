<?php echo $header;?>

<div id="wrapper"> 
  <!--网页主体内容开始-->
  <div id="main">

<!--sidebar left-->
<?php echo $column_left;?>

<div class="f_r youb">



<div class="box3 box f_l  mar_b_02">


<?php foreach($cruises as $cruise){?>
<div class="f_l box4" style="margin-bottom:20px;">
<div class="title5" style="margin-bottom:10px;border-bottom:1px dashed #ccc;"><a href="index.php?route=cruises/cruise&cruise_id=<?php echo $cruise['id'];?>"><?php echo $cruise['title'];?></a></div>
<div class="f_l mar_b_02" style="margin-right:20px;"><a href="index.php?route=cruises/cruise&cruise_id=<?php echo $cruise['id'];?>"><img src="./uploads/images/<?php echo $cruise['image_url'];?>" width="204" height="139" /></a></div>
<div class="wzs f_l">
<table class="line-table" style="float:left;" >
	<tr>
		<td class="col1">路线编号:</td>
		<td class="col2"><?php echo $cruise['serial_number'];?></td>
	</tr>
	<tr>
		<td class="col1">出发城市:</td>
		<td class="col2"><?php echo isset($fromcitys[$cruise['from_city']])?$fromcitys[$cruise['from_city']]:"";?></td>
	</tr>
	<tr>
		<td class="col1">主要景点:</td>
		<td class="col2">
		<?php 
		$main_attractions = $cruise['main_attractions']?json_decode($cruise['main_attractions']):array();
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
		<td class="col2"><?php echo isset($endcitys[$cruise['end_city']])?$endcitys[$cruise['end_city']]:"";?></td>
	</tr>
	<tr>
		<td class="col1">积分点数:</td>
		<td class="col2"><b class="Orange"><?php echo $cruise['integral'];?>点</b></td>
	</tr>
</table>
<div style="width:120px;min-height:50px;border-top:2px #3CC800 solid;border-bottom:2px #3CC800 solid;float:right;background:#eee;padding:2px;">
	<?php if($cruise['original_price']){?>
		<span style="font-size:16px;">原价:</span><br/>
		<b style="font-size:20px;color:#D00;text-decoration:line-through;">$<?php echo $cruise['original_price'];?></b><br/>
	<?php }?>
	<span style="font-size:16px;">价格:</span><br/>
	<b style="font-size:20px;color:orange;">$<?php echo $cruise['price'];?></b>
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