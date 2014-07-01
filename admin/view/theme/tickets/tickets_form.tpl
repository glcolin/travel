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
      <h1><img src="view/image/information.png" alt="" />机票管理 </h1>
	  
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
		<table class="form">
          <tr>
			<td> 订单号:</td>
			<td><?php echo $ticket_info['info']['number'];?></td>
		  </tr>
          <tr>
			<td> 联系人姓名:</td>
			<td><?php echo $ticket_info['content']['name'];?></td>
		  </tr>
          <tr>
			<td> 联系人电话号码:</td>
			<td><?php echo $ticket_info['content']['phone'];?></td>
		  </tr>
          <tr>
			<td> 联系人电子邮箱:</td>
			<td><?php echo $ticket_info['content']['email'];?></td>
		  </tr>
          <tr>
			<td> 机票类型:</td>
			<td><?php echo $ticket_info['content']['ticket_type'];?></td>
		  </tr>
          <tr>
			<td> 出发地:</td>
			<td><?php echo $ticket_info['content']['departure_address'];?></td>
		  </tr>
          <tr>
			<td> 目的地:</td>
			<td><?php echo $ticket_info['content']['destination_address'];?></td>
		  </tr>
          <tr>
			<td> 出发日期:</td>
			<td><?php echo $ticket_info['content']['departure_date'];?></td>
		  </tr>
          <tr>
			<td> 回程日期:</td>
			<td><?php echo $ticket_info['content']['return_date'];?></td>
		  </tr>
          <tr>
			<td> 旅客数量:</td>
			<td><?php echo $ticket_info['content']['adult_number']+$ticket_info['content']['child_number'];?> （成人：<?php echo $ticket_info['content']['adult_number'];?>&nbsp;&nbsp; 小孩：<?php echo $ticket_info['content']['child_number'];?>）</td>
		  </tr>
          <tr>
			<td> 下单日期:</td>
			<td><?php echo $ticket_info['info']['create_date'];?></td>
		  </tr>
		</table>
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