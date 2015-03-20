<?php
  define('KC_TIME', DIR_LOGS . 'kc_time');
  
class ControllerMailsubscribeCron extends Controller {
    public function index() {
		if (!isset($this->request->get['key']) || $this->request->get['key'] != md5($this->config->get('mailsubscribe_key'))) {
			$this->response->redirect($this->url->link('common/home'));
		}
		set_time_limit(0);
		
		require_once(DIR_SYSTEM . 'library/mail_mailsubscribe.php');
		
		$this->load->language('mailsubscribe/cron');
		 
		$this->load->model('mailsubscribe/cron');
		
		$this->do_scheduled();
	      
		if (!file_exists(KC_TIME) || (filemtime(KC_TIME) + (int)$this->config->get('mailsubscribe_throttle_time') - 100) < time()) {
			$this->send_queued();
		}

		
		$this->response->setOutput(date('Y-m-d H:i:s') . ' - ok');
    }

    private function do_scheduled() {

        $date = date('Y-m-d');
        $time = date('G');
        $day = date('w');

        $weekdays = array("sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday");
        $frequency = array("7" => "week", "30" => "month");
		
		
		$schedules = $this->model_mailsubscribe_cron->get_scheduled($date, $time, $day);
		
        foreach ($schedules as $schedule) {
		
				$store_info = $this->model_mailsubscribe_cron->getStore($schedule['store_id']);			
				
				if ($store_info) {
					$store_name = $store_info['name'];
					$store_url = $store_info['url'];
				} else {
					$store_name = $this->config->get('config_name');
					$store_url = $this->config->get('config_url');
					
				}
			
				if (isset($this->request->get['page'])) {
					$page = $this->request->get['page'];
				} else {
					$page = 1;
				}

				if (empty($schedule['newsletter_id'])) {
                        $newsletter_id = $this->model_mailsubscribe_cron->addHistory(array(
                            'to' => $schedule['to'],
                            'subject' => $schedule['subject'],
                            'message' => $schedule['message'],
                            'attachments_id' => 0,
                            'store_id' => $schedule['store_id'],
                            'template_id' => $schedule['template_id'],
                            'language_id' => $schedule['language_id']
                        ));
                }else {
					$newsletter_id = $schedule['newsletter_id'];
				} 
				
				$email_total = 0;

           		$emails = array();
			
            switch ($schedule['to']) {
                case 'newsletter':
					$customer_data = array(
								'filter_newsletter' => 1,
								'language_id'		=> $schedule['language_id'],
								'start'             => ($page - 1) * 10,
								'limit'             => 10
							);
					$email_total = $this->model_mailsubscribe_cron->getTotalCustomers($customer_data);
					
					
					$results = $this->model_mailsubscribe_cron->getCustomers($customer_data);
					
					
					
					foreach ($results as $result) {
						if ($result['store_id'] == $schedule['store_id']) {
							$emails[] = $result['email'];
						}
					}
					break;
                case 'customer_all':
					
					$customer_data = array(
								
								'language_id'		=> $schedule['language_id'],
								'start'             => ($page - 1) * 10,
								'limit'             => 10
								
							);
					$email_total = $this->model_mailsubscribe_cron->getTotalCustomers($customer_data);
					
                    $results = $this->model_mailsubscribe_cron->getCustomers($customer_data);
					
                    
					
					foreach ($results as $result) {
						if ($result['store_id'] == $schedule['store_id']) {
							$emails[] = $result['email'];
						}
					}
					break;
                case 'customer_group':
                   $customer_data = array(
								'filter_customer_group_id' => $schedule['customer_group_id'],
								'language_id'		=> $schedule['language_id'],
								'start'             => ($page - 1) * 10,
								'limit'             => 10
							);
						
					if ($schedule['customer_group_only_subscribers']) {
                        $customer_data['filter_newsletter'] = 1;
                    }
					$email_total = $this->model_mailsubscribe_cron->getTotalCustomers($customer_data);
							
					$results = $this->model_mailsubscribe_cron->getCustomers($customer_data);
					
					
					
					foreach ($results as $result) {
						if ($result['store_id'] == $schedule['store_id']) {
							$emails[] = $result['email'];
						}
					}
					break;
                case 'customer':
                    if (isset($schedule['customer']) && $schedule['customer']) {
                        $schedule['customer'] = unserialize($schedule['customer']);
						
						$email_total = count($schedule['customer']);
						
                        foreach ($schedule['customer'] as $customer_id) {
                            $customer_info = $this->model_mailsubscribe_cron->getCustomer($customer_id);

                            if ($customer_info) {
                             	$emails[] = $customer_info['email'];	
                            }
                        }
						
                    }
                    break;
                case 'affiliate_all':
					$affiliate_data = array(
							'start'  => ($page - 1) * 10,
							'limit'  => 10
						);
					$email_total = $this->model_mailsubscribe_cron->getTotalAffiliates($affiliate_data);	
						
                   	$results = $this->model_mailsubscribe_cron->getAffiliates($affiliate_data);
					
					
					
                    foreach ($results as $result) {
							$emails[] = $result['email'];
						}
                    break;
                case 'affiliate':
                    if (isset($schedule['affiliate']) && $schedule['affiliate']) {
                        $schedule['affiliate'] = unserialize($schedule['affiliate']);

						$email_total = count($schedule['affiliate']);
						
                        foreach ($schedule['affiliate'] as $affiliate_id) {
                            $affiliate_info = $this->model_mailsubscribe_cron->getAffiliate($affiliate_id);

                            if ($affiliate_info) { 
								foreach ($results as $result) {
									$emails[] = $result['email'];
								}
                            }
                        }
                    }
                    break;
                case 'product':
                    if (isset($schedule['product']) && $schedule['product']) {
                        $schedule['product'] = unserialize($schedule['product']);
                        
						$results = $this->model_mailsubscribe_cron->getEmailsByProductsOrdered($schedule['product'],($page - 1) * 10, 10);
						
						$email_total = count($schedule['product']);
						
                        foreach ($results as $result) {
                            
                            if ($result['store_id'] == $schedule['store_id']) {
								$emails[] = $result['email'];								
                            }
                        }
                    }
                    break;
					case 'newsletter_module':
						$newsletter_module = array(
							'store_id' => $schedule['store_id'],
							'start'                    => ($page - 1) * 10,
							'limit'                    => 10
						);
							$email_total = $this->model_mailsubscribe_cron->getTotalEmailsNewsletterModule($schedule['store_id']);	
							
							$results = $this->model_mailsubscribe_cron->getEmailsNewsletterModule($newsletter_module);
													
							foreach ($results as $result) {
								$emails[] = $result['email'];
							}
						
						break;
				default:
					$this->language->get('text_user_not_found');
            }
		   
		   $template = $this->model_mailsubscribe_cron->getTemplate($schedule['template_id']);
		  
		  
           if ($emails) {
					$start = ($page - 1) * 10;
					$end = $start + 10;
					
					$file = KC_TIME;
					
					$handle = fopen($file,"a");
					////create and close the file.
					
					// Append a new person to the file
					if ($end < $email_total) {
						 $current = date('Y-m-d H:i:s').' - '.sprintf($this->language->get('text_sent'), $start, $email_total);
					} else { 
						$current = date('Y-m-d H:i:s').' - '.sprintf($this->language->get('text_success'), $start+1);
					}				
						
					$current .="\r\n";
					// Write the contents back to the file
					fwrite($handle, $current); 	
					fclose($handle);			
					
					
					
					
					$mail = null;	
							
					if($this->config->get('mailsubscribe_use_smtp')){
						$mail = new Mail_Mailsubscribe($this->config->get('mailsubscribe_smtp'));	
						$mail_config = $this->config->get('mailsubscribe_smtp');
					
						$mail->setFrom($mail_config[$this->request->post['store_id']]['email']);
						
					}else {
						$mail = new Mail_Mailsubscribe($this->config->get('config_mail'));	
						$mail->setFrom($this->config->get('config_email'));
					}
						
						$mail->setSender($store_name);///your storename
					
					
					if($newsletter_id){	
						$this->model_mailsubscribe_cron->addStatQueue($newsletter_id, array(
							'queue' => ($this->config->get('mailsubscribe_throttle') ? 0 : $email_total),
							'recipients' => $email_total
						));	
						
						$this->model_mailsubscribe_cron->updateSchedularNewsletterID($newsletter_id, $schedule['schedule_id']);
					}
					foreach ($emails as $email) {
						if($this->config->get('mailsubscribe_throttle') && $newsletter_id && ($email_total > $this->config->get('mailsubscribe_throttle_count'))){
							$this->model_mailsubscribe_cron->addQueue(array(
								'history_id' => $newsletter_id,
								'email'		=> $email
								
							));
							
							continue;
						}
						$message ='';
						$changemessage ='';
						$codedvalue = $email."~~".$newsletter_id;
						$changemessage = str_replace('{web_version}',$this->language->get('text_web_version').'<a href="'.$store_url.'index.php?route=mailsubscribe/show&codevalue='.base64_encode($codedvalue).'">'.$this->language->get('text_web_version_here').'</a>',$schedule['message']);
				
						$changemessage = str_replace('{unsubscribe_url}','<a href='.$store_url.'index.php?route=mailsubscribe/click/unsubscribe&user='.base64_encode($email).'>'.$this->language->get('text_unsubscribe').'</a>',$changemessage);
						$changemessage .= '<img  style="display:none !important;width:0 !important;height:0 !important" src="'.$store_url.'index.php?route=mailsubscribe/click/imageread&codevalue=' .base64_encode($codedvalue).'" />';
						
						$message  = '<html dir="ltr" lang="en">' . "\n";
						$message .= '  <head>' . "\n";
						$message .= '    <title>' . $schedule['subject'] . '</title>' . "\n";
						$message .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
						if(isset($template['custom_css'])){
							
							$message .=	'<style type="text/css">'. html_entity_decode($template['custom_css'], ENT_COMPAT, 'UTF-8') . '</style>';
						}
						$message .= '  </head>' . "\n";
						$message .= '  <body>' . html_entity_decode($changemessage, ENT_COMPAT, 'UTF-8') . '</body>' . "\n";
						$message .= '</html>' . "\n";				
						
						$mail->setTo($email);
						
				  /* foreach ($attachments as $attachment) {
               				 $mail->addAttachment($attachment['path'], $attachment['filename']);
            		}*/
						$mail->setSubject(html_entity_decode($schedule['subject'], ENT_QUOTES, 'UTF-8'));					
						$mail->setHtml(html_entity_decode($message, ENT_COMPAT, 'UTF-8'));
						$send_ok = $mail->send();
						
						$reties = (int)$this->config->get('mailsubscribe_sent_retries');
						while (!$send_ok && $reties) {
							$send_ok = $mail->send();
							$reties--;
						}
						if(!$send_ok)
							$this->model_mailsubscribe_cron->updateFailed($newsletter_id);
						
					}
					if ($end < $email_total) {

						$this->response->redirect($this->url->link('mailsubscribe/cron&key=d41d8cd98f00b204e9800998ecf8427e&page='. ($page + 1)));
						
					} 
				}
			

            if ($schedule['recurrent'] == '1') {
                switch ($schedule['frequency']) {
                    case '1':
                        $this->model_mailsubscribe_cron->schedule_next($schedule['schedule_id'], date('Y-m-d', strtotime("next day")));
                        break;
                    case '7':
                    case '30':
                        $next_date = date('Y-m-d', strtotime("second " . $weekdays[$schedule['day']] . " of next " . $frequency[$schedule['frequency']]));
                        $this->model_mailsubscribe_cron->schedule_next($schedule['schedule_id'], $next_date);
                        break;
                    default:
                        $this->model_mailsubscribe_cron->schedule_inactive($schedule['schedule_id']);
                        break;
                }
            } else {
                $this->model_mailsubscribe_cron->schedule_inactive($schedule['schedule_id']);
            }
        }
    }
	public function send_queued(){
		$emails_in_queue = $this->model_mailsubscribe_cron->get_queue();
		
		$emails_to_send = array();

        foreach ($emails_in_queue as $email_queue) {

            if (!isset($emails_to_send[$email_queue['history_id']])) {
                $emails_to_send[$email_queue['history_id']] = array();
            }

            $emails_to_send[$email_queue['history_id']][$email_queue['email']] = array('queue_id' => $email_queue['queue_id'], 'retries' => $email_queue['retries']);
        }
		foreach ($emails_to_send as $history_id => $emails) {
			
			$message_info = $this->model_mailsubscribe_cron->get_newsletter($history_id);
			
			$store_info = $this->model_mailsubscribe_cron->getStore($message_info['store_id']);
			
			if ($store_info) {
					$store_name = $store_info['name'];
					$store_url = $store_info['url'];
				} else {
					$store_name = $this->config->get('config_name');
					$store_url = $this->config->get('config_url');	
			}
			
			$template = $this->model_mailsubscribe_cron->getTemplate($message_info['template_id']);
			
			$mail = new Mail_Mailsubscribe();	
			if($this->config->get('mailsubscribe_use_smtp')){
				$mail_config = $this->config->get('mailsubscribe_smtp');
				$mail->protocol = $mail_config[$message_info['store_id']]['protocol'];
				$mail->parameter = $mail_config[$message_info['store_id']]['parameter'];
				$mail->hostname = $mail_config[$message_info['store_id']]['host'];
				$mail->username = $mail_config[$message_info['store_id']]['username'];
				$mail->password = $mail_config[$message_info['store_id']]['password'];
				$mail->port = $mail_config[$message_info['store_id']]['port'];
				$mail->timeout = $mail_config[$message_info['store_id']]['timeout'];
				$mail->setFrom($mail_config[$message_info['store_id']]['email']);
				
			}else {
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->hostname = $this->config->get('config_smtp_host');
				$mail->username = $this->config->get('config_smtp_username');
				$mail->password = $this->config->get('config_smtp_password');
				$mail->port = $this->config->get('config_smtp_port');
				$mail->timeout = $this->config->get('config_smtp_timeout');	
				$mail->setFrom($this->config->get('config_email'));
			}
				
				$mail->setSender($store_name);///your storename
			foreach ($emails as  $email => $info) {
				if (isset($info['queue_id'])) {
					$this->model_mailsubscribe_cron->updateLocked($info['queue_id']);
				}			
				$message ='';
				$changemessage ='';
				$codedvalue = $email."~~".$history_id;
				$changemessage = str_replace('{web_version}',$this->language->get('text_web_version').'<a href="'.$store_url.'index.php?route=mailsubscribe/show&codevalue='.base64_encode($codedvalue).'">'.$this->language->get('text_web_version_here').'</a>',$message_info['message']);
				
				$changemessage = str_replace('{unsubscribe_url}','<a href='.$store_url.'index.php?route=mailsubscribe/click/unsubscribe&user='.base64_encode($email).'>'.$this->language->get('text_unsubscribe').'</a>',$changemessage);
				
				$changemessage .= '<img  style="display:none !important;width:0 !important;height:0 !important" src="'.$store_url.'index.php?route=mailsubscribe/click/imageread&codevalue=' .base64_encode($codedvalue).'" />';
				
				$message  = '<html dir="ltr" lang="en">' . "\n";
				$message .= '  <head>' . "\n";
				$message .= '    <title>' . $message_info['subject'] . '</title>' . "\n";
				$message .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
				if(isset($template['custom_css'])){
					
					$message .=	'<style type="text/css">'. html_entity_decode($template['custom_css'], ENT_COMPAT, 'UTF-8') . '</style>';
				}
				$message .= '  </head>' . "\n";
				$message .= '  <body>' . html_entity_decode($changemessage, ENT_COMPAT, 'UTF-8') . '</body>' . "\n";
				$message .= '</html>' . "\n";				
				
				$mail->setTo($email);
				
		  /* foreach ($attachments as $attachment) {
					 $mail->addAttachment($attachment['path'], $attachment['filename']);
			}*/
				$mail->setSubject(html_entity_decode($message_info['subject'], ENT_QUOTES, 'UTF-8'));					
				$mail->setHtml(html_entity_decode($message, ENT_COMPAT, 'UTF-8'));
				$send_ok = $mail->send();
				
				$reties = $this->config->get('mailsubscribe_sent_retries');
				while (!$send_ok && $reties) {
					$send_ok = $mail->send();
					$this->model_mailsubscribe_cron->updateRetries($info['queue_id']);
					$reties--;
				}
				if(!$send_ok)
					$this->model_mailsubscribe_cron->updateFailed($history_id);
				if (($send_ok && isset($info['queue_id'])) || (!$send_ok && isset($info['queue_id']) && isset($info['retries']) && ($info['retries'] > $this->config->get('mailsubscribe_sent_retries')))) {
					$this->model_mailsubscribe_cron->removeQueue($info['queue_id']);
					$this->model_mailsubscribe_cron->updateStat($history_id);
				}
			}
			
		}
		touch(KC_TIME);
		
	}

    


}

?>