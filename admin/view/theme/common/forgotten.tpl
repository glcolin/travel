<?php echo $header; ?>
<div id="content">
  <?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/user.png" alt="" />Forgot Password</h1>
      <div class="buttons"><a onclick="$('#forgotten').submit();" class="button">Reset</a><a href="index.php?route=common/login" class="button">Cancel</a></div>
    </div>
    <div class="content">
      <form action="index.php?route=common/forgotten/reset" method="post" enctype="multipart/form-data" id="forgotten">
        <p>Please enter the email associated to your account :</p>
        <table class="form">
          <tr>
            <td>Your email address : </td>
            <td><input type="text" name="email" value="" size="50"/></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>