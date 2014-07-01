<?php echo $header; ?>

<style>
#content .form tbody > tr > td:first-child{
font-weight:bold;
}
</style>

<div id="content">

  <?php if ($warning) { ?>
  <div class="warning"><?php echo $warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="item_id" value="<?php echo isset($this->request->get['id'])?$this->request->get['id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />订单管理 </h1>
	  
      <div class="buttons">
      	<!--<a onclick="$('#form').submit();" class="button">
		<span>Save</span>
		</a>-->
        <a href="<?php echo  $cancel;?>" class="button">
		<span>Cancel</span>
		</a>
	  </div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs">
      	<a href="#tab-general">主要信息</a>
      </div>
	  <!-- General -->
	  <div id="tab-general">	
      <?php foreach($orders as $order){?>
		<table class="form">
          <tr><td colspan="2"><b style='color:#3CC800'>路线信息:</b></td></tr>
          <tr>
			<td> 路线名称:</td>
			<td><?php echo $order['line_detail']['title'];?></td>
		  </tr>
          <tr>
			<td> 路线编号:</td>
			<td><?php echo $order['line_detail']['title'];?></td>
		  </tr>
          <tr>
			<td> 路线名称:</td>
			<td><?php echo $order['line_detail']['serial_number'];?></td>
		  </tr>
          <tr>
			<td> 出发城市:</td>
			<td><?php echo (isset($fromcitys[$order['line_detail']['from_city']])?$fromcitys[$order['line_detail']['from_city']]:"");?></td>
		  </tr>
          <tr>
			<td> 主要景点:</td>
			<td><?php echo $order['main_attractions_str'];?></td>
		  </tr>
          <tr><td colspan="2"><b style='color:#3CC800'>订单信息:</b></td></tr>
          <tr>
			<td> 出发日期:</td>
			<td><?php echo $order['order_detail']['departure_date'];?></td>
		  </tr>
          <tr>
			<td> 上车地点:</td>
			<td><?php echo $order['order_detail']['boarding_location'];?></td>
		  </tr>
          <tr>
			<td> 房间信息:</td>
			<td><?php echo $order['order_detail']['accommodation_str'];?></td>
		  </tr>
          <tr>
			<td> 联系人名字:</td>
			<td><?php echo $order['order_detail']['contact'];?></td>
		  </tr>
          <tr>
			<td> 联系人电话:</td>
			<td><?php echo $order['order_detail']['phone'];?></td>
		  </tr>
          <tr>
			<td> 积分:</td>
			<td style="color:orange;"><?php echo $order['order_detail']['integral'];?>点</td>
		  </tr>
          <tr>
			<td><b style='color:#3CC800'>总价:</b></td>
			<td style="font-size:16px;font-weight:bold;color:#3CC800;">$<?php echo $order['order_detail']['total_price'];?></td>
		  </tr>
		</table>
        <?php }?>
        </div>
	  </div>
  </div>
  	</form>
 
</div>


<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
//--></script> 
<?php echo $footer; ?>