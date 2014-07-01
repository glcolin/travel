<?php echo $header; ?>
<div id="content">

  <?php if ($warning) { ?>
  <div class="warning"><?php echo $warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="item_id" value="<?php echo isset($this->request->get['fromcity_id'])?$this->request->get['fromcity_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />出发城市 </h1>
	  
      <div class="buttons">
      	<a onclick="$('#form').submit();" class="button">
		<span>保存</span>
		</a>
        <a href="<?php echo  $cancel;?>" class="button">
		<span>取消</span>
		</a>
	  </div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general">主要信息</a></div>
		
		<table class="form">
          <tr>
			<td> 城市名称:</td>
			<td><input name="item_title" id="item_title" value="<?php echo isset($fromcity_info['title']) ? $fromcity_info['title'] : ''; ?>"/>
			</td>
		  </tr>
		</table>
	
    </div>

  </div>
  	</form>
 
</div>


<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
//--></script> 
<?php echo $footer; ?>