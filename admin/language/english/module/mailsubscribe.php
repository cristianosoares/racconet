<?php 

$_['heading_title']       	= 'Kodecube Email Marketing <a style="color:#A6D9FF; href="http://kodecube.com/">Kodecube.com</a>';

$_['heading_title2']       	= '<span style="color:#449DD0; font-weight:bold">Kodecube Email Marketing <a target="_blank" href="http://kodecube.com/" >Kodecube.com</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; Check  awesome Opencart Mobile App at <a target="_blank" href="http://opencartmobileapp.com">Opencartmobileapp.com</span></a>';

$_['title']       			= 'Kodecube Email Marketing';



// Text
$_['text_success']							= 'Success: You have modified module Email Marketing!';
$_['text_module']							= 'Modules';
$_['text_module_localization']  			= 'Localization';

$_['text_default']		  					= 'Default';
$_['text_general_settings']		  			= 'General';
$_['text_bounce_settings']		  			= 'Bounced emails';
$_['text_throttle_settings']		  		= 'Throttle';

$_['text_cron_command']   					= '*/5 * * * * /usr/bin/wget -o /dev/null -q "%s" >/dev/null 2>&1';
$_['text_help'] 							= '* * * * * command to be executed<br/>- - - - -<br/>| | | | |<br/>| | | | +- - - - day of week (0 - 6) (Sunday=0)<br/>| | | +- - - - - month (1 - 12)<br/>| | +- - - - - - day of month (1 - 31)<br/>| +- - - - - - - hour (0 - 23)<br/>+- - - - - - - - minute (0 - 59)<br/><br/>I.e. configure cron job to run command each 5 minutes.';


// Entry
$_['entry_use_throttle']					= 'Enable Throttle when Sending Emails?:<br /><span title="" class="help" data-toggle="tooltip" data-original-title="For this Feature, You need to configure Cronm Job on server."></span>';
$_['entry_use_embedded_images']				= 'Use embedded images in newsletter:<br /><span title="" class="help" data-toggle="tooltip" data-original-title="Not supported by Gmail web app."></span>';
$_['entry_throttle_emails']					= 'Emails to send in one iteration:<br /><span title="" class="help" data-toggle="tooltip" data-original-title="Number of emails to send."></span>';
$_['entry_throttle_time']					= 'Throttle interval:<br /><span title="" class="help" data-toggle="tooltip" data-original-title="Time in minutes."></span>';
$_['entry_sent_retries']					= 'Failed Retries count:<br /><span title="" class="help" data-toggle="tooltip" data-original-title="Amount of retries for Failed Attempt to send newsletter to specific email address."></span>';
$_['entry_name']							= 'Name';
$_['entry_yes']								= 'Yes';
$_['entry_no']								= 'No';
$_['entry_cron_code']						= 'Cron command:';
$_['entry_cron_help']						= 'Cron command help:';
$_['entry_list']							= 'Marketing lists:';
$_['entry_weekdays']						= 'Weekdays:';
$_['entry_months']							= 'Months:';
$_['entry_january']							= 'January';
$_['entry_february']						= 'February';
$_['entry_march']							= 'March';
$_['entry_april']							= 'April';
$_['entry_may']								= 'May';
$_['entry_june']							= 'June';
$_['entry_july']							= 'July';
$_['entry_august']							= 'August';
$_['entry_september']						= 'September';
$_['entry_october']							= 'October';
$_['entry_november']						= 'November';
$_['entry_december']						= 'December';
$_['entry_sunday']							= 'Sunday';
$_['entry_monday']							= 'Monday';
$_['entry_tuesday']							= 'Tuesday';
$_['entry_wednesday']						= 'Wednesday';
$_['entry_thursday']						= 'Thursday';
$_['entry_friday']							= 'Friday';
$_['entry_saturday']						= 'Saturday';
$_['entry_use_bounce_check']				= 'Check for bounced emails';
$_['entry_bounce_email']					= 'Email address for bounced emails<br/><span title="" class="help" data-toggle="tooltip" data-original-title="Email address for receiving bounced emails"></span>';
$_['entry_bounce_pop3_server']				= 'POP3 server for bounced emails<br/><span title="" class="help" data-toggle="tooltip" data-original-title="POP3 server name or IP address"></span>';
$_['entry_bounce_pop3_user']				= 'POP3 server login<br/><span title="" class="help" data-toggle="tooltip" data-original-title="Login for authenticating on server"></span>';
$_['entry_bounce_pop3_password']			= 'POP3 server password<br/><span title="" class="help" data-toggle="tooltip" data-original-title="Password for authenticating on server"></span>';
$_['entry_bounce_pop3_port']				= 'POP3 server port<br/><span title="" class="help" data-toggle="tooltip" data-original-title="If empty, 110 port will be used"></span>';
$_['entry_bounce_delete']					= 'Delete bounced emails<br/><span title="" class="help" data-toggle="tooltip" data-original-title="If yes, known bounced emails will be deleted from mailbox"></span>';

$_['entry_hide_marketing'] 					= 'Hide marketing lists in frontend:';

// Button
$_['button_add_list']   					= 'Add';

// Error
$_['error_permission']						= 'Warning: You do not have permission to modify module Email Marketingr!';

$_['entry_use_smtp']						= 'Use custom mail configuration:';
$_['entry_mail_protocol']					= 'Mail Protocol:<span title="" class="help" data-toggle="tooltip" data-original-title="Only choose \'Mail\' unless your host has disabled the php mail function."></span>';
$_['text_mail']								= 'Mail';
$_['text_mail_phpmailer']					= 'Mail (PHPMailer)';
$_['text_smtp']								= 'SMTP';
$_['text_smtp_phpmailer']					= 'SMTP (PHPMailer)';
$_['entry_email']							= 'Email address:';
$_['entry_mail_parameter']					= 'Mail Parameters:<span title="" class="help" data-toggle="tooltip" data-original-title="When using \'Mail\', additional mail parameters can be added here (e.g. `-femail@storeaddress.com`)."></span>';
$_['entry_smtp_host']						= 'SMTP Host:';
$_['entry_smtp_username']					= 'SMTP Username:';
$_['entry_smtp_password']					= 'SMTP Password:';
$_['entry_smtp_port']						= 'SMTP Port:';
$_['entry_smtp_timeout']					= 'SMTP Timeout:';
$_['entry_stores']							= 'Stores:';
$_['text_smtp_settings']					= 'Mail Settings';


$_['text_info']           = '<p>Developed by <a href="http://kodecube.com/" target="_blank" alt="Kodecube"><img src="view/javascript/kodecube/logo.png" alt="Kodecube"></a></p> 
  <p>
<strong>Support Email:</strong> support@kodecube.com</p>

<p><strong>Development Request</strong>: Info@kodecube.com</p>

<p>
 Check our other modules at <a href="http://www.opencart.com/index.php?route=extension/extension&filter_username=kodecube" target="_blank"><img src="view/javascript/kodecube/opencart.png" alt="Opencart"> </a></p>
 
 <p>
 To by Our modules at Kodecube Shop <a href="http://kodecube.com/shop/" target="_blank" alt="Kodecube Shop" >Click Here</a></p>
 
  <p>
 Log a Support Ticket Here: <a href="http://kodecube.com/shop/" target="_blank" alt="Kodecube Shop" >http://kodecube.com/shop/</a></p>';  
  
$_['text_licence_info'] 					= 'To activate module please provide your email which was used for module purchasing and order ID.';
$_['entry_transaction_id'] 					= 'Order ID';
$_['entry_transaction_email'] 				= 'Email ID';

