<?php echo $header; ?>
<div id="content">
  <?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
	<div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/user.png" alt="" />Reset Password</h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button">Reset</a><a href="index.php?route=common/login" class="button">Cancel</a></div>
    </div>
    <div class="content">
      <form action="index.php?route=tool/reset/reset" method="post" enctype="multipart/form-data" id="form">
        <p>Please enter your passwords :</p>
        <table class="form">
          <tr>
            <td>Old Password : </td>
            <td><input type="password" name="oldpassword" value="" size="50"/></td>
          </tr>
		  <tr>
            <td>New Password  : </td>
            <td><input type="password" name="newpassword" value="" size="50"/></td>
          </tr>
		  <tr>
            <td>Repeat Password  : </td>
            <td><input type="password" name="newpassword2" value="" size="50"/></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>