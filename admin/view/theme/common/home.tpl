<?php echo $header; ?>

<div id="content">

  <div class="box">
    <div class="heading">
      <h1><img src="view/image/home.png" alt="" /> 网站资讯</h1>
    </div>
    <div class="content">
    
      <div class="overview">
        <div class="dashboard-heading">最新订单</div>
        <div class="dashboard-content">
          <table>
          	<?php if($latest_orders){?>
            <?php foreach($latest_orders as $latest_order){?>
            <tr>
              <td><?php echo $latest_order['number'];?></td>
              <td><?php echo $order_status[$latest_order['status']];?></td>
              <td><?php echo $latest_order['create_date'];?></td>
            </tr>
            <?php }?>
            <?php }?>
          </table>
        </div>
      </div>
      
      <div class="statistic">
        <div class="dashboard-heading">最新用户</div>
        <div class="dashboard-content">
          <table style="width:100%">
          	<?php if($latest_users){?>
            <?php foreach($latest_users as $latest_user){?>
            <tr>
              <td><?php echo $latest_user['username'];?></td>
              <td style="text-align: right;"><?php echo $latest_user['create_date'];?></td>
            </tr>
            <?php }?>
            <?php }?>
          </table>
        </div>
      </div>
      
     
      
    </div>
  </div>
  
</div>
<?php echo $footer; ?>