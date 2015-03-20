<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-mailsubscribe" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
<div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title2; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-mailsubscribe">
        <input type="hidden" name="mailsubscribe_embedded_images" value="0" />
        <div class="table-responsive">
        <?php if (isset($validation)) { ?>
        <table class="table table-striped table-bordered table-hover">
		    <tr>
                <td colspan="2">
                    <span style='text-align: center;'><b><?php echo $text_licence_info; ?></b></span>
                </td>
            </tr>
            <tr>
                <td><?php echo $entry_transaction_email; ?></td>
                <td><input type="text" name="mailsubscribe_email2" value="" /></td>
            </tr>
            <tr>
                <td><?php echo $entry_transaction_id; ?></td>
                <td><input type="text" name="mailsubscribe_transaction_id" value="" /></td>
            </tr>
        </table>
        <?php } else { ?>
        <table class="table table-striped table-bordered table-hover">
		 <input type="hidden" id="mailsubscribe_transaction_id" name="mailsubscribe_transaction_id" value="<?php echo $mailsubscribe_transaction_id; ?>">
			 
                <tr>
                    <td colspan="2">
                        <span style='text-align: center;'><b><?php echo $text_throttle_settings; ?></b></span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_use_throttle; ?></td>
                    <td>
                        <?php if($mailsubscribe_throttle) {
                        $checked1 = ' checked="checked"';
                        $checked0 = '';
                        } else {
                        $checked1 = '';
                        $checked0 = ' checked="checked"';
                        } ?>
                    <label for="mailsubscribe_throttle_1"><?php echo $entry_yes; ?></label>
                    <input type="radio"<?php echo $checked1; ?> id="mailsubscribe_throttle_1" name="mailsubscribe_throttle" value="1" />
                    <label for="mailsubscribe_throttle_0"><?php echo $entry_no; ?></label>
                    <input type="radio"<?php echo $checked0; ?> id="mailsubscribe_throttle_0" name="mailsubscribe_throttle" value="0" />
                    </td>
                </tr>
                <tbody id="throttle">
                <tr>
                    <td><?php echo $entry_throttle_emails; ?></td>
                    <td><input type="text" name="mailsubscribe_throttle_count" value="<?php echo $mailsubscribe_throttle_count; ?>" size="3" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_throttle_time; ?></td>
                    <td>
                        <select name="mailsubscribe_throttle_time">
                            <option value="60" <?php echo $mailsubscribe_throttle_time == '60' ? ' selected="selected"' : "" ?>>1</option>
                            <option value="300" <?php echo $mailsubscribe_throttle_time == '300' ? ' selected="selected"' : "" ?>>5</option>
                            <option value="600" <?php echo $mailsubscribe_throttle_time == '600' ? ' selected="selected"' : "" ?>>10</option>
                            <option value="900" <?php echo $mailsubscribe_throttle_time == '900' ? ' selected="selected"' : "" ?>>15</option>
                            <option value="1800" <?php echo $mailsubscribe_throttle_time == '1800' ? ' selected="selected"' : "" ?>>30</option>
                            <option value="3600" <?php echo $mailsubscribe_throttle_time == '3600' ? ' selected="selected"' : "" ?>>60</option>
                            <option value="7200" <?php echo $mailsubscribe_throttle_time == '7200' ? ' selected="selected"' : "" ?>>120</option>
                            <option value="10800" <?php echo $mailsubscribe_throttle_time == '10800' ? ' selected="selected"' : "" ?>>180</option>
                            <option value="14400" <?php echo $mailsubscribe_throttle_time == '14400' ? ' selected="selected"' : "" ?>>240</option>
                        </select>
                    </td>
                </tr>
                </tbody>
                <tr>
                    <td colspan="2">
                        <span style='text-align: center;'><b><?php echo $text_smtp_settings; ?></b></span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_use_smtp; ?></td>
                    <td>
                        <?php if($mailsubscribe_use_smtp) {
                        $checked1 = ' checked="checked"';
                        $checked0 = '';
                        } else {
                        $checked1 = '';
                        $checked0 = ' checked="checked"';
                        } ?>
                    <label for="mailsubscribe_smtp_1"><?php echo $entry_yes; ?></label>
                    <input type="radio"<?php echo $checked1; ?> id="mailsubscribe_smtp_1" name="mailsubscribe_use_smtp" value="1" />
                    <label for="mailsubscribe_smtp_0"><?php echo $entry_no; ?></label>
                    <input type="radio"<?php echo $checked0; ?> id="mailsubscribe_smtp_0" name="mailsubscribe_use_smtp" value="0" />
                    </td>
                </tr>
                <tbody id="smtp">
                <tr>
                    <td><?php echo $entry_stores; ?></td>
                    <td>
                        <?php array_unshift($stores, array('store_id' => 0, 'name' => $text_default)); ?>
                        <div id="smtp_stores" class="htabs">
                            <?php foreach ($stores as $store) { ?>
                            <a href="#smtp_stores<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></a>
                            <?php } ?>
                        </div>
                        <?php foreach ($stores as $store) { ?>
                        <div id="smtp_stores<?php echo $store['store_id']; ?>">
                            <table class="form">
                                <tr>
                                    <td><?php echo $entry_mail_protocol; ?></td>
                                    <td><select name="mailsubscribe_smtp[<?php echo $store['store_id']; ?>][protocol]">
                                        <?php if (isset($mailsubscribe_smtp[$store['store_id']]['protocol']) && $mailsubscribe_smtp[$store['store_id']]['protocol'] == 'mail') { ?>
                                        <option value="mail" selected="selected"><?php echo $text_mail; ?></option>
                                        <?php } else { ?>
                                        <option value="mail"><?php echo $text_mail; ?></option>
                                        <?php } ?>
                                        <?php if (isset($mailsubscribe_smtp[$store['store_id']]['protocol']) && $mailsubscribe_smtp[$store['store_id']]['protocol'] == 'smtp') { ?>
                                        <option value="smtp" selected="selected"><?php echo $text_smtp; ?></option>
                                        <?php } else { ?>
                                        <option value="smtp"><?php echo $text_smtp; ?></option>
                                        <?php } ?>
                                        <?php if (isset($mailsubscribe_smtp[$store['store_id']]['protocol']) && $mailsubscribe_smtp[$store['store_id']]['protocol'] == 'mail_phpmailer') { ?>
                                        <option value="mail_phpmailer" selected="selected"><?php echo $text_mail_phpmailer; ?></option>
                                        <?php } else { ?>
                                        <option value="mail_phpmailer"><?php echo $text_mail_phpmailer; ?></option>
                                        <?php } ?>
                                        <?php if (isset($mailsubscribe_smtp[$store['store_id']]['protocol']) && $mailsubscribe_smtp[$store['store_id']]['protocol'] == 'smtp_phpmailer') { ?>
                                        <option value="smtp_phpmailer" selected="selected"><?php echo $text_smtp_phpmailer; ?></option>
                                        <?php } else { ?>
                                        <option value="smtp_phpmailer"><?php echo $text_smtp_phpmailer; ?></option>
                                        <?php } ?>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td><?php echo $entry_email; ?></td>
                                    <td><input type="text" name="mailsubscribe_smtp[<?php echo $store['store_id']; ?>][email]" value="<?php echo isset($mailsubscribe_smtp[$store['store_id']]['email']) ? $mailsubscribe_smtp[$store['store_id']]['email'] : ''; ?>" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo $entry_mail_parameter; ?></td>
                                    <td><input type="text" name="mailsubscribe_smtp[<?php echo $store['store_id']; ?>][parameter]" value="<?php echo isset($mailsubscribe_smtp[$store['store_id']]['parameter']) ? $mailsubscribe_smtp[$store['store_id']]['parameter'] : ''; ?>" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo $entry_smtp_host; ?></td>
                                    <td><input type="text" name="mailsubscribe_smtp[<?php echo $store['store_id']; ?>][host]" value="<?php echo isset($mailsubscribe_smtp[$store['store_id']]['host']) ? $mailsubscribe_smtp[$store['store_id']]['host'] : ''; ?>" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo $entry_smtp_username; ?></td>
                                    <td><input type="text" name="mailsubscribe_smtp[<?php echo $store['store_id']; ?>][username]" value="<?php echo isset($mailsubscribe_smtp[$store['store_id']]['username']) ? $mailsubscribe_smtp[$store['store_id']]['username'] : ''; ?>" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo $entry_smtp_password; ?></td>
                                    <td><input type="text" name="mailsubscribe_smtp[<?php echo $store['store_id']; ?>][password]" value="<?php echo isset($mailsubscribe_smtp[$store['store_id']]['password']) ? $mailsubscribe_smtp[$store['store_id']]['password'] : ''; ?>" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo $entry_smtp_port; ?></td>
                                    <td><input type="text" name="mailsubscribe_smtp[<?php echo $store['store_id']; ?>][port]" value="<?php echo isset($mailsubscribe_smtp[$store['store_id']]['port']) ? $mailsubscribe_smtp[$store['store_id']]['port'] : '25'; ?>" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo $entry_smtp_timeout; ?></td>
                                    <td><input type="text" name="mailsubscribe_smtp[<?php echo $store['store_id']; ?>][timeout]" value="<?php echo isset($mailsubscribe_smtp[$store['store_id']]['timeout']) ? $mailsubscribe_smtp[$store['store_id']]['timeout'] : '5'; ?>" /></td>
                                </tr>
                            </table>
                        </div>
                        <?php } ?>
                    </td>
                </tr>
                </tbody>
                <!--
                <tr>
                    <td colspan="2">
                        <span style='text-align: center;'><b><?php echo $text_bounce_settings; ?></b></span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_use_bounce_check; ?></td>
                    <td>
                        <?php if($mailsubscribe_bounce) {
                        $checked1 = ' checked="checked"';
                        $checked0 = '';
                        } else {
                        $checked1 = '';
                        $checked0 = ' checked="checked"';
                        } ?>
                    <label for="mailsubscribe_bounce_1"><?php echo $entry_yes; ?></label>
                    <input type="radio"<?php echo $checked1; ?> id="mailsubscribe_bounce_1" name="mailsubscribe_bounce" value="1" />
                    <label for="mailsubscribe_bounce_0"><?php echo $entry_no; ?></label>
                    <input type="radio"<?php echo $checked0; ?> id="mailsubscribe_bounce_0" name="mailsubscribe_bounce" value="0" />
                    </td>
                </tr>
                <tbody id="bounce">
                <tr>
                    <td><?php echo $entry_bounce_email; ?></td>
                    <td><input type="text" name="mailsubscribe_bounce_email" value="<?php echo $mailsubscribe_bounce_email; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_bounce_pop3_server; ?></td>
                    <td><input type="text" name="mailsubscribe_bounce_pop3_server" value="<?php echo $mailsubscribe_bounce_pop3_server; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_bounce_pop3_user; ?></td>
                    <td><input type="text" name="mailsubscribe_bounce_pop3_user" value="<?php echo $mailsubscribe_bounce_pop3_user; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_bounce_pop3_password; ?></td>
                    <td><input type="password" name="mailsubscribe_bounce_pop3_password" value="<?php echo $mailsubscribe_bounce_pop3_password; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_bounce_pop3_port; ?></td>
                    <td><input type="text" name="mailsubscribe_bounce_pop3_port" value="<?php echo $mailsubscribe_bounce_pop3_port; ?>" size="3" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_bounce_delete; ?></td>
                    <td>
                        <?php if($mailsubscribe_bounce_delete) {
                        $checked1 = ' checked="checked"';
                        $checked0 = '';
                        } else {
                        $checked1 = '';
                        $checked0 = ' checked="checked"';
                        } ?>
                    <label for="mailsubscribe_bounce_delete_1"><?php echo $entry_yes; ?></label>
                    <input type="radio"<?php echo $checked1; ?> id="mailsubscribe_bounce_delete_1" name="mailsubscribe_bounce_delete" value="1" />
                    <label for="mailsubscribe_bounce_delete_0"><?php echo $entry_no; ?></label>
                    <input type="radio"<?php echo $checked0; ?> id="mailsubscribe_bounce_delete_0" name="mailsubscribe_bounce_delete" value="0" />
                    </td>
                </tr>
                </tbody>
                -->
                <tr>
                    <td colspan="2">
                        <span style='text-align: center;'><b><?php echo $text_general_settings; ?></b></span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_sent_retries; ?></td>
                    <td><input type="text" name="mailsubscribe_sent_retries" value="<?php echo $mailsubscribe_sent_retries; ?>" size="3" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_cron_code; ?></td>
                    <td>
                        <pre><?php echo $cron_url; ?></pre>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_cron_help; ?></td>
                    <td>
                        <pre><?php echo $text_help; ?></pre>
                    </td>
                </tr>
                
               
                <tr>
                    <td colspan="2">
                        <span style='text-align: center;'><b><?php echo $text_module_localization; ?></b></span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_months; ?></td>
                    <td>
                        <div id="languages_months" class="htabs">
                            <?php foreach ($languages as $language) { ?>
                            <a href="#language_months<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                            <?php } ?>
                        </div>
                        <?php foreach ($languages as $language) { ?>
                          <div id="language_months<?php echo $language['language_id']; ?>">
                            <table class="form">
                              <tr>
                                <td><?php echo $entry_january; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][0]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][0]) ? $mailsubscribe_months[$language['language_id']][0] : $entry_january; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_february; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][1]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][1]) ? $mailsubscribe_months[$language['language_id']][1] : $entry_february; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_march; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][2]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][2]) ? $mailsubscribe_months[$language['language_id']][2] : $entry_march; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_april; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][3]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][3]) ? $mailsubscribe_months[$language['language_id']][3] : $entry_april; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_may; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][4]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][4]) ? $mailsubscribe_months[$language['language_id']][4] : $entry_may; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_june; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][5]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][5]) ? $mailsubscribe_months[$language['language_id']][5] : $entry_june; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_july; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][6]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][6]) ? $mailsubscribe_months[$language['language_id']][6] : $entry_july; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_august; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][7]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][7]) ? $mailsubscribe_months[$language['language_id']][7] : $entry_august; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_september; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][8]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][8]) ? $mailsubscribe_months[$language['language_id']][8] : $entry_september; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_october; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][9]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][9]) ? $mailsubscribe_months[$language['language_id']][9] : $entry_october; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_november; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][10]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][10]) ? $mailsubscribe_months[$language['language_id']][10] : $entry_november; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_december; ?></td>
                                <td><input type="text" name="mailsubscribe_months[<?php echo $language['language_id']; ?>][11]" size="100" value="<?php echo isset($mailsubscribe_months[$language['language_id']][11]) ? $mailsubscribe_months[$language['language_id']][11] : $entry_december; ?>" /></td>
                              </tr>
                            </table>
                          </div>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_weekdays; ?></td>
                    <td>
                        <div id="languages_weekdays" class="htabs">
                            <?php foreach ($languages as $language) { ?>
                            <a href="#language_weekdays<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                            <?php } ?>
                        </div>
                        <?php foreach ($languages as $language) { ?>
                          <div id="language_weekdays<?php echo $language['language_id']; ?>">
                            <table class="form">
                              <tr>
                                <td><?php echo $entry_sunday; ?></td>
                                <td><input type="text" name="mailsubscribe_weekdays[<?php echo $language['language_id']; ?>][0]" size="100" value="<?php echo isset($mailsubscribe_weekdays[$language['language_id']][0]) ? $mailsubscribe_weekdays[$language['language_id']][0] : $entry_sunday; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_monday; ?></td>
                                <td><input type="text" name="mailsubscribe_weekdays[<?php echo $language['language_id']; ?>][1]" size="100" value="<?php echo isset($mailsubscribe_weekdays[$language['language_id']][1]) ? $mailsubscribe_weekdays[$language['language_id']][1] : $entry_monday; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_tuesday; ?></td>
                                <td><input type="text" name="mailsubscribe_weekdays[<?php echo $language['language_id']; ?>][2]" size="100" value="<?php echo isset($mailsubscribe_weekdays[$language['language_id']][2]) ? $mailsubscribe_weekdays[$language['language_id']][2] : $entry_tuesday; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_wednesday; ?></td>
                                <td><input type="text" name="mailsubscribe_weekdays[<?php echo $language['language_id']; ?>][3]" size="100" value="<?php echo isset($mailsubscribe_weekdays[$language['language_id']][3]) ? $mailsubscribe_weekdays[$language['language_id']][3] : $entry_wednesday; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_thursday; ?></td>
                                <td><input type="text" name="mailsubscribe_weekdays[<?php echo $language['language_id']; ?>][4]" size="100" value="<?php echo isset($mailsubscribe_weekdays[$language['language_id']][4]) ? $mailsubscribe_weekdays[$language['language_id']][4] : $entry_thursday; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_friday; ?></td>
                                <td><input type="text" name="mailsubscribe_weekdays[<?php echo $language['language_id']; ?>][5]" size="100" value="<?php echo isset($mailsubscribe_weekdays[$language['language_id']][5]) ? $mailsubscribe_weekdays[$language['language_id']][5] : $entry_friday; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_saturday; ?></td>
                                <td><input type="text" name="mailsubscribe_weekdays[<?php echo $language['language_id']; ?>][6]" size="100" value="<?php echo isset($mailsubscribe_weekdays[$language['language_id']][6]) ? $mailsubscribe_weekdays[$language['language_id']][6] : $entry_saturday; ?>" /></td>
                              </tr>
                            </table>
							
                          </div>
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <?php } ?>
		</div>	
			 <iframe src="http://kodecube.com/ocadds/add1.html" width="730" height="500"></iframe>
			 
			
			<?php echo $text_info; ?>
        </form>
      </div>
    </div>
  </div>

<?php if (!isset($licensor)) { ?>
<script type="text/javascript"><!--

$('input[name=\'mailsubscribe_throttle\']').bind('click', function() {
    checkThrottle();
});

$('input[name=\'mailsubscribe_use_smtp\']').bind('click', function() {
    checkSmtp();
});

$('input[name=\'mailsubscribe_bounce\']').bind('click', function() {
    checkBounce();
});

checkThrottle();
checkSmtp();
checkBounce();

function checkThrottle() {
    if ($('input[name=\'mailsubscribe_throttle\']:checked').val() == 1) {
        $('#throttle').show();
    } else {
        $('#throttle').hide();
    }
}

function checkSmtp() {
    if ($('input[name=\'mailsubscribe_use_smtp\']:checked').val() == 1) {
        $('#smtp').show();
    } else {
        $('#smtp').hide();
    }
}

function checkBounce() {
    if ($('input[name=\'mailsubscribe_bounce\']:checked').val() == 1) {
        $('#bounce').show();
    } else {
        $('#bounce').hide();
    }
}
//--></script>

<?php } ?></div>
<style type="text/css">
		span.help:after {
			color: #1e91cf;
		   content: "\f059";
			font-family: FontAwesome;
			margin-left: 4px;
		}
		#dialogbackground{
						background:#000;
						opacity: 0.8;
						color:#000;
						font-size:13px;
		}
		#dialogbackground h4{
						font-size: 16px;
			font-weight: bold;
			opacity: 1;
		}
		</style>
<?php echo $footer;?>