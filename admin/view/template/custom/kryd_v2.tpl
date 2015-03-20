<?php echo $header; ?>
<style>
div.kryd_extension {padding-top:10px;}
div.kryd_extension label {width:100px;display:inline-block;}
div.kryd_extension input {width:220px;display:inline-block;margin-bottom:8px;border:1px solid #dbdbdb;}
.alert ul {margin:0;padding:0;}
</style>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
              <?php if (!$hassettingsfile) {?>
                <button onclick="document.forms.kryd_form.submit()" type="submit" form="form" data-toggle="tooltip" title="<?php echo $kryd_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $kryd_cancel_action; ?>" data-toggle="tooltip" title="<?php echo $kryd_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
              <?php } ?>

            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>


    <div class="container-fluid">
      <?php if ($error) { ?>
      <div class="alert alert-danger">
        <table cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td><i class="fa fa-exclamation-circle"></i></td>
            <td><?php echo $error; ?></td>
            <td><button type="button" class="close" data-dismiss="alert">&times;</button></td>
          </tr>
        </table>
      </div>
      <?php } ?>
      <?php if ($success) { ?>
      <div class="alert alert-success">
        <table cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td><i class="fa fa-check-circle"></i></td>
            <td><?php echo $success; ?></td>
            <td><button type="button" class="close" data-dismiss="alert">&times;</button></td>
          </tr>
        </table>
      </div>
    </div>
      <?php } ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><img src="view/image/kryd.png" alt="" />&nbsp;&nbsp;&nbsp;<?php echo $heading_title;?></h3>
            </div>
            <div class="panel-body">
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
                    <?php if ($error_id=="yes") $style=' style="border:1px solid red;"'; else $style="";?>
                    <?php if ($hassettingsfile) $style=' style="color:gray;"';?>
                    <input type="text" name="kryd_id" value="<?php echo $kryd_id?>"<?php echo $style?><?php if ($hassettingsfile) echo " readonly"?> />
                    <?php if ($kryd_has_settings=="yes" && !$error && !$hassettingsfile) {?><img src="view/image/kryd_ok.png" style="margin:0 0 -4px 4px;" /><?php }?>
                    <br />
                    <label><?php echo $kryd_label_key;?>:</label>
                    <?php if ($error_key=="yes") $style=' style="border:1px solid red;"'; else $style="";?>
                    <?php if ($hassettingsfile) $style=' style="color:gray;"';?>
                    <input type="text" name="kryd_key" value="<?php echo $kryd_key?>"<?php echo $style?><?php if ($hassettingsfile) echo " readonly"?> />
                    <?php if ($kryd_has_settings=="yes" && !$error && !$hassettingsfile) {?><img src="view/image/kryd_ok.png" style="margin:0 0 -4px 4px;" /><?php }?>
                  </div>
                  </form>
                </div>
            </div>
            </div>

        </div>
        </div>
        </div>

       