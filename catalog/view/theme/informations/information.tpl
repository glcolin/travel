<?php echo $header;?>

<div id="wrapper">
  <!--网页主体内容开始-->
  <div id="main">
    
    <div class="f_l zuob">
    	<?php foreach($categories as $key=>$value){?>
        <div class="box f_l mods_02 mar_b_02 mar_r_01">
              <h2 class="tilv"><?php echo $value['info']['title'];?> <a href="./index.php?route=informations/informations&category=<?php echo $value['info']['id'];?>" class="f_r">更多&gt;&gt;</a></h2>
              <ul>
              	<?php foreach($value['items'] as $key2=>$value2){?>
                <li><a href="./index.php?route=informations/information&id=<?php echo $value2['id'];?>"><?php echo $value2['title'];?></a></li>
                <?php }?>
              </ul>
        </div>
        <?php }?>
    </div>
    
    <div class="f_r bb2 box mar_b_02  White1">
      <div class="beijing">旅游资讯</div>
      <div class="Typeface"><p align="center"><?php echo $information['title'];?></p></div>
      <div class="Typeface1">发布日期：<?php echo date('Y年m月d日',strtotime($information['create_date']));?>  作者： <?php echo $author['username'];?></div>
      <div class="Typeface2"><p align="center"><img src="./uploads/images/<?php echo $information['image_url'];?>" /></p><br />
      <?php echo htmlspecialchars_decode($information['content']);?>
 </div>
 <div><p align="center"><a href="./index.php?route=informations/informations"><img src="./uploads/images/pic_21.jpg" /></a></p></div><br />

    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>


<?php echo $footer;?>