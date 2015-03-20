<?php 
class ControllerSaleMailsubscribe extends Controller {
	
	private $error = array();
	 
	public function index() {
		
		$this->load->model('sale/mailsubscribe');
			
		if (isset($this->request->get['id']) && $this->request->server['REQUEST_METHOD'] != 'POST') {
            
            $this->request->post = $this->model_sale_mailsubscribe->detail($this->request->get['id']);
			
            if (!$this->request->post) {
               $this->response->redirect($this->url->link('sale/mailsubscribe', 'token=' . $this->session->data['token'], 'SSL'));
				
            }
        } 
		
		$this->load->language('sale/mailsubscribe');
 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['heading_title'] = $this->language->get('heading_title');
				
		$data['text_default'] = $this->language->get('text_default');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_newsletter_module'] = $this->language->get('text_newsletter_module');
		$data['text_customer_all'] = $this->language->get('text_customer_all');	
		$data['text_customer'] = $this->language->get('text_customer');	
		$data['text_customer_group'] = $this->language->get('text_customer_group');
		$data['text_affiliate_all'] = $this->language->get('text_affiliate_all');	
		$data['text_affiliate'] = $this->language->get('text_affiliate');	
		$data['text_product'] = $this->language->get('text_product');	
		$data['text_clear_warning'] = $this->language->get('text_clear_warning');	
		$data['select_theme_text'] = $this->language->get('select_theme_text');
		$data['text_loading'] = $this->language->get('text_loading');
		
		$data['help_customer'] = $this->language->get('help_customer');
		$data['help_affiliate'] = $this->language->get('help_affiliate');
		$data['help_product'] = $this->language->get('help_product');
		
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_language'] = $this->language->get('entry_language');
		$data['entry_currency'] = $this->language->get('entry_currency');
		$data['entry_to'] = $this->language->get('entry_to');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_affiliate'] = $this->language->get('entry_affiliate');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_subject'] = $this->language->get('entry_subject');
		$data['entry_message'] = $this->language->get('entry_message');
		$data['entry_yes'] = $this->language->get('entry_yes');
		$data['entry_no'] = $this->language->get('entry_no');
		$data['entry_defined'] = $this->language->get('entry_defined');
		$data['entry_special'] = $this->language->get('entry_special');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_latest'] = $this->language->get('entry_latest');
		$data['entry_popular'] = $this->language->get('entry_popular');
		$data['entry_template'] = $this->language->get('entry_template');
		$data['entry_section'] = $this->language->get('entry_section');
		$data['entry_categories'] = $this->language->get('entry_categories');
		$data['entry_manufactures'] = $this->language->get('entry_manufactures');
		$data['entry_addfile'] = $this->language->get('entry_addfile');
		
		$data['button_send'] = $this->language->get('button_send');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_preview'] = $this->language->get('button_preview');
		$data['button_draft'] = $this->language->get('button_draft');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add_defined_section'] = $this->language->get('button_add_defined_section');
		$data['button_add_file'] = $this->language->get('button_add_file');
		
		$data['token'] = $this->session->data['token'];

  		$data['breadcrumbs'] = array();
		
		if (isset($this->session->data['error']['warning'])) {
            $data['error_warning'] = $this->session->data['error']['warning'];
			unset($this->session->data['error']['warning']);
        } else {
            $data['error_warning'] = '';
        }
		
		if ($this->config->has('newslettersubscribe_status')){
			 $data['newslettersubscribe_status'] = $this->config->get('newslettersubscribe_status');
		}else {
			 $data['newslettersubscribe_status'] = 0;
		}
		
        if (!empty($this->session->data['error']['subject'])) {
            $data['error_subject'] = $this->session->data['error']['subject'];
			
			unset($this->session->data['error']['subject']);
        } else {
            $data['error_subject'] = '';
        }

        if (isset($this->session->data['error']['message'])) {
            $data['error_message'] = $this->session->data['error']['message'];
			unset($this->session->data['error']['message']);
        } else {
            $data['error_message'] = '';
        }

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/mailsubscribe', 'token=' . $this->session->data['token'], 'SSL'),
      		
   		);
				
    	$data['cancel'] = $this->url->link('sale/mailsubscribe', 'token=' . $this->session->data['token'], 'SSL');
		$data['draft_save'] = $this->url->link('sale/mailsubscribe/save', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('catalog/category');

        $data['categories'] = $this->model_catalog_category->getCategories(0);
		
		if (isset($this->request->get['id']) || isset($this->request->post['id'])) {
            $data['id'] = (isset($this->request->get['id']) ?$this->request->get['id'] : $this->request->post['id']);
        } else {
            $data['id'] = false;
        }
		
		if (!empty($this->request->post['attachments_id'])) {
            $data['attachments_id'] = $this->request->post['attachments_id'];
        } else {
            $data['attachments_id'] = time();
        }
		
        if (isset($this->request->post['defined'])) {
            $data['defined'] = $this->request->post['defined'];
        } else {
            $data['defined'] = false;
        }
		
		if (isset($this->request->post['defined_product_text'])) {
            $data['defined_product_text'] = $this->request->post['defined_product_text'];
        } else {
            $data['defined_product_text'] = false;
        }

        if (isset($this->request->post['defined_categories'])) {
            $data['defined_categories'] = $this->request->post['defined_categories'];
        } else {
            $data['defined_categories'] = false;
        }
		
		$data['defined_category'] = array();
		
        if (!empty($this->request->post['defined_category'])) {
            $defined_category = $this->request->post['defined_category'];
        } else {
            $defined_category = array();
        }
		
		// Categories
		$this->load->model('catalog/category');

		foreach ($defined_category as $category_id) {
			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
				$data['defined_category'][] = array(
					'category_id' => $category_info['category_id'],
					'name' => ($category_info['path']) ? $category_info['path'] . ' &gt; ' . $category_info['name'] : $category_info['name']
				);
			}
		}
		
		
		
		if (isset($this->request->post['defined_manufactures'])) {////for radio button
            $data['defined_manufactures'] = $this->request->post['defined_manufactures'];
        } else {
            $data['defined_manufactures'] = false;
        }
		
		$data['defined_manufacture'] = array();
		
		if (!empty($this->request->post['defined_manufacture'])) {///for array of manufacture
            $manufactures = $this->request->post['defined_manufacture'];
        } else {
            $manufactures = array();
        }
		
		
		$this->load->model('catalog/manufacturer');
		
		foreach($manufactures as $manufacturer_id){
			$manufacture_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id); 
			if ($manufacture_info) {
				$data['defined_manufacture'][] = array(
					'manufacturer_id' => $manufacture_info['manufacturer_id'],
					'name' => $manufacture_info['name']
				);
			}
		}
		
		
        if (isset($this->request->post['special'])) {
            $data['special'] = $this->request->post['special'];
        } else {
            $data['special'] = false;
        }

        if (isset($this->request->post['latest'])) {
            $data['latest'] = $this->request->post['latest'];
        } else {
            $data['latest'] = false;
        }

        if (isset($this->request->post['popular'])) {
            $data['popular'] = $this->request->post['popular'];
        } else {
            $data['popular'] = false;
        }

        if (isset($this->request->post['attachments'])) {
            $data['attachments'] = $this->request->post['attachments'];
        } else {
            $data['attachments'] = false;
        }
		
		
		////defined products here
        $this->load->model('catalog/product');

        $data['defined_products'] = array();

        if (isset($this->request->post['defined_product']) && is_array($this->request->post['defined_product'])) {
            foreach ($this->request->post['defined_product'] as $product_id) {
                $product_info = $this->model_catalog_product->getProduct($product_id);

                if ($product_info) {
                    $data['defined_products'][] = array(
                        'product_id' => $product_info['product_id'],
                        'name'       => $product_info['name']
                    );
                }
            }
            unset($product_info);
            unset($product_id);
        }
		 $data['defined_products_more'] = array();

        if (isset($this->request->post['defined_product_more']) && is_array($this->request->post['defined_product_more'])) {
            foreach ($this->request->post['defined_product_more'] as $dpm) {
                if (!isset($dpm['products'])) {
                    $dpm['products'] = array();
                }
                if (!isset($dpm['text'])) {
                    $dpm['text'] = '';
                }
                $defined_products_more = array('text' => $dpm['text'], 'products' => array());
                foreach ($dpm['products'] as $product_id) {
                    $product_info = $this->model_catalog_product->getProduct($product_id);

                    if ($product_info) {
                        $defined_products_more['products'][] = array(
                            'product_id' => $product_info['product_id'],
                            'name'       => $product_info['name']
                        );
                    }
                }
                $data['defined_products_more'][] = $defined_products_more;
            }
            unset($defined_products_more);
            unset($product_info);
            unset($product_id);
        }
		
		
		
        if (isset($this->request->post['store_id'])) {
            $data['store_id'] = $this->request->post['store_id'];
        } else {
            $data['store_id'] = '';
        }
				
		$this->load->model('setting/store');
		
		$data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->post['language_id'])) {
            $data['language_id'] = $this->request->post['language_id'];
        } else {
            $data['language_id'] = '';
        }

		
		$this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();
		
				
		if (isset($this->request->post['currency'])) {
            $data['currency'] = $this->request->post['currency'];
        } else {
            $data['currency'] = '';
        }

		
		$this->load->model('localisation/currency');

        $data['currencies'] = $this->model_localisation_currency->getCurrencies();
		
		if (isset($this->request->post['to'])) {
            $data['to'] = $this->request->post['to'];
        } else {
            $data['to'] = '';
        }

        if (isset($this->request->post['customer_group_id'])) {
            $data['customer_group_id'] = $this->request->post['customer_group_id'];
        } else {
            $data['customer_group_id'] = '';
        }
		
		$this->load->model('sale/customer_group');
				
		$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups(0);
		
		$data['customers'] = array();

        if (isset($this->request->post['customer']) && is_array($this->request->post['customer'])) {
			$this->load->model('sale/customer');
            foreach ($this->request->post['customer'] as $customer_id) {
                $customer_info = $this->model_sale_customer->getCustomer($customer_id);

                if ($customer_info) {
                    $data['customers'][] = array(
                        'customer_id' => $customer_info['customer_id'],
                        'name'        => $customer_info['firstname'] . ' ' . $customer_info['lastname']
                    );
                }
            }
        }
		
		$data['affiliates'] = array();

        if (isset($this->request->post['affiliate']) && is_array($this->request->post['affiliate'])) {
			$this->load->model('sale/affiliate');
            foreach ($this->request->post['affiliate'] as $affiliate_id) {
                $affiliate_info = $this->model_sale_affiliate->getAffiliate($affiliate_id);

                if ($affiliate_info) {
                    $data['affiliates'][] = array(
                        'affiliate_id' => $affiliate_info['affiliate_id'],
                        'name'         => $affiliate_info['firstname'] . ' ' . $affiliate_info['lastname']
                    );
                }
            }
        }

        $this->load->model('catalog/product');

        $data['products'] = array();

        if (isset($this->request->post['product']) && is_array($this->request->post['product'])) {
            foreach ($this->request->post['product'] as $product_id) {
                $product_info = $this->model_catalog_product->getProduct($product_id);

                if ($product_info) {
                    $data['products'][] = array(
                        'product_id' => $product_info['product_id'],
                        'name'       => $product_info['name']
                    );
                }
            }
        }
		
		if (isset($this->request->post['template_id'])) {
            $data['template_id'] = $this->request->post['template_id'];
        } else {
            $data['template_id'] = '';
        }
		if (isset($this->request->post['subject'])) {
            $data['subject'] = $this->request->post['subject'];
        } else {
            $data['subject'] = '';
        }

        if (isset($this->request->post['message'])) {
            $data['message'] = $this->request->post['message'];
        } else {
            $data['message'] = '';
        }
		
    	
		$data['templates'] = $this->model_sale_mailsubscribe->getTemplates();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/mailsubscirbe.tpl', $data));		
		
	}
	public function send() {
		require_once(DIR_SYSTEM . 'library/mail_mailsubscribe.php');
		
		$this->load->language('sale/mailsubscribe');
		
		$json = array();
		$template = array();
		$attachments = array();
		$newsletter_id = 0;
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if (!$this->user->hasPermission('modify', 'sale/mailsubscribe')) {
				$json['error']['warning'] = $this->language->get('error_permission');
			}
					
			if (!$this->request->post['subject']) {
				$json['error']['subject'] = $this->language->get('error_subject');
			}
	
			if (!$this->request->post['message']) {
				$json['error']['message'] = $this->language->get('error_message');
			}
			$this->load->model('sale/mailsubscribe');
			$data2 = array(
				'template_id' => $this->request->post['inserttemplate'],
				'language_id' => (int)(isset($this->request->post['language_id']) ? $this->request->post['language_id'] : $this->config->post('config_language_id'))
			);
			
			$template = $this->model_sale_mailsubscribe->templateGet($data2);
			
			if (is_dir(dirname(DIR_DOWNLOAD) . DIRECTORY_SEPARATOR . 'attachments' .
						DIRECTORY_SEPARATOR . $this->request->post['attachments_id'])) {
				foreach (glob(dirname(DIR_DOWNLOAD) . DIRECTORY_SEPARATOR . 'attachments' .
					DIRECTORY_SEPARATOR . $this->request->post['attachments_id'] . DIRECTORY_SEPARATOR . '*') as $path) {
					if (file_exists($path)) {
						$attachments[] = array(
							'filename' => basename($path),
							'path'     => $path
						);
					}
				}
			}
			
			if (!$json) {
				$this->load->model('setting/store');
			
				$store_info = $this->model_setting_store->getStore($this->request->post['store_id']);			
				
				if ($store_info) {
					$store_name = $store_info['name'];
					$store_url = $store_info['url'];
				} else {
					$store_name = $this->config->get('config_name');
					$store_url = HTTP_CATALOG;
				}
				
				if (empty($this->request->post['newsletter_id'])) {
                        $newsletter_id = $this->model_sale_mailsubscribe->addHistory(array(
                            'to' => $this->request->post['to'],
                            'subject' => $this->request->post['subject'],
                            'message' => $this->request->post['message'],
                            'attachments_id' => $this->request->post['attachments_id'],
                            'store_id' => $this->request->post['store_id'],
                            'template_id' => $this->request->post['inserttemplate'],
                            'language_id' => $this->request->post['language_id']
                        ));
                    } else {
                        $newsletter_id = $this->request->post['newsletter_id'];
                    }
				if (empty($this->request->post['sent_count_email'])) {
                    $sent_count_email = 0;
                } else {
                    $sent_count_email = (int)$this->request->post['sent_count_email'];
                }
	
				$this->load->model('sale/customer');
				
				$this->load->model('sale/customer_group');
				
				$this->load->model('marketing/affiliate');
	
				$this->load->model('sale/order');
	
				if (isset($this->request->get['page'])) {
					$page = $this->request->get['page'];
				} else {
					$page = 1;
				}
								
				$email_total = 0;
							
				$emails = array();
				
				switch ($this->request->post['to']) {
					case 'newsletter':
						$customer_data = array(
							'filter_newsletter' => 1,
							'start'             => ($page - 1) * 10,
							'limit'             => 10
						);
						
						$email_total = $this->model_sale_customer->getTotalCustomers($customer_data);
							
						$results = $this->model_sale_customer->getCustomers($customer_data);
					
						foreach ($results as $result) {
							$emails[] = $result['email'];
						}
						break;
					case 'customer_all':
						$customer_data = array(
							'start'  => ($page - 1) * 10,
							'limit'  => 10
						);
									
						$email_total = $this->model_sale_customer->getTotalCustomers($customer_data);
										
						$results = $this->model_sale_customer->getCustomers($customer_data);
				
						foreach ($results as $result) {
							$emails[] = $result['email'];
						}						
						break;
					case 'customer_group':
						$customer_data = array(
							'filter_customer_group_id' => $this->request->post['customer_group_id'],
							'start'                    => ($page - 1) * 10,
							'limit'                    => 10
						);
						
						$email_total = $this->model_sale_customer->getTotalCustomers($customer_data);
										
						$results = $this->model_sale_customer->getCustomers($customer_data);
				
						foreach ($results as $result) {
							$emails[$result['customer_id']] = $result['email'];
						}						
						break;
					case 'customer':
						if (!empty($this->request->post['customer'])) {					
							foreach ($this->request->post['customer'] as $customer_id) {
								$customer_info = $this->model_sale_customer->getCustomer($customer_id);
								
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
						
						$email_total = $this->model_sale_affiliate->getTotalAffiliates($affiliate_data);		
						
						$results = $this->model_sale_affiliate->getAffiliates($affiliate_data);
				
						foreach ($results as $result) {
							$emails[] = $result['email'];
						}						
						break;	
					case 'affiliate':
						if (!empty($this->request->post['affiliate'])) {					
							foreach ($this->request->post['affiliate'] as $affiliate_id) {
								$affiliate_info = $this->model_sale_affiliate->getAffiliate($affiliate_id);
								
								if ($affiliate_info) {
									$emails[] = $affiliate_info['email'];
								}
							}
						}
						break;											
					case 'product':
						if (isset($this->request->post['product'])) {
							$email_total = $this->model_sale_order->getTotalEmailsByProductsOrdered($this->request->post['product']);	
							
							$results = $this->model_sale_order->getEmailsByProductsOrdered($this->request->post['product'], ($page - 1) * 10, 10);
													
							foreach ($results as $result) {
								$emails[] = $result['email'];
							}
						}
					break;
					case 'newsletter_module':
						$newsletter_module = array(
							'store_id' => $this->request->post['store_id'],
							'start'                    => ($page - 1) * 10,
							'limit'                    => 10
						);
							$email_total = $this->model_sale_mailsubscribe->getTotalEmailsNewsletterModule($this->request->post['store_id']);	
							
							$results = $this->model_sale_mailsubscribe->getEmailsNewsletterModule($newsletter_module);
													
							foreach ($results as $result) {
								$emails[] = $result['email'];
							}
						
						break;
				}
				
				
				$sent_count_email += ($emails ? count($emails) : 0);

                $json['sent_count_email'] = $sent_count_email;
				
				if ($emails) {
					
					$start = ($page - 1) * 10;
					$end = $start + 10;
					
					if ($end < $email_total) {
						$json['success'] = sprintf($this->language->get('text_sent'), $sent_count_email, $email_total);
						$json['next'] = str_replace('&amp;', '&', $this->url->link('sale/mailsubscribe/send', 'token=' . $this->session->data['token'] . '&page=' . ($page + 1), 'SSL'));
						$json['newsletter_id'] = $newsletter_id;
						if($this->config->get('mailsubscribe_throttle') && $newsletter_id && ($email_total > $this->config->get('mailsubscribe_throttle_count')))
							$json['success'] = sprintf($this->language->get('text_sent_queue'),$sent_count_email);
						
					} else { 
						$json['success'] = $this->language->get('text_success');
						$json['next'] = '';
						$json['newsletter_id'] = 0;
						
						if($this->config->get('mailsubscribe_throttle') && $newsletter_id && ($email_total > $this->config->get('mailsubscribe_throttle_count')))
							$json['success'] = sprintf($this->language->get('text_sent_queue'),$sent_count_email);
					}				
						
							
						
									
					
						
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
						$this->model_sale_mailsubscribe->addStatQueue($newsletter_id, array(
							'queue' => ($this->config->get('mailsubscribe_throttle') && $newsletter_id && ($email_total > $this->config->get('mailsubscribe_throttle_count')) ? 0 : $sent_count_email),
							'recipients' => $sent_count_email
						));	
					}
					foreach ($emails as $email) {
						
						
						if($this->config->get('mailsubscribe_throttle') && $newsletter_id && ($email_total > $this->config->get('mailsubscribe_throttle_count'))){
							$this->model_sale_mailsubscribe->addQueue(array(
								'history_id' => $newsletter_id,
								'email'		=> $email
								
							));
							
							continue;
						}
						
						
						$message ='';
						$changemessage ='';
						$codedvalue = $email."~~".$newsletter_id;
						$changemessage = str_replace('{web_version}',$this->language->get('text_web_version').'<a href='.$store_url.'index.php?route=mailsubscribe/show&codevalue='.base64_encode($codedvalue).'>'.$this->language->get('text_web_version_here').'</a>',$this->request->post['message']);
				
						$changemessage = str_replace('{unsubscribe_url}','<a href='.$store_url.'index.php?route=mailsubscribe/click/unsubscribe&user='.base64_encode($email).'>'.$this->language->get('text_unsubscribe').'</a>',$changemessage);
						$changemessage .= '<img  style="display:none !important;width:0 !important;height:0 !important" src="'.$store_url.'index.php?route=mailsubscribe/click/imageread&codevalue=' .base64_encode($codedvalue).'" />';
						
						$message  = '<html dir="ltr" lang="en">' . "\n";
						$message .= '  <head>' . "\n";
						$message .= '    <title>' . $this->request->post['subject'] . '</title>' . "\n";
						$message .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
						if(isset($template['custom_css'])){
							
							$message .=	'<style type="text/css">'. html_entity_decode($template['custom_css'], ENT_COMPAT, 'UTF-8') . '</style>';
						}
						$message .= '  </head>' . "\n";
						$message .= '  <body>' . html_entity_decode($changemessage, ENT_COMPAT, 'UTF-8') . '</body>' . "\n";
						$message .= '</html>' . "\n";
						
											
						$mail->setTo($email);
						
					   foreach ($attachments as $attachment) {
								 $mail->addAttachment($attachment['path'], $attachment['filename']);
						}
						$mail->setSubject(html_entity_decode($this->request->post['subject'], ENT_QUOTES, 'UTF-8'));					
						$mail->setHtml(html_entity_decode($message, ENT_COMPAT, 'UTF-8'));
						$send_ok = $mail->send();
						
						$reties = (int)$this->config->get('mailsubscribe_sent_retries');
						while (!$send_ok && $reties) {
							$send_ok = $mail->send();
							$reties--;
						}
						if(!$send_ok)
							$this->model_sale_mailsubscribe->updateFailed($newsletter_id);
					}
					
				}
			
			
			}
		}
		
		$this->response->setOutput(json_encode($json));	
	}
	public function gettemplate(){
		 if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $server = defined('HTTPS_IMAGE') ? HTTPS_IMAGE : HTTPS_CATALOG . 'image/';
        } else {
            $server = defined('HTTP_IMAGE') ? HTTP_IMAGE : HTTP_CATALOG . 'image/';
        }
		
		$body = '';
		$subject = '';
		$template =	array();
		$store_id = 0;
		$this->load->model('sale/mailsubscribe');
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
		
			$data2 = array(
				'template_id' => $this->request->post['template_id'],
				'language_id' => (int)(isset($this->request->post['language_id']) ? $this->request->post['language_id'] : $this->config->post('config_language_id'))
			);
			$store_id = $this->request->post['store_id'];
			
			$template = $this->model_sale_mailsubscribe->templateGet($data2);
			
		
		}
		$store_logo = $this->model_sale_mailsubscribe->getStoreLogo($store_id);
		
		$this->load->model('setting/store');		
		
		$store_info = $this->model_setting_store->getStore($this->request->post['store_id']);			
			if ($store_info) {
				$store_url = $store_info['url'];
			} else {
				$store_url = HTTP_CATALOG;
			}
			
		unset($data2);
		
				

		if(isset($template['body'])){
			$body = html_entity_decode($template['body']);
			$subject = html_entity_decode($template['subject']);
			////adding logo in the template  
			
			if ($store_logo['value'] && file_exists(DIR_IMAGE . $store_logo['value'])) {
                $body = str_replace('{logo}', '<!--//logo//--><a href="' . $this->url->link('common/home') . '" target="_blank"><img src="' . $server . $store_logo['value'] . '" alt=""/></a><!--//end logo//-->', $body);
                $body = $this->replaceTags('<!--//logo//-->', '<!--//end logo//-->', '<a href="' . $store_url.'index.php?route=common/home' . '" target="_blank"><img src="' . $server . $store_logo['value'] . '" alt=""/></a>', $body);
            } else {
                $body = str_replace('{logo}', '<!--//logo//--><!--//end logo//-->', $body);
                $body = $this->replaceTags('<!--//logo//-->', '<!--//end logo//-->', '', $body);
            }

            if (strpos($body, '{date}') !== false) {
                
                 $localisation_months = $this->config->get('mailsubscribe_months');
                $localisation_weekdays = $this->config->get('mailsubscribe_weekdays');
                $body = str_replace('{date}', ($localisation_weekdays[$template['language_id']][(int)date('w')] . ', ' . date('j') . ' ' . $localisation_months[$template['language_id']][(int)date('m') - 1] . ' ' . date('Y')), $body);
            }
			
			$body = str_replace(
					array(
						'{defined}',
						'{special}',
						'{latest}',
						'{popular}',
						'{categories}',
						'{manufactures}'
					),
					array(
						'<!--//defined//--><!--//end defined//-->',
						'<!--//special//--><!--//end special//-->',
						'<!--//latest//--><!--//end latest//-->',
						'<!--//popular//--><!--//end popular//-->',
						'<!--//defined_categories//--><!--//end defined_categories//-->',
						'<!--//defined_manufactures//--><!--//end defined_manufactures//-->'
					),
					$body
				);
		} else 
			$body = '';
		
		$response = json_encode(array('subject' => $subject, 'body' => $body));
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput($response);
	}
	public function insertproduct(){
		
		 if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $server = defined('HTTPS_IMAGE') ? HTTPS_IMAGE : HTTPS_CATALOG . 'image/';
        } else {
            $server = defined('HTTP_IMAGE') ? HTTP_IMAGE : HTTP_CATALOG . 'image/';
        }
		
		
		$body = '';
		$subject='';
		$store_id = 0;	
		$template =	array();
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			////uploading theme again here
		
			 $data2 = array(
            'template_id' => $this->request->post['template_id'],
           	'language_id' => (int)(isset($this->request->post['language_id']) ? $this->request->post['language_id'] : $this->config->post('config_language_id'))
        );
			$store_id = $this->request->post['store_id'];
			
			$this->load->model('setting/store');
			
			$store_info = $this->model_setting_store->getStore($this->request->post['store_id']);			
			if ($store_info) {
				$store_url = $store_info['url'];
			} else {
				$store_url = HTTP_CATALOG;
			}
			$this->load->model('sale/mailsubscribe');
			$template = $this->model_sale_mailsubscribe->templateGet($data2);
			
			$clear = (isset($this->request->post['clear']) && $this->request->post['clear']);
			$currency_id = isset($this->request->post['currency_id']) ? $this->request->post['currency_id'] : '';
			
			$currency_info = $this->model_sale_mailsubscribe->getCurrency($currency_id);
			
			$subject = (((isset($this->request->post['subject']) && $this->request->post['subject']) && !$clear) ? html_entity_decode($this->request->post['subject'], ENT_QUOTES, 'UTF-8') : $template['subject']);
			
			if((isset($this->request->post['message']) && $this->request->post['message']) && !$clear)
				$body = html_entity_decode($this->request->post['message']);	
			else{
				if(!is_null($template['body']))
					$body = html_entity_decode($template['body']);
				else
					$body = '';
			}
			
			$store_logo = $this->model_sale_mailsubscribe->getStoreLogo($store_id); // for logo query
			
			if ($store_logo['value'] && file_exists(DIR_IMAGE . $store_logo['value'])) {
                $body = str_replace('{logo}', '<!--//logo//--><a href="' . $this->url->link('common/home') . '" target="_blank"><img src="' . $server . $store_logo['value'] . '" alt=""/></a><!--//end logo//-->', $body);
                $body = $this->replaceTags('<!--//logo//-->', '<!--//end logo//-->', '<a href="' . $store_url.'index.php?route=common/home' . '" target="_blank"><img src="' . $server . $store_logo['value'] . '" alt=""/></a>', $body);
            } else {
                $body = str_replace('{logo}', '<!--//logo//--><!--//end logo//-->', $body);
                $body = $this->replaceTags('<!--//logo//-->', '<!--//end logo//-->', '', $body);
            }

            if (strpos($body, '{date}') !== false) {
                $localisation_months = $this->config->get('mailsubscribe_months');
                $localisation_weekdays = $this->config->get('mailsubscribe_weekdays');
                $body = str_replace('{date}', ($localisation_weekdays[$template['language_id']][(int)date('w')] . ', ' . date('j') . ' ' . $localisation_months[$template['language_id']][(int)date('m') - 1] . ' ' . date('Y')), $body);
            }
			
			$body = str_replace(
                array(
                    '{defined}',
                    '{special}',
                    '{latest}',
                    '{popular}',
                    '{categories}',
					'{manufactures}'
                ),
                array(
                    '<!--//defined//--><!--//end defined//-->',
                    '<!--//special//--><!--//end special//-->',
                    '<!--//latest//--><!--//end latest//-->',
                    '<!--//popular//--><!--//end popular//-->',
                    '<!--//defined_categories//--><!--//end defined_categories//-->',
					'<!--//defined_manufactures//--><!--//end defined_manufactures//-->'
                ),
                $body
            );
			unset($data2);
			
			
			$data['columns_count'] = $template['product_cols'];////for changes in the tpl folder files
			
            $data['heading_color'] = $template['heading_color'];
            $data['heading_style'] = $template['heading_style'];

            $data['name_color'] = $template['product_name_color'];
            $data['name_style'] = $template['product_name_style'];
			
			$data['show_price'] = $template['show_price'];

            $data['model_color'] = $template['product_model_color'];
            $data['model_style'] = $template['product_model_style'];

            
            $data['price_color'] = $template['product_price_color'];
            $data['price_style'] = $template['product_price_style'];

            $data['special_color'] = $template['product_price_color_special'];
            $data['special_style'] = $template['product_price_style_special'];

            

            $data['description_color'] = $template['product_description_color'];
            $data['description_style'] = $template['product_description_style'];

            $data['image_width'] = $template['image_width'];
            $data['image_height'] = $template['image_height'];
			
			$data['heading'] ='';
			
			$this->load->model('tool/image');
			
			/////defined products specific selection in a section
			 $data_setting = array(
                'language_id' => (int)(isset($this->request->post['language_id']) ? $this->request->post['language_id'] : $this->config->get('config_language_id')),
                'customer_group_id' => (int)((isset($this->request->post['customer_group_id']) && $this->request->post['customer_group_id']) ? $this->request->post['customer_group_id'] : $this->config->get('config_customer_group_id')),
                'store_id' => (int)(isset($this->request->post['store_id']) ? $this->request->post['store_id'] : $this->config->get('config_store_id'))
            );

			$data['products'] = array();
			if (((isset($this->request->post['defined']) && $this->request->post['defined']) || (isset($this->request->post['defined_more']) && $this->request->post['defined_more'])) && (!isset($this->request->post['recurrent']) || (isset($this->request->post['recurrent']) && !$this->request->post['recurrent'])))
            {
				if (!isset($this->request->post['defined']) || !$this->request->post['defined']) {
                    $this->request->post['defined'] = array();
                }
						
						
						if(isset($this->request->post['defined_product_text']) && $this->request->post['defined_product_text'])
							$data['heading'] = $this->request->post['defined_product_text'];
						else
							$data['heading'] = $template['defined'];
							
						foreach($this->request->post['defined'] as $product_id){
							
							$result = $this->model_sale_mailsubscribe->insertDefinedProduct($product_id, $data_setting);
							if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
								$image = $this->model_tool_image->resize($result['image'], $template['image_width'], $template['image_height']);
							} else {
								$image = $this->model_tool_image->resize('no_image.jpg', $template['image_width'], $template['image_height']);
							}
							
							$image = str_replace(' ', '%20', $image);
							
							if ($template['show_price']) {
								$price = $this->currency->format($result['price'], $currency_info['code'], $currency_info['value']);
							} else {
								$price = false;
							}
							if ($template['show_price'] && (float)$result['special']) {
								$special = $this->currency->format($result['special'], $currency_info['code'], $currency_info['value']);
							} else {
								$special = false;
							}
						
							$data['products'][] = array(
									'product_id'  => $result['product_id'],
									'thumb'   	  => $image,
									'name'    	  => $result['name'],
									'price'    	  => str_replace('$', ':usd', $price),
									'special'     => str_replace('$', ':usd', $special),
									'saving'      => 0,
									'model'       => (isset($result['model']) ? $result['model'] : ''),
									'description' => ((int)$template['product_description_length'] ? mb_substr(trim(preg_replace("/\s\s+/u", ' ', strip_tags(html_entity_decode(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')))), 0, (int)$template['product_description_length'], 'UTF-8') . '..' : ''),
									'href'    	  => $store_url.'index.php?route=product/product&product_id=' . $result['product_id'],
								);
						}
						unset($result); //// since using same variable in another loop
					///using tpl file to show products
												
						$defined = $this->load->view('sale/mailsubscribe/templates/' . $template['uri'] . '/definedproducts.tpl', $data);
					
					////defined more products 
					if (!isset($this->request->post['defined_more']) || !$this->request->post['defined_more']) {
						$this->request->post['defined_more'] = array();
					}
	
					foreach ($this->request->post['defined_more'] as $defined_more) {
						
						if (!isset($defined_more['products']) || !$defined_more['products']) {
							continue;
						}
	
						$data['heading'] = isset($defined_more['text']) ? $defined_more['text'] : '';
	
						$data['products'] = array();
	
						foreach ($defined_more['products'] as $product_id) {
								$result = $this->model_sale_mailsubscribe->insertDefinedProduct($product_id, $data_setting);
	
							if (!$result) {
								continue;
							}
	
							if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
								$image = $this->model_tool_image->resize($result['image'], $template['image_width'], $template['image_height']);
							} else {
								$image = $this->model_tool_image->resize('no_image.jpg', $template['image_width'], $template['image_height']);
							}
							
							$image = str_replace(' ', '%20', $image);
							
							if ($template['show_price']) {
								$price = $this->currency->format($result['price'], $currency_info['code'], $currency_info['value']);
							} else {
								$price = false;
							}
							if ($template['show_price'] && (float)$result['special']) {
								$special = $this->currency->format($result['special'], $currency_info['code'], $currency_info['value']);
							} else {
								$special = false;
							}
						
							$data['products'][] = array(
									'product_id'  => $result['product_id'],
									'thumb'   	  => $image,
									'name'    	  => $result['name'],
									'price'    	  => str_replace('$', ':usd', $price),
									'special'     => str_replace('$', ':usd', $special),
									'saving'      => 0,
									'model'       => (isset($result['model']) ? $result['model'] : ''),
									'description' => ((int)$template['product_description_length'] ? mb_substr(trim(preg_replace("/\s\s+/u", ' ', strip_tags(html_entity_decode(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')))), 0, (int)$template['product_description_length'], 'UTF-8') . '..' : ''),
									'href'    	  => $store_url.'index.php?route=product/product&product_id=' . $result['product_id'],
								);
						}
						unset($result); 
	
						$defined .= $this->load->view('sale/mailsubscribe/templates/' . $template['uri'] . '/definedproducts.tpl', $data);
					}
	
						$body = $this->replaceTags('<!--//defined//-->', '<!--//end defined//-->', $defined, $body);
						$body = str_replace(':usd', '$', $body);
			} else {
						$body = $this->replaceTags('<!--//defined//-->', '<!--//end defined//-->', '', $body);
			}
			/////defined_categories
			$data['products'] = array();

           if (isset($this->request->post['defined_categories2']) && $this->request->post['defined_categories2'])
            {
               $defined_categories = '';

                foreach ($this->request->post['defined_categories2'] as $category_id) {
					
					$data2 = array_merge(array(
						'category_id' => $category_id
					), $data_setting);
					
                    $data['heading'] = $this->model_sale_mailsubscribe->getPath($data2);////later on change with category name

                    
                    $products = $this->model_sale_mailsubscribe->getProductsByCategoryId($data2);
					$data['products'] = array();
                    foreach ($products as $product) {
                      
                        $result = $this->model_sale_mailsubscribe->insertDefinedProduct((int)$product['product_id'],$data2);

                        if (!$result) {
                            continue;
                        }

                        
						if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
							$image = $this->model_tool_image->resize($result['image'], $template['image_width'], $template['image_height']);
						} else {
							$image = $this->model_tool_image->resize('no_image.jpg', $template['image_width'], $template['image_height']);
						}

                        $image = str_replace(' ', '%20', $image);
						
						if ($template['show_price']) {
							$price = $this->currency->format($result['price'], $currency_info['code'], $currency_info['value']);
						} else {
							$price = false;
						}
						if ($template['show_price'] && (float)$result['special']) {
                        	$special = $this->currency->format($result['special'], $currency_info['code'], $currency_info['value']);
						} else {
							$special = false;
						}
                      
						$data['products'][] = array(
									'product_id'  => $result['product_id'],
									'thumb'   	  => $image,
									'name'    	  => $result['name'],
									'price'    	  => str_replace('$', ':usd', $price),
									'special'     => str_replace('$', ':usd', $special),
									'saving'      => 0,
									'model'       => (isset($result['model']) ? $result['model'] : ''),
									'description' => ((int)$template['product_description_length'] ? mb_substr(trim(preg_replace("/\s\s+/u", ' ', strip_tags(html_entity_decode(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')))), 0, (int)$template['product_description_length'], 'UTF-8') . '..' : ''),
									'href'    	  => $store_url.'index.php?route=product/product&product_id=' . $result['product_id'],
								);
						}
						unset($result); 
  
                    $defined_categories = $this->load->view('sale/mailsubscribe/templates/' . $template['uri'] . '/categories.tpl', $data);

                }

                $body = $this->replaceTags('<!--//defined_categories//-->', '<!--//end defined_categories//-->', $defined_categories, $body);
				$body = str_replace(':usd', '$', $body);
			} else {
                $body = $this->replaceTags('<!--//defined_categories//-->', '<!--//end defined_categories//-->', '', $body);
            }
			/////defined_manufactures
			$data['products'] = array();

            if (isset($this->request->post['defined_manufactures']) && $this->request->post['defined_manufactures'])
            {
                
                $defined_manufactures = '';
				
				$this->load->model('catalog/manufacturer');
				
                foreach ($this->request->post['defined_manufactures'] as $manufacturer_id) {
					
					
						
					$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);
                    $data['heading'] = $manufacturer_info['name'];////later on change with category name
					
					
					$data2 = array_merge(array(
						'manufacturer_id' => $manufacturer_id
					), $data_setting);	
                    
                    $products = $this->model_sale_mailsubscribe->getProductsByManufacturerId($data2);
					$data['products'] = array();
                    foreach ($products as $product) {
                      
                        $result = $this->model_sale_mailsubscribe->insertDefinedProduct((int)$product['product_id'], $data2);

                        if (!$result) {
                            continue;
                        }

                        
						if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
							$image = $this->model_tool_image->resize($result['image'], $template['image_width'], $template['image_height']);
						} else {
							$image = $this->model_tool_image->resize('no_image.jpg', $template['image_width'], $template['image_height']);
						}

                        $image = str_replace(' ', '%20', $image);

                      if ($template['show_price']) {
							$price = $this->currency->format($result['price'], $currency_info['code'], $currency_info['value']);
						} else {
							$price = false;
						}
						if ($template['show_price'] && (float)$result['special']) {
                        	$special = $this->currency->format($result['special'], $currency_info['code'], $currency_info['value']);
						} else {
							$special = false;
						}
						$data['products'][] = array(
									'product_id'  => $result['product_id'],
									'thumb'   	  => $image,
									'name'    	  => $result['name'],
									'price'    	  => str_replace('$', ':usd', $price),
									'special'     => str_replace('$', ':usd', $special),
									'saving'      => 0,
									'model'       => (isset($result['model']) ? $result['model'] : ''),
									'description' => ((int)$template['product_description_length'] ? mb_substr(trim(preg_replace("/\s\s+/u", ' ', strip_tags(html_entity_decode(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')))), 0, (int)$template['product_description_length'], 'UTF-8') . '..' : ''),
									'href'    	  => $store_url.'index.php?route=product/product&product_id=' . $result['product_id'],
								);
						}
						unset($result); 

                    $defined_manufactures = $this->load->view('sale/mailsubscribe/templates/' . $template['uri'] . '/manufactures.tpl', $data);
                       
                }

                $body = $this->replaceTags('<!--//defined_manufactures//-->', '<!--//end defined_manufactures//-->', $defined_manufactures, $body);
				$body = str_replace(':usd', '$', $body);
            } else {
                $body = $this->replaceTags('<!--//defined_manufactures//-->', '<!--//end defined_manufactures//-->', '', $body);
            }
			/////products for special
			$data['products'] = array();
			if(isset($this->request->post['special']) && $this->request->post['special']){
					$data['heading'] = $template['special'];
					$data2 = array_merge(array(
						'limit' => (int)$template['special_product_count']
					), $data_setting);
					$results = $this->model_sale_mailsubscribe->insertSpecialProducts($data2);
					
					
					foreach($results as $result){
						if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
							$image = $this->model_tool_image->resize($result['image'], $template['image_width'], $template['image_height']);
						} else {
							$image = $this->model_tool_image->resize('no_image.jpg', $template['image_width'], $template['image_height']);
						}
						
						$image = str_replace(' ', '%20', $image);
						if ($template['show_price']) {
							$price = $this->currency->format($result['price'], $currency_info['code'], $currency_info['value']);
						} else {
							$price = false;
						}
						if ($template['show_price'] && (float)$result['special']) {
                        	$special = $this->currency->format($result['special'], $currency_info['code'], $currency_info['value']);
						} else {
							$special = false;
						}
						
						$data['products'][] = array(
								'product_id'  => $result['product_id'],
								'thumb'   	  => $image,
								'name'    	  => $result['name'],
								'price'    	  => str_replace('$', ':usd', $price),
								'special'     => str_replace('$', ':usd', $special),
								'saving'      => 0,
								'model'       => (isset($result['model']) ? $result['model'] : ''),
								'description' => ((int)$template['product_description_length'] ? mb_substr(trim(preg_replace("/\s\s+/u", ' ', strip_tags(html_entity_decode(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')))), 0, (int)$template['product_description_length'], 'UTF-8') . '..' : ''),
								'href'    	  => $store_url.'index.php?route=product/product&product_id=' . $result['product_id'],
							);
					}
					unset($result); //// since using same variable in another loop
				///using tpl file to show products
				
					$special = $this->load->view('sale/mailsubscribe/templates/' . $template['uri'] . '/special.tpl', $data);
					
					
			 		$body = $this->replaceTags('<!--//special//-->', '<!--//end special//-->', $special, $body);
					$body = str_replace(':usd', '$', $body);	
					
			
					
            	} else {
                	$body = $this->replaceTags('<!--//special//-->', '<!--//end special//-->', '', $body);
            	}
			/////products for latest
			$data['products'] = array();
			if(isset($this->request->post['latest']) && $this->request->post['latest']){
					$data['heading'] = $template['latest'];
					$data2 = array_merge(array(
						'limit' => (int)$template['latest_product_count']
					), $data_setting);
				
					$results = $this->model_sale_mailsubscribe->insertLatestProducts($data2);
					
					
					foreach($results as $result){
						if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
							$image = $this->model_tool_image->resize($result['image'], $template['image_width'], $template['image_height']);
						} else {
							$image = $this->model_tool_image->resize('no_image.jpg', $template['image_width'], $template['image_height']);
						}
						
						$image = str_replace(' ', '%20', $image);
							
						if ($template['show_price']) {
							$price = $this->currency->format($result['price'], $currency_info['code'], $currency_info['value']);
						} else {
							$price = false;
						}
						if ($template['show_price'] && (float)$result['special']) {
                        	$special = $this->currency->format($result['special'], $currency_info['code'], $currency_info['value']);
						} else {
							$special = false;
						}
						
						$data['products'][] = array(
								'product_id'  => $result['product_id'],
								'thumb'   	  => $image,
								'name'    	  => $result['name'],
								'price'    	  => str_replace('$', ':usd', $price),
								'special'     => str_replace('$', ':usd', $special),
								'saving'      => 0,
								'model'       => (isset($result['model']) ? $result['model'] : ''),
								'description' => ((int)$template['product_description_length'] ? mb_substr(trim(preg_replace("/\s\s+/u", ' ', strip_tags(html_entity_decode(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')))), 0, (int)$template['product_description_length'], 'UTF-8') . '..' : ''),
								'href'    	  => $store_url.'index.php?route=product/product&product_id=' . $result['product_id'],
							);
					}
					unset($result); //// since using same variable in another loop
				///using tpl file to show products
				
				$latest = $this->load->view('sale/mailsubscribe/templates/' . $template['uri'] . '/latest.tpl', $data);
					
				$body = $this->replaceTags('<!--//latest//-->', '<!--//end latest//-->', $latest, $body);
				$body = str_replace(':usd', '$', $body);
					
            } else {
                $body = $this->replaceTags('<!--//latest//-->', '<!--//end latest//-->', '', $body);
            }
			/////products for popular 
			$data['products'] = array();
			if(isset($this->request->post['popular']) && $this->request->post['popular']){
					$data['heading'] = $template['popular'];
					$data2 = array_merge(array(
						'limit' => (int)$template['popular_product_count']
					), $data_setting);
					$results = $this->model_sale_mailsubscribe->getBestSellerProducts($data2);
					
					
					foreach($results as $result){
						if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
							$image = $this->model_tool_image->resize($result['image'], $template['image_width'], $template['image_height']);
						} else {
							$image = $this->model_tool_image->resize('no_image.jpg', $template['image_width'], $template['image_height']);
						}
						
						$image = str_replace(' ', '%20', $image);
						
						if ($template['show_price']) {
							$price = $this->currency->format($result['price'], $currency_info['code'], $currency_info['value']);
						} else {
							$price = false;
						}
						if ($template['show_price'] && (float)$result['special']) {
                        	$special = $this->currency->format($result['special'], $currency_info['code'], $currency_info['value']);
						} else {
							$special = false;
						}
						$data['products'][] = array(
								'product_id'  => $result['product_id'],
								'thumb'   	  => $image,
								'name'    	  => $result['name'],
								'price'    	  => str_replace('$', ':usd', $price),
								'special'     => str_replace('$', ':usd', $special),
								'saving'      => 0,
								'model'       => (isset($result['model']) ? $result['model'] : ''),
								'description' => ((int)$template['product_description_length'] ? mb_substr(trim(preg_replace("/\s\s+/u", ' ', strip_tags(html_entity_decode(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')))), 0, (int)$template['product_description_length'], 'UTF-8') . '..' : ''),
								'href'    	  => $store_url.'index.php?route=product/product&product_id=' . $result['product_id'],
							);
					}
					unset($result); //// since using same variable in another loop
				///using tpl file to show products
					
				$popular = $this->load->view('sale/mailsubscribe/templates/' . $template['uri'] . '/popular.tpl', $data);	
				
				$body = $this->replaceTags('<!--//popular//-->', '<!--//end popular//-->', $popular, $body);
				$body = str_replace(':usd', '$', $body);
            } else {
                $body = $this->replaceTags('<!--//popular//-->', '<!--//end popular//-->', '', $body);
            }
			
			/////replace template divs with products template files
			
		
		$response = json_encode(array('subject' => $subject, 'body' => $body));
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput($response);
			
		 } else 
        	$this->response->redirect($this->url->link('sale/mailsubscribe', 'token=' . $this->session->data['token'], 'SSL'));
	}
	private function replaceTags($start, $end, $text, $source) {///predefined function
        $result = preg_replace('#('.preg_quote($start).')(.*)('.preg_quote($end).')#si', '$1'.$text.'$3', $source);

        if (preg_last_error() !== PREG_NO_ERROR) {
            $data2 = explode($start, $source);
            $out = array();
            foreach ($data2 as $entry) {
                $inner = explode($end, $entry);
                if (count($inner) > 1) {
                    $inner[0] = $text;
                    $out[] = implode($end, $inner);
                } else {
                    $out[] = $entry;
                }
            }
            $result = implode($start, $out);
        }

        return $result;
    }
	public function getListDraft(){  //// Drafts list
		$this->load->language('sale/mailsubscribe');
 
		$this->document->setTitle($this->language->get('heading_title_draft'));
		
		$data['heading_title'] = $this->language->get('heading_title_draft');
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			
   		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title_draft'),
			'href'      => $this->url->link('sale/mailsubscribe/getlistdraft', 'token=' . $this->session->data['token'], 'SSL'),
		);
		
		if (isset($this->request->get['filter_date'])) {
			$filter_date = $this->request->get['filter_date'];
		} else {
			$filter_date = null;
		}
		
		if (isset($this->request->get['filter_subject'])) {
			$filter_subject = $this->request->get['filter_subject'];
		} else {
			$filter_subject = null;
		}

		if (isset($this->request->get['filter_to'])) {
			$filter_to = $this->request->get['filter_to'];
		} else {
			$filter_to = null;
		}

		if (isset($this->request->get['filter_store'])) {
			$filter_store = $this->request->get['filter_store'];
		} else {
			$filter_store = null;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'draft_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
		
		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . $this->request->get['filter_date'];
		}
		
		if (isset($this->request->get['filter_subject'])) {
			$url .= '&filter_subject=' . $this->request->get['filter_subject'];
		}

		if (isset($this->request->get['filter_to'])) {
			$url .= '&filter_to=' . $this->request->get['filter_to'];
		}

		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . $this->request->get['filter_store'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data2 = array(
			'filter_date'		=> $filter_date,
			'filter_subject'	=> $filter_subject,
			'filter_to'			=> $filter_to,
			'filter_store'		=> $filter_store,
			'sort'				=> $sort,
			'order'				=> $order,
			'start'				=> ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'				=> $this->config->get('config_limit_admin')
		);
		
		$this->load->model('sale/mailsubscribe');
		
		$draft_total = $this->model_sale_mailsubscribe->getDraftsTotal($data2);
		
		$results = $this->model_sale_mailsubscribe->getDrafts($data2);
		
		if($results) {
			foreach ($results as $result) {
				$data['draft'][] = array_merge($result, array(
					'selected' => isset($this->request->post['selected']) && is_array($this->request->post['selected']) && in_array($result['draft_id'], $this->request->post['selected'])
				));
			}
		} else {
			$data['draft'] = false;
		}
		
		$data['sort_date'] = $this->url->link('sale/mailsubscribe/getlistdraft', 'token=' . $this->session->data['token'] . '&sort=datetime' . $url, 'SSL');
		$data['sort_subject'] = $this->url->link('sale/mailsubscribe/getlistdraft', 'token=' . $this->session->data['token'] . '&sort=subject' . $url, 'SSL');
		$data['sort_to'] = $this->url->link('sale/mailsubscribe/getlistdraft', 'token=' . $this->session->data['token'] . '&sort=to' . $url, 'SSL');
		$data['sort_store'] = $this->url->link('sale/mailsubscribe/getlistdraft', 'token=' . $this->session->data['token'] . '&sort=store_id' . $url, 'SSL');
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		
		$data['column_subject'] = $this->language->get('column_subject');
		$data['column_date'] = $this->language->get('column_date');
		$data['column_to'] = $this->language->get('column_to');
		$data['column_actions'] = $this->language->get('column_actions');
		$data['column_store'] = $this->language->get('column_store');
		
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['text_marketing'] = $this->language->get('text_marketing');
		$data['text_marketing_all'] = $this->language->get('text_marketing_all');
		$data['text_subscriber_all'] = $this->language->get('text_subscriber_all');
		$data['text_all'] = $this->language->get('text_all');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_newsletter_module'] = $this->language->get('text_newsletter_module');
		$data['text_customer_all'] = $this->language->get('text_customer_all');	
		$data['text_customer'] = $this->language->get('text_customer');	
		$data['text_customer_group'] = $this->language->get('text_customer_group');
		$data['text_affiliate_all'] = $this->language->get('text_affiliate_all');	
		$data['text_affiliate'] = $this->language->get('text_affiliate');	
		$data['text_product'] = $this->language->get('text_product');	
		$data['text_view'] = $this->language->get('text_view');
		$data['text_default'] = $this->language->get('text_default');		
		
		$data['token'] = $this->session->data['token'];
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		$data['detail'] = $this->url->link('sale/mailsubscribe/detail', 'token=' . $this->session->data['token'] . $url . '&id=', 'SSL');
		$data['delete'] = $this->url->link('sale/mailsubscribe/deletedraft', 'token=' . $this->session->data['token'] . $url , 'SSL');
		$data['cancel'] = $this->url->link('sale/mailsubscribe', 'token=' . $this->session->data['token'], 'SSL');
		
		
		$pagination = new Pagination();
		$pagination->total = $draft_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('sale/mailsubscribe/getlistdraft', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		
		$data['pagination'] = $pagination->render();
		
		$data['results'] = sprintf($this->language->get('text_pagination'), ($draft_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($draft_total - $this->config->get('config_limit_admin'))) ? $draft_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $draft_total, ceil($draft_total / $this->config->get('config_limit_admin')));
		
		$this->load->model('setting/store');
		
		$data['stores'] = $this->model_setting_store->getStores();
		
		$data['filter_date'] = $filter_date;
		$data['filter_subject'] = $filter_subject;
		$data['filter_to'] = $filter_to;
		$data['filter_store'] = $filter_store;
		
		$data['sort'] = $sort;
		$data['order'] = $order;
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/mailsubscribe_template_draft.tpl', $data));		
	}
	public function detail() {
		if (isset($this->request->get['id'])) {

			$url = '';
		
			if (isset($this->request->get['filter_date'])) {
				$url .= '&filter_date=' . $this->request->get['filter_date'];
			}
			
			if (isset($this->request->get['filter_subject'])) {
				$url .= '&filter_subject=' . $this->request->get['filter_subject'];
			}

			if (isset($this->request->get['filter_to'])) {
				$url .= '&filter_to=' . $this->request->get['filter_to'];
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->response->redirect($this->url->link('sale/mailsubscribe', 'token=' . $this->session->data['token'] . '&id=' . (int)$this->request->get['id'], 'SSL'));
		} else {
			$this->response->redirect($this->url->link('sale/mailsubscribe/getlistdraft', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}

	public function save(){
		$this->load->language('sale/mailsubscribe');
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
			
            $this->load->model('sale/mailsubscribe');
            $this->model_sale_mailsubscribe->savedraft($this->request->post);
            $this->session->data['success'] = $this->language->get('text_success_draft');
		    $this->response->redirect($this->url->link('sale/mailsubscribe/getlistdraft', 'token=' . $this->session->data['token'], 'SSL'));
        }
		
		if(isset($this->request->post['id']) && $this->request->post['id']){
			
			$this->response->redirect($this->url->link('sale/mailsubscribe/', 'token=' . $this->session->data['token'] .'&id='. (int)$this->request->post['id'], 'SSL'));
		}else{ 
			$this->response->redirect($this->url->link('sale/mailsubscribe/', 'token=' . $this->session->data['token'], 'SSL'));
		}
       
	}
	 private function validate() {
        if (!$this->user->hasPermission('modify', 'sale/mailsubscribe')) {
           $this->session->data['error']['warning'] = $this->language->get('error_permission');
        }
		
        if (!$this->request->post['subject']) {
			$this->session->data['error']['subject'] = $this->language->get('error_subject');
        }

        if (!$this->request->post['message']) {
            $this->session->data['error']['message'] = $this->language->get('error_message');
        }
		
        if (!(isset($this->session->data['error']) && $this->session->data['error'])) {
            return true;
        } else {
            return false;
        }
    }
	public function deletedraft(){
		$this->load->language('sale/mailsubscribe');
		$this->load->model('sale/mailsubscribe');
		
		if (isset($this->request->post['selected']) && ($this->validateDelete())) {
			foreach ($this->request->post['selected'] as $draft_id) {
				$this->model_sale_mailsubscribe->deleteDraft($draft_id);
                
			}
			$this->session->data['success'] = $this->language->get('text_success_draft');
			
			$this->response->redirect($this->url->link('sale/mailsubscribe/getlistdraft', 'token=' . $this->session->data['token'], 'SSL'));
    	}

    	$this->getList();
	
	}
	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'sale/mailsubscribe')) {
			$this->error['warning'] = $this->language->get('error_permission');
    	}

		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
	public function upload() {
		
		$json = array();
	
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ($this->request->files && !empty($this->session->data['attachments_count'])) {
				
				for ($i = 0; $i < count($this->request->files); $i++) {
					if (is_uploaded_file($this->request->files['attachment_'.$i]['tmp_name'])) {
						$filename = $this->request->files['attachment_'.$i]['name'];
						$path = dirname(DIR_DOWNLOAD) . DIRECTORY_SEPARATOR . 'attachments' .
							DIRECTORY_SEPARATOR . $this->session->data['attachments_id'];
						if (!file_exists($path)) {
							mkdir($path, 0777, true);
						}
						if (is_dir($path)) {
							move_uploaded_file($this->request->files['attachment_'.$i]['tmp_name'], $path .
								DIRECTORY_SEPARATOR . $filename);
						}
						if (file_exists($path . DIRECTORY_SEPARATOR . $filename)) {
							$attachments[] = array(
								'filename' => $filename,
								'path'     => $path . DIRECTORY_SEPARATOR . $filename
							);
						$json = $attachments;
						
						}
					}
				}
				
			}
		}
		unset($this->session->data['attachments_count']);
		unset($this->session->data['attachments_id']);
		
		$this->response->setOutput(json_encode($json));	
	}
	public function attachmentset(){
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			 $this->session->data['attachments_count'] = $this->request->post['attachments_count'];
			 $this->session->data['attachments_id'] = $this->request->post['attachments_id'];
		}
	}
	public function deletefile(){
		$json = array();
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if($this->request->post['file']){
				unlink($this->request->post['file']);
				$json['success'] = 'File is deleted';
			}else {
				$json['success'] = 'File is not deleted';
			}
		}
		$this->response->setOutput(json_encode($json));	
	}
}
?>