<?php echo $header;?>

<div id="wrapper">
  <!--网页主体内容开始-->
  <div id="main">
    
    <div class="f_l zuob">
		<div class="box f_l mods_02 mar_b_02 mar_r_01">
        <div class="beijing">联系方式</div>
		<div style="font-size:13px;padding:15px;padding-top:6px;">
			<?php echo html_entity_decode($contact_left,ENT_QUOTES,"UTF-8");?>
		</div>
</div>
    </div>
    
    <div class="f_r youb">

    
    <div class="f_r box mar_b_02  White1">
      <div class="beijing">关于我们</div>
		
		<div style="font-size:13px;padding:15px;padding-top:6px;"><!-- begin -->
		
		<?php echo html_entity_decode($contact_right,ENT_QUOTES,"UTF-8");?>

		
		</div><!-- end -->
		
      
	   </div>
	
    <div class="clear"></div>
  </div>
  <div class="clear"></div>

<?php echo $footer;?>