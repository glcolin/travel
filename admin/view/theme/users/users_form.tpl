<?php echo $header; ?>
<div id="content">

  <?php if ($warning) { ?>
  <div class="warning"><?php echo $warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="item_id" value="<?php echo isset($this->request->get['user_id'])?$this->request->get['user_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />用户管理 </h1>
	  
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
      	<a href="#tab-unpaid">未支付订单(<?php echo count($unpaidOrders);?>)</a>
        <a href="#tab-paid">已支付订单(<?php echo count($paidOrders);?>)</a>
      </div>
	  <!-- General -->
	  <div id="tab-general">	
		<table class="form">
          <tr>
			<td> 用户名:</td>
			<td><?php echo $user_info['username'];?></td>
		  </tr>
          <tr>
			<td> 用户邮箱:</td>
			<td><?php echo $user_info['email'];?></td>
		  </tr>
          <tr>
			<td> 用户积分:</td>
			<td><?php echo $user_info['integral'];?></td>
		  </tr>
          <tr>
			<td> 注册时间:</td>
			<td><?php echo $user_info['create_date'];?></td>
		  </tr>
		</table>
	  </div>
      <!-- unpaid -->
	  <div id="tab-unpaid">
      	<table class="list">
          <thead>
            <tr>
                <td class="center" >订单编号</td>
                <td class="center" >线路</td>
                <td class="right">总价($)</td>
                <td class="center" >下单时间</td>
            </tr>
          </thead>
          <tbody>
          <?php if ($unpaidOrders) { ?>
          <?php foreach ($unpaidOrders as $unpaidOrder) { ?>
          	<tr>
            <td class="center"><a target="_blank" href="./index.php?route=orders/orders/edit&id=<?php echo $unpaidOrder['id'];?>"><?php echo $unpaidOrder['number']?></a></td>
            <td class="center"><?php echo $lines[$unpaidOrder['line']]['title']?></td>
            <td class="center"><?php echo $unpaidOrder['total_price']?></td>
			<td class="center"><?php echo $unpaidOrder['create_date']?></td>
            </tr>
          <?php }?>
          <?php }?>
          </tbody>
        </table> 
      </div>
      <!-- paid -->
	  <div id="tab-paid">
      	<table class="list">
          <thead>
            <tr>
                <td class="center" >订单编号</td>
                <td class="center" >线路</td>
                <td class="center">总价($)</td>
                <td class="center" >下单时间</td>
            </tr>
          </thead>
          <tbody>
          <?php if ($paidOrders) { ?>
          <?php foreach ($paidOrders as $paidOrder) { ?>
          	<tr>
            <td class="center"><a target="_blank" href="./index.php?route=orders/orders/edit&id=<?php echo $paidOrder['id'];?>"><?php echo $paidOrder['number']?></a></td>
            <td class="center"><?php echo $lines[$paidOrder['line']]['title']?></td>
            <td class="center"><?php echo $paidOrder['total_price']?></td>
			<td class="center"><?php echo $paidOrder['create_date']?></td>
            </tr>
          <?php }?>
          <?php }?>
          </tbody>
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