<?php 
class ControllerSaleMailsubscribeTemplate extends Controller {
	private $error = array();
	 
	public function index() {
		$this->load->language('sale/mailsubscribe_template');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('sale/mailsubscribe');
		
		$this->getList();
 
	}
	public function insert() {
		$this->load->language('sale/mailsubscribe_template');
	
		$this->document->setTitle($this->language->get('heading_title'));
	
		$this->load->model('sale/mailsubscribe');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      	  		$this->model_sale_mailsubscribe->addTemplate($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('sale/mailsubscribe_template', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		$this->getForm();
	}
	public function update() {
		$this->load->language('sale/mailsubscribe_template');
	
		$this->document->setTitle($this->language->get('heading_title'));
	
		$this->load->model('sale/mailsubscribe');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
      	  	$this->model_sale_mailsubscribe->editTemplate($this->request->post,$this->request->get['template_id']);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('sale/mailsubscribe_template', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getForm();
	}
	public function delete(){
		$this->load->language('sale/mailsubscribe_template');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/mailsubscribe');
		
		if (isset($this->request->post['selected']) && ($this->validateDelete())) {
			foreach ($this->request->post['selected'] as $template_id) {
				$this->model_sale_mailsubscribe->deleteTemplate($template_id);
                
			}
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('sale/mailsubscribe_template', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

    	$this->getList();
	
	}
	
	public function getList(){
		
		
		$data['heading_title'] = $this->language->get('heading_title');
			
		
		$data['text_default'] = $this->language->get('text_default');
		
		$data['text_no_results'] = $this->language->get('text_no_results');	
		
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_insert'] = $this->language->get('button_insert');
		
		$data['column_template_id'] = $this->language->get('column_template_id');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_date_modified'] = $this->language->get('column_date_modified');
		$data['column_action'] = $this->language->get('column_action');
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
		


  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/mailsubscribe_template', 'token=' . $this->session->data['token'], 'SSL'),
      		
   		);
		$data['insert'] = $this->url->link('sale/mailsubscribe_template/insert', 'token=' . $this->session->data['token'], 'SSL');		
    	$data['delete'] = $this->url->link('sale/mailsubscribe_template/delete', 'token=' . $this->session->data['token'], 'SSL');
		
		
		
		$data['templates'] =array();
		$results = $this->model_sale_mailsubscribe->getTemplates();
		

    	foreach ($results as $result) {
			$action = array();
						
			/*$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('sale/mailsubscribe_template/info', 'token=' . $this->session->data['token'] . '&template_id=' . $result['template_id'], 'SSL')
			);*/
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('sale/mailsubscribe_template/update', 'token=' . $this->session->data['token'] . '&template_id=' . $result['template_id'], 'SSL')
			);
			
			$data['templates'][] = array(
				'template_id'      => $result['template_id'],
				'name'   		   => $result['name'],
				'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'selected'      => isset($this->request->post['selected']) && in_array($result['template_id'], $this->request->post['selected']),
				'action'        => $action
			);
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/mailsubscribe_template_list.tpl', $data));	
	}
	public function getForm() {
		
		if (isset($this->request->get['template_id'])) {
            $template_id = $this->request->get['template_id'];
            $template_info = $this->model_sale_mailsubscribe->getTemplate($template_id);
        } else {
            $template_info = array();
        }
		$data['heading_title'] = $this->language->get('heading_title');
	
		$this->document->addScript('view/javascript/kodecube/jscolor.js');///add input with class="color"
		
		$data['text_styles'] = $this->language->get('text_styles');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_customer_all'] = $this->language->get('text_customer_all');	
		$data['text_customer'] = $this->language->get('text_customer');	
		$data['text_customer_group'] = $this->language->get('text_customer_group');
		$data['text_affiliate_all'] = $this->language->get('text_affiliate_all');	
		$data['text_affiliate'] = $this->language->get('text_affiliate');	
		$data['text_product'] = $this->language->get('text_product');	
		$data['text_message_info'] = $this->language->get('text_message_info');	
		$data['text_edit_template'] = $this->language->get('text_edit_template');	
		
		$data['entry_template_name'] = $this->language->get('entry_template_name');
		$data['entry_template_uri'] = $this->language->get('entry_template_uri');
		$data['entry_show_prices'] = $this->language->get('entry_show_prices');
		$data['entry_product_image_size'] = $this->language->get('entry_product_image_size');
		$data['entry_description_length'] = $this->language->get('entry_description_length');
		$data['entry_product_cols'] = $this->language->get('entry_product_cols');
		$data['entry_heading_color'] = $this->language->get('entry_heading_color');
		$data['entry_heading_style'] = $this->language->get('entry_heading_style');
		$data['entry_subject'] = $this->language->get('entry_subject');
		$data['entry_message'] = $this->language->get('entry_message');
		$data['entry_yes'] = $this->language->get('entry_yes');
		$data['entry_no'] = $this->language->get('entry_no');
		$data['entry_name_color'] = $this->language->get('entry_name_color');
		$data['entry_name_style'] = $this->language->get('entry_name_style');
		$data['entry_special_product_count'] = $this->language->get('entry_special_product_count');
		
		$data['entry_latest_product_count'] = $this->language->get('entry_latest_product_count');
		$data['entry_popular_product_count'] = $this->language->get('entry_popular_product_count');
		$data['entry_template'] = $this->language->get('entry_template');
		$data['entry_section'] = $this->language->get('entry_section');
		$data['entry_model_color'] = $this->language->get('entry_model_color');
		$data['entry_model_style'] = $this->language->get('entry_model_style');
		$data['entry_price_color'] = $this->language->get('entry_price_color');
		$data['entry_price_style'] = $this->language->get('entry_price_style');
		$data['entry_price_color_special'] = $this->language->get('entry_price_color_special');
		$data['entry_price_style_special'] = $this->language->get('entry_price_style_special');
		$data['entry_description_color'] = $this->language->get('entry_description_color');
		$data['entry_description_style'] = $this->language->get('entry_description_style');
		$data['entry_custom_css'] = $this->language->get('entry_custom_css');
		$data['entry_show_custom_css'] = $this->language->get('entry_show_custom_css');
		$data['entry_defined_text'] = $this->language->get('entry_defined_text');
        $data['entry_special_text'] = $this->language->get('entry_special_text');
        $data['entry_latest_text'] = $this->language->get('entry_latest_text');
        $data['entry_popular_text'] = $this->language->get('entry_popular_text');
		$data['entry_manufactures_text'] = $this->language->get('entry_manufactures_text');
        $data['entry_categories_text'] = $this->language->get('entry_categories_text');
        $data['entry_template_body'] = $this->language->get('entry_template_body');
       
		
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_preview'] = $this->language->get('button_preview');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add_defined_section'] = $this->language->get('button_add_defined_section');
		$data['button_add_file'] = $this->language->get('button_add_file');
		
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

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/mailsubscribe', 'token=' . $this->session->data['token'], 'SSL'),
      		
   		);
				
    	$data['cancel'] = $this->url->link('sale/mailsubscribe_template', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('catalog/category');

        $data['categories'] = $this->model_catalog_category->getCategories(0);
		
		
		if (isset($this->request->post['template_name'])) {
            $data['template_name'] = $this->request->post['template_name'];
        } elseif (!empty($template_info)) {
            $data['template_name'] = $template_info['name'];
        } else {
            $data['template_name'] = '';
        }

        if (isset($this->request->post['template_uri'])) {
            $data['template_uri'] = $this->request->post['template_uri'];
        } elseif (!empty($template_info)) {
            $data['template_uri'] = $template_info['uri'];
        } else {
            $data['template_uri'] = 'default';
        }
		
		if (isset($this->request->post['image_height'])) {
            $data['image_height'] = $this->request->post['image_height'];
        } elseif (!empty($template_info)) {
            $data['image_height'] = $template_info['image_height'];
        } else {
            $data['image_height'] = '140';
        }
		if (isset($this->request->post['image_width'])) {
            $data['image_width'] = $this->request->post['image_width'];
        } elseif (!empty($template_info)) {
            $data['image_width'] = $template_info['image_width'];
        } else {
            $data['image_width'] = '140';
        }
		if (isset($this->request->post['show_price'])) {
            $data['show_price'] = $this->request->post['show_price'];
        } elseif (!empty($template_info)) {
            $data['show_price'] = $template_info['show_price'];
        } else {
            $data['show_price'] = '1';
        }
		if (isset($this->request->post['product_description_length'])) {
            $data['product_description_length'] = $this->request->post['product_description_length'];
        } elseif (!empty($template_info)) {
            $data['product_description_length'] = $template_info['product_description_length'];
        } else {
            $data['product_description_length'] = '100';
        }
       
	if (isset($this->request->post['product_cols'])) {
            $data['product_cols'] = $this->request->post['product_cols'];
        } elseif (!empty($template_info)) {
            $data['product_cols'] = $template_info['product_cols'];
        } else {
            $data['product_cols'] = '4';
        }

        if (isset($this->request->post['special_product_count'])) {
            $data['special_product_count'] = $this->request->post['special_product_count'];
        } elseif (!empty($template_info)) {
            $data['special_product_count'] = $template_info['special_product_count'];
        } else {
            $data['special_product_count'] = '4';
        }

        if (isset($this->request->post['latest_product_count'])) {
            $data['latest_product_count'] = $this->request->post['latest_product_count'];
        } elseif (!empty($template_info)) {
            $data['latest_product_count'] = $template_info['latest_product_count'];
        } else {
            $data['latest_product_count'] = '4';
        }

        if (isset($this->request->post['popular_product_count'])) {
            $data['popular_product_count'] = $this->request->post['popular_product_count'];
        } elseif (!empty($template_info)) {
            $data['popular_product_count'] = $template_info['popular_product_count'];
        } else {
            $data['popular_product_count'] = '4';
        }

        if (isset($this->request->post['heading_color'])) {
            $data['heading_color'] = $this->request->post['heading_color'];
        } elseif (!empty($template_info)) {
            $data['heading_color'] = $template_info['heading_color'];
        } else {
            $data['heading_color'] = '#222222';
        }

        if (isset($this->request->post['heading_style'])) {
            $data['heading_style'] = $this->request->post['heading_style'];
        } elseif (!empty($template_info)) {
            $data['heading_style'] = $template_info['heading_style'];
        } else {
            $data['heading_style'] = '';
        }

        if (isset($this->request->post['product_name_color'])) {
            $data['product_name_color'] = $this->request->post['product_name_color'];
        } elseif (!empty($template_info)) {
            $data['product_name_color'] = $template_info['product_name_color'];
        } else {
            $data['product_name_color'] = '#222222';
        }

        if (isset($this->request->post['product_name_style'])) {
            $data['product_name_style'] = $this->request->post['product_name_style'];
        } elseif (!empty($template_info)) {
            $data['product_name_style'] = $template_info['product_name_style'];
        } else {
            $data['product_name_style'] = '';
        }

        if (isset($this->request->post['product_model_color'])) {
            $data['product_model_color'] = $this->request->post['product_model_color'];
        } elseif (!empty($template_info)) {
            $data['product_model_color'] = $template_info['product_model_color'];
        } else {
            $data['product_model_color'] = '#000000';
        }

        if (isset($this->request->post['product_model_style'])) {
            $data['product_model_style'] = $this->request->post['product_model_style'];
        } elseif (!empty($template_info)) {
            $data['product_model_style'] = $template_info['product_model_style'];
        } else {
            $data['product_model_style'] = '';
        }

        if (isset($this->request->post['product_price_color'])) {
            $data['product_price_color'] = $this->request->post['product_price_color'];
        } elseif (!empty($template_info)) {
            $data['product_price_color'] = $template_info['product_price_color'];
        } else {
            $data['product_price_color'] = '#000000';
        }

        if (isset($this->request->post['product_price_style'])) {
            $data['product_price_style'] = $this->request->post['product_price_style'];
        } elseif (!empty($template_info)) {
            $data['product_price_style'] = $template_info['product_price_style'];
        } else {
            $data['product_price_style'] = '';
        }

        if (isset($this->request->post['product_price_color_special'])) {
            $data['product_price_color_special'] = $this->request->post['product_price_color_special'];
        } elseif (!empty($template_info)) {
            $data['product_price_color_special'] = $template_info['product_price_color_special'];
        } else {
            $data['product_price_color_special'] = '#000000';
        }

        if (isset($this->request->post['product_price_style_special'])) {
            $data['product_price_style_special'] = $this->request->post['product_price_style_special'];
        } elseif (!empty($template_info)) {
            $data['product_price_style_special'] = $template_info['product_price_style_special'];
        } else {
            $data['product_price_style_special'] = '';
        }

        if (isset($this->request->post['product_description_color'])) {
            $data['product_description_color'] = $this->request->post['product_description_color'];
        } elseif (!empty($template_info)) {
            $data['product_description_color'] = $template_info['product_description_color'];
        } else {
            $data['product_description_color'] = '#000000';
        }

        if (isset($this->request->post['product_description_style'])) {
            $data['product_description_style'] = $this->request->post['product_description_style'];
        } elseif (!empty($template_info)) {
            $data['product_description_style'] = $template_info['product_description_style'];
        } else {
            $data['product_description_style'] = '';
        }
		  if (isset($this->request->post['show_custom_css'])) {
            $data['show_custom_css'] = $this->request->post['show_custom_css'];
        } elseif (!empty($template_info)) {
            $data['show_custom_css'] = $template_info['show_custom_css'];
        } else {
            $data['show_custom_css'] = 0;
        }
		  if (isset($this->request->post['custom_css'])) {
            $data['custom_css'] = $this->request->post['custom_css'];
        } elseif (!empty($template_info)) {
            $data['custom_css'] = $template_info['custom_css'];
        } else {
            $data['custom_css'] = '';
        }
		if (isset($this->request->post['subject'])) {
            $data['subject'] = $this->request->post['subject'];
        } elseif (!empty($template_info)) {
            $data['subject'] = $template_info['subject'];
        } else {
            $data['subject'] = array();
        }

        if (isset($this->request->post['defined_text'])) {
            $data['defined_text'] = $this->request->post['defined_text'];
        } elseif (!empty($template_info)) {
            $data['defined_text'] = $template_info['defined_text'];
        } else {
            $data['defined_text'] = array();
        }

        if (isset($this->request->post['special_text'])) {
            $data['special_text'] = $this->request->post['special_text'];
        } elseif (!empty($template_info)) {
            $data['special_text'] = $template_info['special_text'];
        } else {
            $data['special_text'] = array();
        }

        if (isset($this->request->post['latest_text'])) {
            $data['latest_text'] = $this->request->post['latest_text'];
        } elseif (!empty($template_info)) {
            $data['latest_text'] = $template_info['latest_text'];
        } else {
            $data['latest_text'] = array();
        }

        if (isset($this->request->post['popular_text'])) {
            $data['popular_text'] = $this->request->post['popular_text'];
        } elseif (!empty($template_info)) {
            $data['popular_text'] = $template_info['popular_text'];
        } else {
            $data['popular_text'] = array();
        }

        if (isset($this->request->post['categories_text'])) {
            $data['categories_text'] = $this->request->post['categories_text'];
        } elseif (!empty($template_info)) {
            $data['categories_text'] = $template_info['categories_text'];
        } else {
            $data['categories_text'] = array();
        }

        if (isset($this->request->post['manufactures_text'])) {
            $data['manufactures_text'] = $this->request->post['manufactures_text'];
        } elseif (!empty($template_info)) {
            $data['manufactures_text'] = $template_info['manufactures_text'];
        } else {
            $data['manufactures_text'] = array();
        }

        if (isset($this->request->post['uri'])) {
            $data['uri'] = $this->request->post['uri'];
        } elseif (!empty($template_info)) {
            $data['uri'] = $template_info['uri'];
        } else {
            $data['uri'] = '';
        }

        if (isset($this->request->post['body'])) {
            $data['body'] = $this->request->post['body'];
        } elseif (!empty($template_info)) {
			$template_info['body'] = str_replace('{custom_css}','',$template_info['body']);
            $data['body'] = $template_info['body'];
        } else {
            $data['body'] = array();
        }

        if (isset($this->request->post['text_message'])) {
            $data['text_message'] = $this->request->post['text_message'];
        } elseif (!empty($template_info)) {
            $data['text_message'] = $template_info['text_message'];
        } else {
            $data['text_message'] = array();
        }

       if (!isset($template_id)) {
            $data['action'] = $this->url->link('sale/mailsubscribe_template/insert', 'token=' . $this->session->data['token'], 'SSL');
        } else {
            $data['action'] = $this->url->link('sale/mailsubscribe_template/update', 'token=' . $this->session->data['token'] . '&template_id=' . $template_id, 'SSL');
        }
		
		  /////setting folders for templates products
        $parts = (array)glob(DIR_TEMPLATE . 'sale/mailsubscribe/templates/*');

        $data['parts'] = array();

        if ($parts) {
            foreach ($parts as $part) {
                $data['parts'][basename($part)] = ucwords(basename($part));
            }
        }
		 	
		$this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/mailsubscribe_template_form.tpl', $data));	
	}
	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'sale/mailsubscribe_template')) {
			$this->error['warning'] = $this->language->get('error_permission');
    	}

		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
	protected function validateForm() {
    	if (!$this->user->hasPermission('modify', 'sale/mailsubscribe_template')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
	}
}
?>