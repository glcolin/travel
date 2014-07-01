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
      <h1><img src="view/image/backup.png" alt="" /> Back Up </h1>
      <div class="buttons"><a onclick="$('#backup').submit();" class="button">Back Up</a></div>
    </div>
    <div class="content">
    	<div style="text-align:center; font-size:12px; margin-top:50px;">Click the "Backup" button to save a backup to your local computer.</div>
      <form action="index.php?route=tool/backup/backup" method="post" enctype="multipart/form-data" id="backup" style="display:none;">
        <table class="form">
          <tr>
            <td></td>
            <td><div class="scrollbox" style="margin-bottom: 5px;">     
            	<?php $class = 'odd'; ?>     
                <?php foreach ($tables as $table) { ?>    
                <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>          
                <div class="<?php echo $class; ?>">
                  <input type="checkbox" name="backup[]" value="<?php echo $table; ?>" checked="checked" />
                  <?php echo $table; ?></div>
                <?php } ?>
              </div>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>