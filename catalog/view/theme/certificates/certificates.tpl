<?php echo $header;?>

<div id="wrapper">
  <!--网页主体内容开始-->
  <div id="main">
    
    <div class="f_l zuob">
    	<?php foreach($categories as $key=>$value){?>
        <div class="box f_l mods_02 mar_b_02 mar_r_01">
              <h2 class="tilv"><?php echo $value['info']['title'];?> <a href="./index.php?route=certificates/certificates&category=<?php echo $value['info']['id'];?>" class="f_r">更多&gt;&gt;</a></h2>
              <ul>
              	<?php foreach($value['items'] as $key2=>$value2){?>
                <li><a href="./index.php?route=certificates/certificate&id=<?php echo $value2['id'];?>"><?php echo $value2['title'];?></a></li>
                <?php }?>
              </ul>
        </div>
        <?php }?>
    </div>
    
    <div class="f_r youb">

        <div class="box2 mar_b_02">
        <div class="titlA">分类搜索 &gt;&gt;</div>
        
        
        <div id="gift" >
        
        <div class="list">
            <b>分类：</b>
                <a href="./index.php?route=certificates/certificates" <?php echo $category==""?'class="vvn"':'';?>>所有</a>
                <?php foreach($categories as $key=>$value){?>
                <a href="./index.php?route=certificates/certificates&category=<?php echo $value['info']['id'];?>" <?php echo $category==$value['info']['id']?'class="vvn"':'';?>><?php echo $value['info']['title'];?></a>
                <?php }?>
            </div>
        </div> 
    </div> 
    
    <div class="f_r box mar_b_02  White1">
      <div class="beijing">签证</div>
      
        <?php foreach($certificates as $certificate){?>
	    <div class="mar_b_02 xiantiao2">
          <div class="f_l bb3 mar_b_02 mar_r_01 "><a href="./index.php?route=certificates/certificate&id=<?php echo $certificate['id'];?>"><img src="./uploads/images/<?php echo $certificate['image_url'];?>" style="width:204px; height:139px;"/></a></div>
          <div class="Typeface"><a href="./index.php?route=certificates/certificate&id=<?php echo $certificate['id'];?>"><?php echo $certificate['title'];?></a></div>
          <div class="neirong"><?php echo mb_substr(strip_tags(htmlspecialchars_decode($certificate['content'])),0, 150, 'utf-8');?>...<a href="./index.php?route=certificates/certificate&id=<?php echo $certificate['id'];?>"><span class="Orange">详细</span></a>
          </div>
          <div class="clear"></div>
		</div>
        
        <?php }?>
      
      <div class="pagination"><?php echo $pagination; ?></div>
      
	   </div>
	
    <div class="clear"></div>
  </div>
  <div class="clear"></div>

<?php echo $footer;?>