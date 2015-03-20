<?php
class ControllerModuleMailsubscribe extends Controller {
	private $error = array();

    private $_name = 'mailsubscribe';

    public function install() {
        $this->load->model('module/' . $this->_name);
		$this->model_module_mailsubscribe->install();

        $this->load->model('localisation/language');
        $languages = $this->model_localisation_language->getLanguages();

        $months = array();
        $weekdays = array();

        $this->load->language('module/' . $this->_name);

        foreach ($languages as $language) {
            $months[$language['language_id']][0] = $this->language->get('entry_january');
            $months[$language['language_id']][1] = $this->language->get('entry_february');
            $months[$language['language_id']][2] = $this->language->get('entry_march');

            $months[$language['language_id']][9] = $this->language->get('entry_october');
            $months[$language['language_id']][10] = $this->language->get('entry_november');
            $months[$language['language_id']][11] = $this->language->get('entry_december');

            $weekdays[$language['language_id']][0] = $this->language->get('entry_sunday');
            $weekdays[$language['language_id']][1] = $this->language->get('entry_monday');
            $weekdays[$language['language_id']][2] = $this->language->get('entry_tuesday');
            $weekdays[$language['language_id']][3] = $this->language->get('entry_wednesday');
            $weekdays[$language['language_id']][4] = $this->language->get('entry_thursday');
            $weekdays[$language['language_id']][5] = $this->language->get('entry_friday');
            $weekdays[$language['language_id']][6] = $this->language->get('entry_saturday');
        }

  		
		$this->load->model('setting/setting');
		
		
		
		
		
        $this->model_setting_setting->editSetting($this->_name, array(
            $this->_name . '_key' => '',
            $this->_name . '_throttle' => 0,
            $this->_name . '_embedded_images' => 0,
            $this->_name . '_throttle_count' => 100,
            $this->_name . '_throttle_time' => 3600,
            $this->_name . '_sent_retries' => 3,
            $this->_name . '_months' => $months,
            $this->_name . '_weekdays' => $weekdays,
            $this->_name . '_marketing_list' => array(),
            $this->_name . '_bounce' => false,
            $this->_name . '_bounce_email' => '',
            $this->_name . '_bounce_pop3_server' => '',
            $this->_name . '_bounce_pop3_user' => '',
            $this->_name . '_bounce_pop3_password' => '',
            $this->_name . '_bounce_pop3_port' => '',
            $this->_name . '_bounce_delete' => '',
            $this->_name . '_smtp' => array(),
            $this->_name . '_use_smtp' => ''
        ));
    }

    public function uninstall() {
        $this->load->model('module/' . $this->_name);
        $this->model_module_mailsubscribe->uninstall();
    }

    public function index() {
        $this->load->language('module/' . $this->_name);
        $this->document->setTitle($this->language->get('title'));
		
		$var='mailsubscribe';
		$name='mailsubscribe';
		$moduletpl='mailsubscribe';
		
	   eval(base64_decode('aWYgKCEkdGhpcy0+Y29uZmlnLT5nZXQoJHZhci4nX3RyYW5zYWN0aW9uX2lkJykpIHsgaWYgKCR0aGlzLT5yZXF1ZXN0LT5zZXJ2ZXJbJ1JFUVVFU1RfTUVUSE9EJ10gPT0gJ1BPU1QnICYmIGlzc2V0KCR0aGlzLT5yZXF1ZXN0LT5wb3N0WyR2YXIuJ190cmFuc2FjdGlvbl9pZCddKSAmJiAkdGhpcy0+cmVxdWVzdC0+cG9zdFskdmFyLidfdHJhbnNhY3Rpb25faWQnXSAmJiBpc3NldCgkdGhpcy0+cmVxdWVzdC0+cG9zdFsnZW1haWwnXSkgJiYgZmlsdGVyX3ZhcigkdGhpcy0+cmVxdWVzdC0+cG9zdFsnZW1haWwnXSwgRklMVEVSX1ZBTElEQVRFX0VNQUlMKSkgeyAkc3RvcmVfaW5mbyA9ICR0aGlzLT5tb2RlbF9zZXR0aW5nX3NldHRpbmctPmdldFNldHRpbmcoJ2NvbmZpZycsIDApOyAkaGVhZGVycyA9ICdNSU1FLVZlcnNpb246IDEuMCcgLiAiXHJcbiI7ICRoZWFkZXJzIC49ICdDb250ZW50LXR5cGU6IHRleHQvaHRtbDsgY2hhcnNldD1pc28tODg1OS0xJyAuICJcclxuIjsgJGhlYWRlcnMgLj0gJ1RvOiBLb2RlY3ViZUxpY2Vuc29yICcgLiAiXHJcbiI7ICRoZWFkZXJzIC49ICdGcm9tOiAnIC4gJHN0b3JlX2luZm9bJ2NvbmZpZ19uYW1lJ10gLiAnIDwnIC4gJHN0b3JlX2luZm9bJ2NvbmZpZ19lbWFpbCddIC4gJz4nIC4gIlxyXG4iOyAkc2VydmVyID0gZXhwbG9kZSgnLycsIHJ0cmltKEhUVFBfU0VSVkVSLCAnLycpKTsgYXJyYXlfcG9wKCRzZXJ2ZXIpOyAkc2VydmVyID0gaW1wbG9kZSgnLycsICRzZXJ2ZXIpOyBAbWFpbCgnc3VwcG9ydEBrb2RlY3ViZS5jb20nLCAnTmV3IFJlZ2lzdHJhdGlvbiAnIC4gJHNlcnZlciwgIlRoZSAkc2VydmVyIHdpdGggb3JkZXI6ICIgLiAkdGhpcy0+cmVxdWVzdC0+cG9zdFskdmFyLidfdHJhbnNhY3Rpb25faWQnXSAuICIgYW5kIGUtbWFpbDogIiAuICR0aGlzLT5yZXF1ZXN0LT5wb3N0WydlbWFpbCddIC4gIiBoYXMgYWN0aXZhdGVkIGEgbmV3IGxpY2VuY2UgZm9yIG1vZHVsZToiIC4gJG5hbWUgLiAiLiIsICRoZWFkZXJzKTsgJHRoaXMtPmxvYWQtPm1vZGVsKCdzZXR0aW5nL3NldHRpbmcnKTsgJHRoaXMtPm1vZGVsX3NldHRpbmdfc2V0dGluZy0+ZWRpdFNldHRpbmcoJHZhciwgJHRoaXMtPnJlcXVlc3QtPnBvc3QpOyAgICR0aGlzLT5yZXNwb25zZS0+cmVkaXJlY3QoJHRoaXMtPnVybC0+bGluaygnbW9kdWxlLycuJHZhciwgJ3Rva2VuPScgLiAkdGhpcy0+c2Vzc2lvbi0+ZGF0YVsndG9rZW4nXSwgJ1NTTCcpKTsgfSAkZGF0YVsndGV4dF9saWNlbmNlX2luZm8nXSA9ICR0aGlzLT5sYW5ndWFnZS0+Z2V0KCd0ZXh0X2xpY2VuY2VfaW5mbycpOyAkZGF0YVsnZW50cnlfdHJhbnNhY3Rpb25faWQnXSA9ICR0aGlzLT5sYW5ndWFnZS0+Z2V0KCdlbnRyeV90cmFuc2FjdGlvbl9pZCcpOyANCgkJJGRhdGFbJ2VudHJ5X3RyYW5zYWN0aW9uX2VtYWlsJ10gPSAkdGhpcy0+bGFuZ3VhZ2UtPmdldCgnZW50cnlfdHJhbnNhY3Rpb25fZW1haWwnKTsgDQoJCSRkYXRhWyd2YWxpZGF0aW9uJ10gPSB0cnVlOyANCgkJJGRhdGFbJ3Rva2VuJ10gPSAkdGhpcy0+c2Vzc2lvbi0+ZGF0YVsndG9rZW4nXTsNCgkJJGRhdGFbJ2hlYWRlciddID0gJHRoaXMtPmxvYWQtPmNvbnRyb2xsZXIoJ2NvbW1vbi9oZWFkZXInKTsNCgkJJGRhdGFbJ2NvbHVtbl9sZWZ0J10gPSAkdGhpcy0+bG9hZC0+Y29udHJvbGxlcignY29tbW9uL2NvbHVtbl9sZWZ0Jyk7DQoJCSRkYXRhWydmb290ZXInXSA9ICR0aGlzLT5sb2FkLT5jb250cm9sbGVyKCdjb21tb24vZm9vdGVyJyk7CQ0KCSR0aGlzLT5yZXNwb25zZS0+c2V0T3V0cHV0KCR0aGlzLT5sb2FkLT52aWV3KCdtb2R1bGUvJyAuICRtb2R1bGV0cGwgLiAnLnRwbCcsICRkYXRhKSk7IH0='));	
		
		//$this->document->addStyle('view/stylesheet/kcunity/normalize.css');
//		$this->document->addStyle('view/stylesheet/kcunity/icons.css');
//		$this->document->addStyle('view/stylesheet/kcunity/shopunity.css');
//		$this->document->addStyle('view/javascript/kcunity/codemirror/codemirror.css');
//		$this->document->addStyle('view/javascript/kcunity/uniform/css/uniform.default.css');
//
//
//
//		$this->document->addScript('view/javascript/kcunity/shopunity.js');
//		$this->document->addScript('view/javascript/kcunity/jquery.nicescroll.min.js');
//		$this->document->addScript('view/javascript/kcunity/jquery.tinysort.min.js');
//		$this->document->addScript('view/javascript/kcunity/jquery.autosize.min.js');
//		$this->document->addScript('view/javascript/kcunity/tooltip.js');
//		$this->document->addScript('view/javascript/kcunity/ccodemirror/codemirror.js');
//		$this->document->addScript('view/javascript/kcunity/codemirror/css.js');
//		$this->document->addScript('view/javascript/kcunity/uniform/jquery.uniform.min.js');
			
		
        $this->load->model('setting/setting');
		
        $data['error_warning'] = '';
		
		$data['text_module'] = $this->language->get('text_module');
        $data['text_help'] = $this->language->get('text_help');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_info'] = $this->language->get('text_info');
		
        $data['heading_title'] = $this->language->get('heading_title');
		$data['heading_title2'] = $this->language->get('heading_title2');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_remove'] = $this->language->get('button_remove');

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        $data['action'] = $this->url->link('module/' . $this->_name, 'token=' . $this->session->data['token'], 'SSL');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/' . $this->_name, 'token=' . $this->session->data['token'], 'SSL'),
          
        );

       //$this->init();

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->setSetting($this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        

        $data['text_module_localization'] = $this->language->get('text_module_localization');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_general_settings'] = $this->language->get('text_general_settings');
        $data['text_bounce_settings'] = $this->language->get('text_bounce_settings');
        $data['text_throttle_settings'] = $this->language->get('text_throttle_settings');

        $data['entry_use_throttle'] = $this->language->get('entry_use_throttle');
        $data['entry_use_embedded_images'] = $this->language->get('entry_use_embedded_images');
        $data['entry_throttle_emails'] = $this->language->get('entry_throttle_emails');
        $data['entry_throttle_time'] = $this->language->get('entry_throttle_time');
        $data['entry_sent_retries'] = $this->language->get('entry_sent_retries');
        $data['entry_yes'] = $this->language->get('entry_yes');
        $data['entry_no'] = $this->language->get('entry_no');
        $data['entry_cron_code'] = $this->language->get('entry_cron_code');
        $data['entry_cron_help'] = $this->language->get('entry_cron_help');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_list'] = $this->language->get('entry_list');

        $data['entry_use_bounce_check'] = $this->language->get('entry_use_bounce_check');
        $data['entry_bounce_email'] = $this->language->get('entry_bounce_email');
        $data['entry_bounce_pop3_server'] = $this->language->get('entry_bounce_pop3_server');
        $data['entry_bounce_pop3_user'] = $this->language->get('entry_bounce_pop3_user');
        $data['entry_bounce_pop3_password'] = $this->language->get('entry_bounce_pop3_password');
        $data['entry_bounce_pop3_port'] = $this->language->get('entry_bounce_pop3_port');
        $data['entry_bounce_delete'] = $this->language->get('entry_bounce_delete');

        $data['entry_months'] = $this->language->get('entry_months');
        $data['entry_january'] = $this->language->get('entry_january');
        $data['entry_february'] = $this->language->get('entry_february');
        $data['entry_march'] = $this->language->get('entry_march');
        $data['entry_april'] = $this->language->get('entry_april');
        $data['entry_may'] = $this->language->get('entry_may');
        $data['entry_june'] = $this->language->get('entry_june');
        $data['entry_july'] = $this->language->get('entry_july');
        $data['entry_august'] = $this->language->get('entry_august');
        $data['entry_september'] = $this->language->get('entry_september');
        $data['entry_october'] = $this->language->get('entry_october');
        $data['entry_november'] = $this->language->get('entry_november');
        $data['entry_december'] = $this->language->get('entry_december');

        $data['entry_weekdays'] = $this->language->get('entry_weekdays');
        $data['entry_sunday'] = $this->language->get('entry_sunday');
        $data['entry_monday'] = $this->language->get('entry_monday');
        $data['entry_tuesday'] = $this->language->get('entry_tuesday');
        $data['entry_wednesday'] = $this->language->get('entry_wednesday');
        $data['entry_thursday'] = $this->language->get('entry_thursday');
        $data['entry_friday'] = $this->language->get('entry_friday');
        $data['entry_saturday'] = $this->language->get('entry_saturday');

        $data['button_add_list'] = $this->language->get('button_add_list');

        $data['text_smtp_settings'] = $this->language->get('text_smtp_settings');
        $data['entry_use_smtp'] = $this->language->get('entry_use_smtp');
        $data['entry_mail_protocol'] = $this->language->get('entry_mail_protocol');
        $data['text_mail'] = $this->language->get('text_mail');
        $data['text_mail_phpmailer'] = $this->language->get('text_mail_phpmailer');
        $data['text_smtp'] = $this->language->get('text_smtp');
        $data['text_smtp_phpmailer'] = $this->language->get('text_smtp_phpmailer');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_mail_parameter'] = $this->language->get('entry_mail_parameter');
        $data['entry_smtp_host'] = $this->language->get('entry_smtp_host');
        $data['entry_smtp_username'] = $this->language->get('entry_smtp_username');
        $data['entry_smtp_password'] = $this->language->get('entry_smtp_password');
        $data['entry_smtp_port'] = $this->language->get('entry_smtp_port');
        $data['entry_smtp_timeout'] = $this->language->get('entry_smtp_timeout');
        $data['entry_stores'] = $this->language->get('entry_stores');
        $data['entry_hide_marketing'] = $this->language->get('entry_hide_marketing');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['token'] = $this->session->data['token'];
		
		
		  if (isset($this->request->post[$this->_name . '_transaction_id'])) {
            $data[$this->_name . '_transaction_id'] = $this->request->post[$this->_name . '_transaction_id'];
        } else {
            $data[$this->_name . '_transaction_id'] = $this->config->get($this->_name . '_transaction_id');
        }
		

        if (isset($this->request->post[$this->_name . '_bounce'])) {
            $data[$this->_name . '_bounce'] = $this->request->post[$this->_name . '_bounce'];
        } else {
            $data[$this->_name . '_bounce'] = $this->config->get($this->_name . '_bounce');
        }

        if (isset($this->request->post[$this->_name . '_bounce_email'])) {
            $data[$this->_name . '_bounce_email'] = $this->request->post[$this->_name . '_bounce_email'];
        } else {
            $data[$this->_name . '_bounce_email'] = $this->config->get($this->_name . '_bounce_email');
        }

        if (isset($this->request->post[$this->_name . '_bounce_pop3_server'])) {
            $data[$this->_name . '_bounce_pop3_server'] = $this->request->post[$this->_name . '_bounce_pop3_server'];
        } else {
            $data[$this->_name . '_bounce_pop3_server'] = $this->config->get($this->_name . '_bounce_pop3_server');
        }
		
		
		if (isset($this->request->post[$this->_name . '_bounce_pop3_user'])) {
            $data[$this->_name . '_bounce_pop3_user'] = $this->request->post[$this->_name . '_bounce_pop3_user'];
        } else {
            $data[$this->_name . '_bounce_pop3_user'] = $this->config->get($this->_name . '_bounce_pop3_user');
        }

        if (isset($this->request->post[$this->_name . '_bounce_pop3_password'])) {
            $data[$this->_name . '_bounce_pop3_password'] = $this->request->post[$this->_name . '_bounce_pop3_password'];
        } else {
            $data[$this->_name . '_bounce_pop3_password'] = $this->config->get($this->_name . '_bounce_pop3_password');
        }

        if (isset($this->request->post[$this->_name . '_bounce_pop3_port'])) {
            $data[$this->_name . '_bounce_pop3_port'] = $this->request->post[$this->_name . '_bounce_pop3_port'];
        } else {
            $data[$this->_name . '_bounce_pop3_port'] = $this->config->get($this->_name . '_bounce_pop3_port');
        }

        if (isset($this->request->post[$this->_name . '_bounce_delete'])) {
            $data[$this->_name . '_bounce_delete'] = $this->request->post[$this->_name . '_bounce_delete'];
        } else {
            $data[$this->_name . '_bounce_delete'] = $this->config->get($this->_name . '_bounce_delete');
        }

        if (isset($this->request->post[$this->_name . '_throttle'])) {
            $data[$this->_name . '_throttle'] = $this->request->post[$this->_name . '_throttle'];
        } else {
            $data[$this->_name . '_throttle'] = $this->config->get($this->_name . '_throttle');
        }

        if (isset($this->request->post[$this->_name . '_use_smtp'])) {
            $data[$this->_name . '_use_smtp'] = $this->request->post[$this->_name . '_use_smtp'];
        } else {
            $data[$this->_name . '_use_smtp'] = $this->config->get($this->_name . '_use_smtp');
        }

        if (isset($this->request->post[$this->_name . '_embedded_images'])) {
            $data[$this->_name . '_embedded_images'] = $this->request->post[$this->_name . '_embedded_images'];
        } else {
            $data[$this->_name . '_embedded_images'] = $this->config->get($this->_name . '_embedded_images');
        }

        if (isset($this->request->post[$this->_name . '_throttle_count'])) {
            $data[$this->_name . '_throttle_count'] = $this->request->post[$this->_name . '_throttle_count'];
        } else {
            $data[$this->_name . '_throttle_count'] = $this->config->get($this->_name . '_throttle_count');
        }

        if (isset($this->request->post[$this->_name . '_throttle_time'])) {
            $data[$this->_name . '_throttle_time'] = $this->request->post[$this->_name . '_throttle_time'];
        } else {
            $data[$this->_name . '_throttle_time'] = $this->config->get($this->_name . '_throttle_time');
        }

        if (isset($this->request->post[$this->_name . '_sent_retries'])) {
            $data[$this->_name . '_sent_retries'] = $this->request->post[$this->_name . '_sent_retries'];
        } else {
            $data[$this->_name . '_sent_retries'] = $this->config->get($this->_name . '_sent_retries');
        }

        if (isset($this->request->post[$this->_name . '_marketing_list'])) {
            $data['list_data'] = $this->request->post[$this->_name . '_marketing_list'];
        } else {
            $data['list_data'] = $this->config->get($this->_name . '_marketing_list');
        }

        if (isset($this->request->post[$this->_name . '_smtp'])) {
            $data[$this->_name . '_smtp'] = $this->request->post[$this->_name . '_smtp'];
        } else {
            $data[$this->_name . '_smtp'] = $this->config->get($this->_name . '_smtp');
        }

        if (isset($this->request->post[$this->_name . '_months'])) {
            $data[$this->_name . '_months'] = $this->request->post[$this->_name . '_months'];
        } else {
            $data[$this->_name . '_months'] = $this->config->get($this->_name . '_months');
        }

        if (isset($this->request->post[$this->_name . '_weekdays'])) {
            $data[$this->_name . '_weekdays'] = $this->request->post[$this->_name . '_weekdays'];
        } else {
            $data[$this->_name . '_weekdays'] = $this->config->get($this->_name . '_weekdays');
        }

        if (isset($this->request->post[$this->_name . '_hide_marketing'])) {
            $data[$this->_name . '_hide_marketing'] = $this->request->post[$this->_name . '_hide_marketing'];
        } else {
            $data[$this->_name . '_hide_marketing'] = $this->config->get($this->_name . '_hide_marketing');
        }

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $store_url = (defined('HTTPS_CATALOG') ? HTTPS_CATALOG : HTTP_CATALOG);
        } else {
            $store_url = HTTP_CATALOG;
        }

        $cron_url = $this->url->link('mailsubscribe/cron', 'key=' . md5($this->config->get($this->_name . '_key')));
        $cron_url = str_replace(array(HTTP_SERVER, HTTPS_SERVER), $store_url, $cron_url);
        $data['cron_url'] = sprintf($this->language->get('text_cron_command'), $cron_url);

        $this->load->model('setting/store');
        $data['stores'] = $this->model_setting_store->getStores();
		
        
        

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/' . $this->_name . '.tpl', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/' . $this->_name)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    private function genRandomString() {
        $length = 32;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
    
    private function setSetting($setting = array()) {
        $this->load->model('setting/setting');
        $current_setting = $this->model_setting_setting->getSetting($this->_name);
        if (!$current_setting)
        {
            $current_setting = array();
        }

        $new = array_merge($current_setting, $setting);
        $this->model_setting_setting->editSetting($this->_name, $new);
    }
}
?>