<?php echo $header; ?>
<div id="content">

  <?php if ($warning) { ?>
  <div class="warning"><?php echo $warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="item_id" value="<?php echo isset($this->request->get['area_id'])?$this->request->get['area_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />分区 </h1>
	  
      <div class="buttons">
      	<a onclick="$('#form').submit();" class="button">
		<span>Save</span>
		</a>
        <a href="<?php echo  $cancel;?>" class="button">
		<span>Cancel</span>
		</a>
	  </div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general">General</a></div>
		
		<table class="form">
          <tr>
			<td> Area title:</td>
			<td><input name="item_title" id="item_title" value="<?php echo isset($area_info['title']) ? $area_info['title'] : ''; ?>"/>
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