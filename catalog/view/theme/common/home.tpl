<?php echo $header;?>

<div id="wrapper"> 
  <!--网页主体内容开始-->
  <div id="main">
    <div class="box boutique f_l mar_b_02 mar_r_01">
      <h2 class="til"><!--<a href="#" class="f2_r">更多&gt;&gt;</a>--><span class="name">特价推荐</span><span class="yy"></span></h2>
      <ul>
      	<?php foreach($recommend_informations as $value){?>
        <li><a href="./index.php?route=informations/information&id=<?php echo $value['id'];?>"><?php echo $value['title'];?></a><br />
        <?php }?>
      </ul>
      
    </div>
    <div class="center f_l mar_b_02 mar_r_01">
      <div class="flash">
        <div id="NewsPic"> 
        
          <?php foreach($content_banners as $key=>$value){?>
          <a target="_blank" href="<?php echo $value['link'];?>" style="visibility: visible; display: block;"><img src="./uploads/images/<?php echo $value['image_url'];?>" class="Picture" alt="<?php echo $value['title'];?>" title="<?php echo $value['title'];?>" /></a> 
          <?php }?>
          
          <div class="flash_btn">
          	<?php for($i=count($content_banners);$i>0;$i--){?>
          	<span class="<?php echo $i==1?"Cur":"Normal";?>"><?php echo $i;?></span>
            <?php }?>
          </div>
        </div>
        <div id="NewsPicTxt"><a target="_blank" href="#"><?php echo $content_banners[0]['title'];?></a></div>
      </div>
      <script type="text/javascript">$('.flash').liteNav(5000);</script>
      <div class="mod_01">
        <ul>
          <li class="clearfix">
            <h2 class="f_l line_name">线路</h2>
            <div class="line_form">
            <form id="lines_search_home" action="./index.php?route=lines/lines" method="post" enctype="multipart/form-data">
              <table width="393" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="55" align="right">出发地</td>
                  <td width="144">
                  <select name="search_fromcity" id="search_fromcity" class="txt txt_w01">
                        <option value=""> </option>
                        <?php foreach($fromcitys as $value){?>
                        <option value="<?php echo $value['id'];?>"><?php echo $value['title'];?></option>
                        <?php }?>
                  </select>
                  </td>
                  <td width="69">行程天数</td>
                  <td width="88"><input type="text" name="search_days" id="search_days" size="10" value=""/></td>
                </tr>
              </table>
              <table width="393" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="55" align="right">目的地</td>
                  <td width="177">
                  <select name="search_endcity" id="search_endcity" class="txt txt_w02">
                        <option value=""> </option>
                        <?php foreach($endcitys as $value){?>
                        <option value="<?php echo $value['id'];?>" ><?php echo $value['title'];?></option>
                        <?php }?>
                  </select>
                  </td>
                  <td width="135"><input type="submit" name="imageField" id="imageField" class="sousuo" value=""/></td>
                </tr>
              </table>
            </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
    
    <?php echo $contactus;?>
    
    <h2 class="til_02 til_bg_01 mar_b_02">
    <span class="f2_r">
    <?php foreach($areas as $key=>$value){?>
    	<?php echo '<a href="./index.php?route='.($key==$specialareas?"cruises/cruises":"lines/lines").'&area='.$key.'">'.$value.'</a>'." | ";?>
    <?php }?>
    <a href="./index.php?route=lines/lines">更多&gt;&gt</a>;
    </span>
    <span class="name">路线</span>
    </h2>
    <div class="box mod_02 f_l mar_b_02 mar_r_01">
      <h2 class="til_03"><a href="./index.php?route=lines/lines" class="f2_r">更多&gt;&gt;</a><span class="name">最新路线</span></h2>
      <ul>
        <li class="pic" style="height:208px !important;"><img src="./uploads/images/<?php echo $hotlinebanners?$hotlinebanners[0]['image_url']:"";?>" width="360" height="105" style="height:208px !important;"/></li>
        <?php foreach($latest_lines as $key=>$value){?>
        <li><span class="f2_r">$<?php echo $value['price'];?>起</span><a href="./index.php?route=lines/line&line_id=<?php echo $value['id'];?>">·&nbsp;<?php echo $value['title'];?></a></li>
        <?php }?>
      </ul>
    </div>
    <div class="box mod_02 f_l mar_b_02 mar_r_01">
      <h2 class="til_03"><a href="./index.php?route=lines/lines" class="f2_r">更多&gt;&gt;</a><span class="name">推荐路线</span></h2>
      <ul>
        <li class="pic" style="height:208px !important;"><img src="./uploads/images/<?php echo $recommendlinebanners?$recommendlinebanners[0]['image_url']:"";?>" width="360" height="105" style="height:208px !important;"/></li>
        <?php foreach($recommend_lines as $key=>$value){?>
        <li><span class="f2_r">$<?php echo $value['price'];?>起</span><a href="./index.php?route=lines/line&line_id=<?php echo $value['id'];?>">·&nbsp;<?php echo $value['title'];?></a></li>
        <?php }?>
      </ul>
    </div>
    <div class="mod_03 f_l">
      <ul>
      	<?php foreach($specialLines as $line){?>
        <li><a href="./index.php?route=lines/line&line_id=<?php echo $line['id'];?>"><img src="./uploads/images/<?php echo $line['image_url'];?>" width="217" height="85" /></a>
          <div class="name"><?php echo $line['title'];?></div>
        </li>
        <?php }?>
      </ul>
    </div>
    <h2 class="til_02 til_bg_02 mar_b_02"><span class="name">其它信息</span></h2>
    <div class="box mod_04 f_l mar_b_02 mar_r_01">
      <h2 class="til"><a href="./index.php?route=certificates/certificates" class="f2_r">更多&gt;&gt;</a><span class="name">签证资讯</span><span class="yy"></span></h2>
      <ul class="clearfix">
      	<?php foreach($certificates as $key=>$value){?>
        <li><a href="./index.php?route=certificates/certificate&id=<?php echo $value['id'];?>">·&nbsp;<?php echo $value['title'];?></a></li>
        <?php }?>
      </ul>
    </div>
    <div class="box mod_04 f_l mar_b_02">
      <h2 class="til"><a href="./index.php?route=informations/informations" class="f2_r">更多&gt;&gt;</a><span class="name">旅游资讯</span><span class="yy"></span></h2>
      <ul class="clearfix">
        <?php foreach($informations as $key=>$value){?>
        <li><a href="./index.php?route=informations/information&id=<?php echo $value['id'];?>">·&nbsp;<?php echo $value['title'];?></a></li>
        <?php }?>
      </ul>
    </div>
    <div class="box pic_list mar_b_02" style="width:935px;">
      <div id="marquee">
        <ul class="clearfix">
          <?php foreach($wonderful_informations as $wonderful_information){?>
          <li>
            <div class="pic"><a href="./index.php?route=informations/information&id=<?php echo $wonderful_information['id'];?>"><img src="./uploads/images/<?php echo $wonderful_information['image_url'];?>" width="169" height="109" /></a></div>
            <a href="./index.php?route=informations/information&id=<?php echo $wonderful_information['id'];?>"><?php echo $wonderful_information['title'];?></a>
          </li>
          <?php }?>  
        </ul>
      </div>
    </div>
    <div class="box links mar_b_02">
      <h2 class="til"><span class="name">友情链接</span><span class="yy"></span></h2>
      <ul class="clearfix">
      	<?php foreach($friendlinks as $friendlink){?>
        <li><a href="<?php echo $friendlink['link'];?>"><img src="./uploads/images/<?php echo $friendlink['image_url'];?>" width="181" height="74" /></a></li>
        <?php }?>
      </ul>
    </div>
    <div class="clear"></div>
  </div>

<?php echo $footer;?>