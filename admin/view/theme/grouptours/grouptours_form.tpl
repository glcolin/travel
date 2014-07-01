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
      <h1><img src="view/image/information.png" alt="" />包团管理 </h1>
	  
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
			<td><?php echo $grouptour_info['info']['number'];?></td>
		  </tr>
          <tr>
			<td> 联系人姓名:</td>
			<td><?php echo $grouptour_info['content']['name'];?></td>
		  </tr>
          <tr>
			<td> 联系人电话号码:</td>
			<td><?php echo $grouptour_info['content']['phone'];?></td>
		  </tr>
          <tr>
			<td> 联系人电子邮箱:</td>
			<td><?php echo $grouptour_info['content']['email'];?></td>
		  </tr>
          <tr>
			<td> 参团人数:</td>
			<td><?php echo $grouptour_info['content']['number'];?></td>
		  </tr>
          <tr>
			<td> 所在地:</td>
			<td><?php echo $grouptour_info['content']['address'];?></td>
		  </tr>
          <tr>
			<td> 预计出发日期:</td>
			<td><?php echo $grouptour_info['content']['departure_date'];?></td>
		  </tr>
          <tr>
			<td> 预计回程日期:</td>
			<td><?php echo $grouptour_info['content']['return_date'];?></td>
		  </tr>
          <tr>
			<td> 签证:</td>
			<td><?php echo $grouptour_info['content']['certificate'];?></td>
		  </tr>
          <tr>
			<td> 国际机票:</td>
			<td><?php echo $grouptour_info['content']['air_ticket'];?></td>
		  </tr>
          <tr>
			<td> 餐饮:</td>
			<td><?php echo $grouptour_info['content']['repast'];?></td>
		  </tr>
          <tr>
			<td> 导游:</td>
			<td><?php echo $grouptour_info['content']['guide'];?></td>
		  </tr>
          <tr>
			<td> 租车:</td>
			<td><?php echo $grouptour_info['content']['taxi'];?></td>
		  </tr>
          <tr>
			<td> 行程信息:</td>
			<td><?php echo $grouptour_info['content']['message'];?></td>
		  </tr>
          <tr>
			<td> 其它说明:</td>
			<td><?php echo $grouptour_info['content']['other_message'];?></td>
		  </tr>
          <tr>
			<td> 下单日期:</td>
			<td><?php echo $grouptour_info['info']['create_date'];?></td>
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