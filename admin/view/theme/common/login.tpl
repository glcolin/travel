<?php echo $header; ?>
<div id="content">
  <div class="box" style="width: 400px; min-height: 300px; margin-top: 40px; margin-left: auto; margin-right: auto;">
    <div class="heading">
      <h1><img src="view/image/lockscreen.png" alt="" />Admin Login</h1>
    </div>
    <div class="content" style="min-height: 150px; overflow: hidden;">
      <?php if($success) { ?> 
      <div class="success"><?php echo $success; ?></div>
      <?php } ?>
      <?php if($warning) { ?>
      <div class="warning"><?php echo $warning; ?></div>
      <?php } ?>
      <form action="index.php?route=common/login/login" method="post" enctype="multipart/form-data" id="form">
        <table style="width: 100%;">
          <tr>
            <td style="text-align: center;" rowspan="4"><img src="view/image/login.png"  /></td>
          </tr>
          <tr>
            <td>Username<br />
              <input type="text" name="username" value="<?php echo $username; ?>" style="margin-top: 4px;" />
              <br />
              <br />
              Password<br />
              <input type="password" name="password" value="<?php echo $password; ?>" style="margin-top: 4px;" />
             
              <br />
              <a href="index.php?route=common/forgotten">Forgot password?</a>

              </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td style="text-align: right;"><a onclick="$('#form').submit();" class="button">Login</a></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script> 
<?php echo $footer; ?>