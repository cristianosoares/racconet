<?php echo $header;?>
<style>
div.kryd_extension {padding-top:10px;}
div.kryd_extension label {width:100px;display:inline-block;}
div.kryd_extension input {width:220px;display:inline-block;margin-bottom:8px;border:1px solid #dbdbdb;}
</style>

<?php
$hassettingsfile=file_exists("../kryd/settings.php");
?>

<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator'];?><a href="<?php echo $breadcrumb['href'];?>"><?php echo $breadcrumb['text'];?></a>
    <?php } ?>
  </div>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error) { ?>
  <div class="warning"><?php echo $error;?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/kryd.png" alt="" /> <?php echo $heading_title;?></h1>
    </div>
    <div class="content">
      <div class="kryd_extension">

        <div style="float:left;max-width:320px;padding-right:40px;line-height:18px;">
          <?php echo $kryd_maintext;?>
        </div>
        <div style="float:left;">
          <?php if (!$hassettingsfile) {?>
          <form name="kryd_form" id="kryd_form" action="<?php echo $submit_kryd?>" method="post">
          <b>Please enter your KRYD account settings below:</b><br />
          <br />
          <?php }?>
          <div style="background-color:#ededed;border:1px solid #dbdbdb;padding:12px 16px 4px 16px">
            <label><?php echo $kryd_label_id;?>:</label>
            <?php if ($error && $kryd_id!="") $style=' style="border:1px solid red;"'; else $style="";?>
            <?php if ($hassettingsfile) $style=' style="color:gray;"';?>
            <input type="text" name="kryd_id" value="<?php echo $kryd_id?>"<?php echo $style?><?php if ($hassettingsfile) echo " readonly"?> />
            <?php if ($kryd_has_settings=="yes" && !$error && !$hassettingsfile) {?><img src="view/image/kryd_ok.png" style="margin:0 0 -4px 4px;" /><?php }?>
            <br />
            <label><?php echo $kryd_label_key;?>:</label>
            <?php if ($error && $kryd_key!="") $style=' style="border:1px solid red;"'; else $style="";?>
            <?php if ($hassettingsfile) $style=' style="color:gray;"';?>
            <input type="text" name="kryd_key" value="<?php echo $kryd_key?>"<?php echo $style?><?php if ($hassettingsfile) echo " readonly"?> />
            <?php if ($kryd_has_settings=="yes" && !$error && !$hassettingsfile) {?><img src="view/image/kryd_ok.png" style="margin:0 0 -4px 4px;" /><?php }?>
          </div>
          <br />
          <?php if (!$hassettingsfile) {?>
          <div style="text-align:right">
            <a class="button" onclick="document.forms.kryd_form.submit()"><?php echo $kryd_save;?></a>
          </div>
          </form>
          <?php }?>
        </div>
    </div>
  </div>
</div>
<?php echo $footer;?>