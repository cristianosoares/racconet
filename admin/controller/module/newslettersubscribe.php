<?php
	class ControllerModuleNewslettersubscribe extends Controller {
		private $error = array(); 
	
		public function index() {  
			
			$this->load->language('module/newslettersubscribe');
			
			$this->document->setTitle($this->language->get('title'));
			
			$this->load->model('extension/module');
			$data['heading_title'] = $this->language->get('heading_title');
			
							
		$var='newslettersubscribe';
		$name='newslettersubscribe';
		$moduletpl='newslettersubscribe';
		
		
		
		
	 eval(base64_decode('aWYgKCEkdGhpcy0+Y29uZmlnLT5nZXQoJHZhci4nX3RyYW5zYWN0aW9uX2lkJykpIHsgaWYgKCR0aGlzLT5yZXF1ZXN0LT5zZXJ2ZXJbJ1JFUVVFU1RfTUVUSE9EJ10gPT0gJ1BPU1QnICYmIGlzc2V0KCR0aGlzLT5yZXF1ZXN0LT5wb3N0WyR2YXIuJ190cmFuc2FjdGlvbl9pZCddKSAmJiAkdGhpcy0+cmVxdWVzdC0+cG9zdFskdmFyLidfdHJhbnNhY3Rpb25faWQnXSAmJiBpc3NldCgkdGhpcy0+cmVxdWVzdC0+cG9zdFsnZW1haWwnXSkgJiYgZmlsdGVyX3ZhcigkdGhpcy0+cmVxdWVzdC0+cG9zdFsnZW1haWwnXSwgRklMVEVSX1ZBTElEQVRFX0VNQUlMKSkgew0KICR0aGlzLT5sb2FkLT5tb2RlbCgnc2V0dGluZy9zZXR0aW5nJyk7ICR0aGlzLT5tb2RlbF9zZXR0aW5nX3NldHRpbmctPmVkaXRTZXR0aW5nKCR2YXIsICR0aGlzLT5yZXF1ZXN0LT5wb3N0KTsgIA0KICRzdG9yZV9pbmZvID0gJHRoaXMtPm1vZGVsX3NldHRpbmdfc2V0dGluZy0+Z2V0U2V0dGluZygnY29uZmlnJywgMCk7ICRoZWFkZXJzID0gJ01JTUUtVmVyc2lvbjogMS4wJyAuICJcclxuIjsgJGhlYWRlcnMgLj0gJ0NvbnRlbnQtdHlwZTogdGV4dC9odG1sOyBjaGFyc2V0PWlzby04ODU5LTEnIC4gIlxyXG4iOyAkaGVhZGVycyAuPSAnVG86IEtvZGVjdWJlTGljZW5zb3IgJyAuICJcclxuIjsgJGhlYWRlcnMgLj0gJ0Zyb206ICcgLiAkc3RvcmVfaW5mb1snY29uZmlnX25hbWUnXSAuICcgPCcgLiAkc3RvcmVfaW5mb1snY29uZmlnX2VtYWlsJ10gLiAnPicgLiAiXHJcbiI7ICRzZXJ2ZXIgPSBleHBsb2RlKCcvJywgcnRyaW0oSFRUUF9TRVJWRVIsICcvJykpOyBhcnJheV9wb3AoJHNlcnZlcik7ICRzZXJ2ZXIgPSBpbXBsb2RlKCcvJywgJHNlcnZlcik7IEBtYWlsKCdzdXBwb3J0QGtvZGVjdWJlLmNvbScsICdOZXcgUmVnaXN0cmF0aW9uICcgLiAkc2VydmVyLCAiVGhlICRzZXJ2ZXIgd2l0aCBvcmRlcjogIiAuICR0aGlzLT5yZXF1ZXN0LT5wb3N0WyR2YXIuJ190cmFuc2FjdGlvbl9pZCddIC4gIiBhbmQgZS1tYWlsOiAiIC4gJHRoaXMtPnJlcXVlc3QtPnBvc3RbJ2VtYWlsJ10gLiAiIGhhcyBhY3RpdmF0ZWQgYSBuZXcgbGljZW5jZSBmb3IgbW9kdWxlOiIgLiAkbmFtZSAuICIuIiwgJGhlYWRlcnMpOyAkdGhpcy0+cmVzcG9uc2UtPnJlZGlyZWN0KCR0aGlzLT51cmwtPmxpbmsoJ21vZHVsZS8nLiR2YXIsICd0b2tlbj0nIC4gJHRoaXMtPnNlc3Npb24tPmRhdGFbJ3Rva2VuJ10sICdTU0wnKSk7IH0gJGRhdGFbJ3RleHRfbGljZW5jZV9pbmZvJ10gPSAkdGhpcy0+bGFuZ3VhZ2UtPmdldCgndGV4dF9saWNlbmNlX2luZm8nKTsgJGRhdGFbJ2VudHJ5X3RyYW5zYWN0aW9uX2lkJ10gPSAkdGhpcy0+bGFuZ3VhZ2UtPmdldCgnZW50cnlfdHJhbnNhY3Rpb25faWQnKTsgDQoJCSRkYXRhWydlbnRyeV90cmFuc2FjdGlvbl9lbWFpbCddID0gJHRoaXMtPmxhbmd1YWdlLT5nZXQoJ2VudHJ5X3RyYW5zYWN0aW9uX2VtYWlsJyk7IA0KCQkkZGF0YVsndmFsaWRhdGlvbiddID0gdHJ1ZTsgDQoJCSRkYXRhWyd0b2tlbiddID0gJHRoaXMtPnNlc3Npb24tPmRhdGFbJ3Rva2VuJ107DQoJCSRkYXRhWydoZWFkZXInXSA9ICR0aGlzLT5sb2FkLT5jb250cm9sbGVyKCdjb21tb24vaGVhZGVyJyk7DQoJCSRkYXRhWydjb2x1bW5fbGVmdCddID0gJHRoaXMtPmxvYWQtPmNvbnRyb2xsZXIoJ2NvbW1vbi9jb2x1bW5fbGVmdCcpOw0KCQkkZGF0YVsnZm9vdGVyJ10gPSAkdGhpcy0+bG9hZC0+Y29udHJvbGxlcignY29tbW9uL2Zvb3RlcicpOwkNCgkkdGhpcy0+cmVzcG9uc2UtPnNldE91dHB1dCgkdGhpcy0+bG9hZC0+dmlldygnbW9kdWxlLycgLiAkbW9kdWxldHBsIC4gJy50cGwnLCAkZGF0YSkpOyB9'));
			
			
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
		
	
				
				if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('newslettersubscribe', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}	
			
			
				$this->session->data['success'] = $this->language->get('text_success');
			
				$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}
			
			$data['common_settings'] = $this->language->get('common_settings');
			$data['column_status'] = $this->language->get('column_status');
			$data['column_type'] = $this->language->get('column_type');
			$data['column_name'] = $this->language->get('column_name');
			
			
			$data['text_yes'] = $this->language->get('text_yes');			
			$data['text_info'] = $this->language->get('text_info');
			$data['text_always'] = $this->language->get('text_always');
			$data['text_browse'] = $this->language->get('text_browse');
			$data['text_clear'] = $this->language->get('text_clear');
			$data['text_image_manager'] = $this->language->get('text_image_manager');
			$data['tab_support'] = $this->language->get('tab_support');
			$data['text_info'] = $this->language->get('text_info');
			$data['text_onetime'] = $this->language->get('text_onetime');
			$data['text_no'] = $this->language->get('text_no');
			$data['text_closebutton'] = $this->language->get('text_closebutton');
			$data['text_edit'] = $this->language->get('text_edit');
			$data['text_enabled'] = $this->language->get('text_enabled');
			$data['text_disabled'] = $this->language->get('text_disabled');
			$data['text_content_top'] = $this->language->get('text_content_top');
			$data['text_content_bottom'] = $this->language->get('text_content_bottom');		
			$data['text_column_left'] = $this->language->get('text_column_left');
			$data['text_column_right'] = $this->language->get('text_column_right');
			
			$data['entry_double_optin'] = $this->language->get('entry_double_optin');
			$data['entry_mid'] = $this->language->get('entry_mid');
			$data['entry_mapi'] = $this->language->get('entry_mapi');
			$data['entry_msync'] = $this->language->get('entry_msync');
			$data['entry_mwelcome'] = $this->language->get('entry_mwelcome');
			$data['entry_admin'] = $this->language->get('entry_admin');
		
			$data['entry_status'] = $this->language->get('entry_status');
	
			$data['entry_unsubscribe'] = $this->language->get('entry_unsubscribe');
			$data['entry_force'] = $this->language->get('entry_force');
			$data['entry_popupheaderimage'] = $this->language->get('entry_popupheaderimage');
	
			$data['entry_subfolder'] = $this->language->get('entry_subfolder');
			$data['entry_popupline1'] = $this->language->get('entry_popupline1');
			$data['entry_popupline2'] = $this->language->get('entry_popupline2');
			$data['entry_popupdisplay'] = $this->language->get('entry_popupdisplay');
			$data['entry_popupdelay'] = $this->language->get('entry_popupdelay');
			$data['entry_localemail'] = $this->language->get('entry_localemail');
			$data['entry_subject_custumer'] = $this->language->get('entry_subject_custumer');
			$data['entry_subject_admin'] = $this->language->get('entry_subject_admin');
			$data['entry_mail_custumer'] = $this->language->get('entry_mail_custumer');
			$data['entry_mail_admin'] = $this->language->get('entry_mail_admin');
			$data['entry_unsubject_custumer'] = $this->language->get('entry_unsubject_custumer');
			$data['entry_unsubject_admin'] = $this->language->get('entry_unsubject_admin');
			$data['entry_unmail_custumer'] = $this->language->get('entry_unmail_custumer');
			$data['entry_unmail_admin'] = $this->language->get('entry_unmail_admin');
			
			
			
			$data['tab_general'] = $this->language->get('tab_general');
			$data['tab_general_option'] = $this->language->get('tab_general_option');
			$data['tab_error'] = $this->language->get('tab_error');
			$data['tab_mailchimp'] = $this->language->get('tab_mailchimp');
			$data['tab_mail'] = $this->language->get('tab_mail');
			
			$data['unsubscribe'] = $this->language->get('unsubscribe');
			$data['subscribe'] = $this->language->get('subscribe');
			
		
			$data['fheading_title'] = $this->language->get('fheading_title');
			$data['fentry_email'] = $this->language->get('fentry_email');
			$data['fentry_name'] = $this->language->get('fentry_name');
			$data['entry_name'] = $this->language->get('entry_name');
			$data['fentry_button'] = $this->language->get('fentry_button');
			$data['fentry_unbutton'] = $this->language->get('fentry_unbutton');
			$data['ftext_subscribe'] = $this->language->get('ftext_subscribe');
			$data['ferror_invalid'] = $this->language->get('ferror_invalid');
			$data['ferror_optioninvalid'] = $this->language->get('ferror_optioninvalid');
			$data['ferror_nameinvalid'] = $this->language->get('ferror_nameinvalid');
			$data['fsubscribe'] = $this->language->get('fsubscribe');
			$data['funsubscribe'] = $this->language->get('funsubscribe');
			$data['falreadyexist'] = $this->language->get('falreadyexist');
			$data['fnotexist'] = $this->language->get('fnotexist');
			
			$data['button_module_add'] = $this->language->get('button_module_add');
			
			$this->load->model('localisation/language');
			
			$languages = $this->model_localisation_language->getLanguages();
			$data['languages'] = $languages;
			
			$data['newslettersubscribe_subject'] = array();
			$data['newslettersubscribe_mail'] = array();
			foreach($data['languages'] as $language){
				if(isset($this->request->post['newslettersubscribe_unsubject_'.$language['language_id'].'_custumer'])){
					$data['newslettersubscribe_unsubject'][$language['language_id']]['custumer'] = $this->request->post[		'newslettersubscribe_unsubject_'.$language['language_id'].'_custumer'];
					
					$data['newslettersubscribe_unmail'][$language['language_id']]['custumer'] = $this->request->post['newslettersubscribe_unmail_'.$language['language_id'].'_custumer'];
				
				}else{
				
				if ($this->config->get('newslettersubscribe_unsubject_'.$language['language_id'].'_custumer')){
				
					$data['newslettersubscribe_unsubject'][$language['language_id']]['custumer'] = $this->config->get('newslettersubscribe_unsubject_'.$language['language_id'].'_custumer');
				
				}else{
				
				
					$data['newslettersubscribe_unsubject'][$language['language_id']]['custumer'] = $this->language->get('default_unmail_unsubject');
				
				}
				
				if ($this->config->get('newslettersubscribe_unmail_'.$language['language_id'].'_custumer')){
				
					$data['newslettersubscribe_unmail'][$language['language_id']]['custumer'] = $this->config->get('newslettersubscribe_unmail_'.$language['language_id'].'_custumer');
				
				}else{
				
					$data['newslettersubscribe_unmail'][$language['language_id']]['custumer'] =$this->language->get('default_unmail_body');
				
				}
			}
			
			if(isset($this->request->post['newslettersubscribe_unsubject_'.$language['language_id'].'_admin'])){
			
				$data['newslettersubscribe_unsubject'][$language['language_id']]['admin'] = $this->request->post['newslettersubscribe_unsubject_'.$language['language_id'].'_admin'];
				
				$data['newslettersubscribe_unmail'][$language['language_id']]['admin'] = $this->request->post['newslettersubscribe_unmail_'.$language['language_id'].'_admin'];
				
			}else{
			
				if ($this->config->get('newslettersubscribe_unsubject_'.$language['language_id'].'_admin')){
					
				$data['newslettersubscribe_unsubject'][$language['language_id']]['admin'] = $this->config->get('newslettersubscribe_unsubject_'.$language['language_id'].'_admin'); 
				
				}else{
				
				$data['newslettersubscribe_unsubject'][$language['language_id']]['admin'] = $this->language->get('default_unmail_unsubject_admin');
				}
				
				if ( $this->config->get('newslettersubscribe_unmail_'.$language['language_id'].'_admin')){
				
				$data['newslettersubscribe_unmail'][$language['language_id']]['admin'] = $this->config->get('newslettersubscribe_unmail_'.$language['language_id'].'_admin');
				
				}else{
				
				$data['newslettersubscribe_unmail'][$language['language_id']]['admin'] = $this->language->get('default_unmail_body_admin');
				
				}
			}
				
			if(isset($this->request->post['newslettersubscribe_subject_'.$language['language_id'].'_custumer'])){
			
				$data['newslettersubscribe_subject'][$language['language_id']]['custumer'] = $this->request->post['newslettersubscribe_subject_'.$language['language_id'].'_custumer'];
				
				$data['newslettersubscribe_mail'][$language['language_id']]['custumer'] = $this->request->post['newslettersubscribe_mail_'.$language['language_id'].'_custumer'];
				
			}else{
			
				if ($this->config->get('newslettersubscribe_subject_'.$language['language_id'].'_custumer')){
				
				$data['newslettersubscribe_subject'][$language['language_id']]['custumer'] = $this->config->get('newslettersubscribe_subject_'.$language['language_id'].'_custumer');
				
				}else{
				
				
				$data['newslettersubscribe_subject'][$language['language_id']]['custumer'] = $this->language->get('default_mail_subject');
				
				}
				
				if ($this->config->get('newslettersubscribe_mail_'.$language['language_id'].'_custumer')){
				
				$data['newslettersubscribe_mail'][$language['language_id']]['custumer'] = $this->config->get('newslettersubscribe_mail_'.$language['language_id'].'_custumer');
				
				}else{
				
				$data['newslettersubscribe_mail'][$language['language_id']]['custumer'] =$this->language->get('default_mail_body');
				
				}
			}
			if(isset($this->request->post['newslettersubscribe_subject_'.$language['language_id'].'_admin'])){
			
				$data['newslettersubscribe_subject'][$language['language_id']]['admin'] = $this->request->post['newslettersubscribe_subject_'.$language['language_id'].'_admin'];
				
				$data['newslettersubscribe_mail'][$language['language_id']]['admin'] = $this->request->post['newslettersubscribe_mail_'.$language['language_id'].'_admin'];
				
			}else{
			
				if ($this->config->get('newslettersubscribe_subject_'.$language['language_id'].'_admin')){
				
				$data['newslettersubscribe_subject'][$language['language_id']]['admin'] = $this->config->get('newslettersubscribe_subject_'.$language['language_id'].'_admin'); 
				
				}else{
				
				$data['newslettersubscribe_subject'][$language['language_id']]['admin'] = $this->language->get('default_mail_subject_admin');
				}
				
				if ( $this->config->get('newslettersubscribe_mail_'.$language['language_id'].'_admin')){
				
				$data['newslettersubscribe_mail'][$language['language_id']]['admin'] = $this->config->get('newslettersubscribe_mail_'.$language['language_id'].'_admin');
				
				}else{
				
				$data['newslettersubscribe_mail'][$language['language_id']]['admin'] = $this->language->get('default_mail_body_admin');
				
				}
			}
				
				if(isset($this->request->post['newslettersubscribe_fheading_title_'.$language['language_id'].'_line'])){
				$data['newslettersubscribe_fheading_title'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_fheading_title_'.$language['language_id'].'_line'];
				}else{
				if ( $this->config->get('newslettersubscribe_fheading_title_'.$language['language_id'].'_line')){
				$data['newslettersubscribe_fheading_title'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_fheading_title_'.$language['language_id'].'_line');
				}else {
				$data['newslettersubscribe_fheading_title'][$language['language_id']]['line'] = $this->language->get('dheading_title');
				}
			}
			
			
			for($l=1;$l<=6;$l++){
				$data['entry_optionfield'][$l] = $this->language->get('entry_optionfield_'.$l.'');
				
				if(isset($this->request->post['newslettersubscribe_optionfield_'.$language['language_id'].$l.''])){
				
					$data['newslettersubscribe_optionfield'][$language['language_id']][$l] = $this->request->post['newslettersubscribe_optionfield_'.$language['language_id'].$l.''];
				}else{
					if ( $this->config->get('newslettersubscribe_optionfield_'.$language['language_id'].$l.'')){
						$data['newslettersubscribe_optionfield'][$language['language_id']][$l] = $this->config->get('newslettersubscribe_optionfield_'.$language['language_id'].$l.'');
					}else {
						$data['newslettersubscribe_optionfield'][$language['language_id']][$l] = $this->language->get('doptionfieldset');
					}
				}	
			}
			
			if(isset($this->request->post['newslettersubscribe_popupline2_'.$language['language_id'].'_line'])){
			
				$data['newslettersubscribe_popupline2'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_popupline2_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_popupline2_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_popupline2'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_popupline2_'.$language['language_id'].'_line');
				}else {
					$data['newslettersubscribe_popupline2'][$language['language_id']]['line'] = $this->language->get('dpopupline2');
				}
			}
			
			if(isset($this->request->post['newslettersubscribe_popupline1_'.$language['language_id'].'_line'])){
			
				$data['newslettersubscribe_popupline1'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_popupline2_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_popupline1_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_popupline1'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_popupline1_'.$language['language_id'].'_line');
				}else {
					$data['newslettersubscribe_popupline1'][$language['language_id']]['line'] = $this->language->get('dpopupline1');
				}
			}
			
			if(isset($this->request->post['newslettersubscribe_fentry_email_'.$language['language_id'].'_line'])){
			
			$data['newslettersubscribe_fentry_email'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_fentry_email_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_fentry_email_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_fentry_email'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_fentry_email_'.$language['language_id'].'_line');
				}else {
					$data['newslettersubscribe_fentry_email'][$language['language_id']]['line'] = $this->language->get('dentry_email');
				}
			}
			
			if(isset($this->request->post['newslettersubscribe_fentry_name_'.$language['language_id'].'_line'])){		
				$data['newslettersubscribe_fentry_name'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_fentry_name_'.$language['language_id'].'_line'];
			}else {
				if ( $this->config->get('newslettersubscribe_fentry_name_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_fentry_name'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_fentry_name_'.$language['language_id'].'_line');
				}else {
					$data['newslettersubscribe_fentry_name'][$language['language_id']]['line'] = $this->language->get('dentry_name');
				}
			}
			
			if(isset($this->request->post['newslettersubscribe_fentry_button_'.$language['language_id'].'_line'])){		
				$data['newslettersubscribe_fentry_button'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_fentry_button_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_fentry_button_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_fentry_button'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_fentry_button_'.$language['language_id'].'_line');
				}else {
					$data['newslettersubscribe_fentry_button'][$language['language_id']]['line'] = $this->language->get('dentry_button');
				}
			}
				
			if(isset($this->request->post['newslettersubscribe_fentry_unbutton_'.$language['language_id'].'_line'])){		
				$data['newslettersubscribe_fentry_unbutton'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_fentry_unbutton_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_fentry_unbutton_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_fentry_unbutton'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_fentry_unbutton_'.$language['language_id'].'_line');
				}else{
					$data['newslettersubscribe_fentry_unbutton'][$language['language_id']]['line'] = $this->language->get('dentry_unbutton');
				}
			}
			
			if(isset($this->request->post['newslettersubscribe_ftext_subscribe_'.$language['language_id'].'_line'])){		
				$data['newslettersubscribe_ftext_subscribe'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_ftext_subscribe_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_ftext_subscribe_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_ftext_subscribe'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_ftext_subscribe_'.$language['language_id'].'_line');
				}else{
					$data['newslettersubscribe_ftext_subscribe'][$language['language_id']]['line'] = $this->language->get('dtext_subscribe');
				}
			}
			
			if(isset($this->request->post['newslettersubscribe_ferror_invalid_'.$language['language_id'].'_line'])){		
				$data['newslettersubscribe_ferror_invalid'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_ferror_invalid_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_ferror_invalid_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_ferror_invalid'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_ferror_invalid_'.$language['language_id'].'_line');
				}else{
					$data['newslettersubscribe_ferror_invalid'][$language['language_id']]['line'] = $this->language->get('derror_invalid');
				}
			}
				
			if(isset($this->request->post['newslettersubscribe_fsubscribe_'.$language['language_id'].'_line'])){		
			$data['newslettersubscribe_fsubscribe'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_fsubscribe_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_fsubscribe_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_fsubscribe'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_fsubscribe_'.$language['language_id'].'_line');
				}else{
					$data['newslettersubscribe_fsubscribe'][$language['language_id']]['line'] = $this->language->get('dsubscribe');
				}
			}
			
			if(isset($this->request->post['newslettersubscribe_foptioninvalid_'.$language['language_id'].'_line'])){		
				$data['newslettersubscribe_foptioninvalid'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_foptioninvalid_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_foptioninvalid_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_foptioninvalid'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_foptioninvalid_'.$language['language_id'].'_line');
				}else{
					$data['newslettersubscribe_foptioninvalid'][$language['language_id']]['line'] = $this->language->get('doptioninvalid');
				}
			}
			
			if(isset($this->request->post['newslettersubscribe_fnameinvalid_'.$language['language_id'].'_line'])){		
				$data['newslettersubscribe_fnameinvalid'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_fnameinvalid_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_fnameinvalid_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_fnameinvalid'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_fnameinvalid_'.$language['language_id'].'_line');
				}else{
					$data['newslettersubscribe_fnameinvalid'][$language['language_id']]['line'] = $this->language->get('dnameinvalid');
				}
			}
			
			
			if(isset($this->request->post['newslettersubscribe_funsubscribe_'.$language['language_id'].'_line'])){		
				$data['newslettersubscribe_funsubscribe'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_funsubscribe_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_funsubscribe_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_funsubscribe'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_funsubscribe_'.$language['language_id'].'_line');
				}else{
					$data['newslettersubscribe_funsubscribe'][$language['language_id']]['line'] = $this->language->get('dunsubscribe');
				}
			}
			//echo '<pre>';
			//print_r($data);
			//die();
			
			if(isset($this->request->post['newslettersubscribe_falreadyexist_'.$language['language_id'].'_line'])){		
				$data['newslettersubscribe_falreadyexist'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_falreadyexist_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_falreadyexist_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_falreadyexist'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_falreadyexist_'.$language['language_id'].'_line');
				}else{
					$data['newslettersubscribe_falreadyexist'][$language['language_id']]['line'] = $this->language->get('dalreadyexist');
				}
			}
			
			if(isset($this->request->post['newslettersubscribe_fnotexist_'.$language['language_id'].'_line'])){		
			$data['newslettersubscribe_fnotexist'][$language['language_id']]['line'] = $this->request->post['newslettersubscribe_fnotexist_'.$language['language_id'].'_line'];
			}else{
				if ( $this->config->get('newslettersubscribe_fnotexist_'.$language['language_id'].'_line')){
					$data['newslettersubscribe_fnotexist'][$language['language_id']]['line'] = $this->config->get('newslettersubscribe_fnotexist_'.$language['language_id'].'_line');
				}else{
					$data['newslettersubscribe_fnotexist'][$language['language_id']]['line'] = $this->language->get('dnotexist');
				}
			}
			
			$this->load->model('tool/image');
			$imagepath='';
			
				
				
			
			if(isset($this->request->post['newslettersubscribe_'.$language['language_id'].'_popupheaderimage'])){		
				$data['newslettersubscribe'][$language['language_id']]['popupheaderimage'] = $this->request->post['newslettersubscribe_'.$language['language_id'].'_popupheaderimage'];
			
			}else{
				if ( $this->config->get('newslettersubscribe_'.$language['language_id'].'_popupheaderimage')){
					$imagepath=$this->config->get('newslettersubscribe_'.$language['language_id'].'_popupheaderimage');
				
					$data['newslettersubscribe'][$language['language_id']]['popupheaderimage'] = $this->config->get('newslettersubscribe_'.$language['language_id'].'_popupheaderimage');
				}else{
					$imagepath='no_image.jpg';
					$data['newslettersubscribe'][$language['language_id']]['popupheaderimage'] = 'no_image.jpg';
				}
			}
			
			
			if (!empty($imagepath) && file_exists(DIR_IMAGE . $imagepath)) {
				$data['thumb2'][$language['language_id']] = $this->model_tool_image->resize($imagepath, 100, 100);
			}else{
				$data['thumb2'][$language['language_id']]  = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			}
		}
		
			
			
		if (isset($this->request->post['newslettersubscribe_force'])) {
			$data['newslettersubscribe_force'] = $this->request->post['newslettersubscribe_force'];
		}else{
			$data['newslettersubscribe_force'] = $this->config->get('newslettersubscribe_force');
		}
		
		if (isset($this->request->post['newslettersubscribe_transaction_id'])) {
			$data['newslettersubscribe_transaction_id'] = $this->request->post['newslettersubscribe_transaction_id'];
		}else{
			$data['newslettersubscribe_transaction_id'] = $this->config->get('newslettersubscribe_transaction_id');
		}
		
				if (isset($this->request->post['newslettersubscribe_enable'])) {
			$data['newslettersubscribe_enable'] = $this->request->post['newslettersubscribe_enable'];
		}else{
			$data['newslettersubscribe_enable'] = $this->config->get('newslettersubscribe_enable');
		}
		
		
		
		if (isset($this->request->post['newslettersubscribe_localemail'])) {
			$data['newslettersubscribe_localemail'] = $this->request->post['newslettersubscribe_localemail'];
		}else{
			$data['newslettersubscribe_localemail'] = $this->config->get('newslettersubscribe_localemail');
		}
		
		
	
		
		if(isset($this->request->post['newslettersubscribe_popupdelay'])){
		
			$data['newslettersubscribe_popupdelay'] = $this->request->post['newslettersubscribe_popupdelay'];
			
		}else{
		
			if ($this->config->get('newslettersubscribe_popupdelay')){
			
				$data['newslettersubscribe_popupdelay'] = $this->config->get('newslettersubscribe_popupdelay'); 
			
			}else{
			
				$data['newslettersubscribe_popupdelay'] = $this->language->get('dpopupdelay');
			}
		}
		
		
		if (isset($this->request->post['newslettersubscribe_popupdisplay'])) {
			$data['newslettersubscribe_popupdisplay'] = $this->request->post['newslettersubscribe_popupdisplay'];
		}else{
			$data['newslettersubscribe_popupdisplay'] = $this->config->get('newslettersubscribe_popupdisplay');
		}
		
		$stores = $this->db->query("SELECT * FROM " . DB_PREFIX . "store ORDER BY name");
		$data['stores'] = $stores->rows;
		$stores = $stores->rows;
		
		array_unshift($data['stores'], array('store_id' => 0, 'name' => $this->config->get('config_name')));
		
		array_unshift($stores, array('store_id' => 0, 'name' => $this->config->get('config_name')));
		
	foreach ($stores as $store){
			
		if (isset($this->request->post['newslettersubscribe_'.$store['store_id'].'_mailchimpmsync'])) 				{
			$data['newslettersubscribe'][$store['store_id']]['mailchimpmsync'] = $this->request->post['newslettersubscribe_'.$store['store_id'].'_mailchimpmsync'];
		}else{
		
			$data['newslettersubscribe'][$store['store_id']]['mailchimpmsync'] = $this->config->get('newslettersubscribe_'.$store['store_id'].'_mailchimpmsync');
		}
		
			
			
		if (isset($this->request->post['newslettersubscribe_'.$store['store_id'].'_mailchimpapi'])) {
			$data['newslettersubscribe'][$store['store_id']]['mailchimpapi'] = $this->request->post['newslettersubscribe_'.$store['store_id'].'_mailchimpapi'];
		}else{
		
			$data['newslettersubscribe'][$store['store_id']]['mailchimpapi'] = $this->config->get('newslettersubscribe_'.$store['store_id'].'_mailchimpapi');
		}
			
			
		if (isset($this->request->post['newslettersubscribe_'.$store['store_id'].'_mailchimplistid'])) {
				$data['newslettersubscribe'][$store['store_id']]['mailchimplistid'] = $this->request->post['newslettersubscribe_'.$store['store_id'].'__mailchimplistid'];
			}else{
			
				$data['newslettersubscribe'][$store['store_id']]['mailchimplistid'] = $this->config->get('newslettersubscribe_'.$store['store_id'].'_mailchimplistid');
			}
		}
		if (isset($this->request->post['newslettersubscribe_mailchimp_mwelcome'])) {
			$data['newslettersubscribe_mailchimp_mwelcome'] = $this->request->post['newslettersubscribe_mailchimp_mwelcome'];
		}else{
			$data['newslettersubscribe_mailchimp_mwelcome'] = $this->config->get('newslettersubscribe_mailchimp_mwelcome');
		}
		
		if (isset($this->request->post['newslettersubscribe_mailchimp_optin'])) {
			$data['newslettersubscribe_mailchimp_optin'] = $this->request->post['newslettersubscribe_mailchimp_optin'];
		}else{
			$data['newslettersubscribe_mailchimp_optin'] = $this->config->get('newslettersubscribe_mailchimp_optin');
		}
		
		
		
		$data['entry_mail'] = $this->language->get('entry_mail');
		$data['entry_options'] = $this->language->get('entry_options');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_module'] = $this->language->get('button_add_module');
		$data['button_remove'] = $this->language->get('button_remove');
			
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}else{
			$data['error_warning'] = '';
		}
			
		if (isset($this->error['name'])) {
			$data['error_modulename'] = $this->error['name'];
		} else {
			$data['error_modulename'] = '';
		}
			
		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		
		$data['breadcrumbs'][] = array(
		'text'      => $this->language->get('text_module'),
		'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		
		);
		
				if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/newslettersubscribe', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/newslettersubscribe', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);			
		}
		
		
		
	
			
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/newslettersubscribe', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/newslettersubscribe', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		if (isset($this->request->post['newslettersubscribe_option_unsubscribe'])) {
			$data['newslettersubscribe_option_unsubscribe'] = $this->request->post['newslettersubscribe_option_unsubscribe'];
		}else{
			$data['newslettersubscribe_option_unsubscribe'] = $this->config->get('newslettersubscribe_option_unsubscribe');
		}
		
		
		
		if (isset($this->request->post['newslettersubscribe_mail_status'])) {
			$data['newslettersubscribe_mail_status'] = $this->request->post['newslettersubscribe_mail_status'];
		}else{
			$data['newslettersubscribe_mail_status'] = $this->config->get('newslettersubscribe_mail_status');
		}
		
			
		$data['newslettersubscribe_thickbox'] = '';
		
		
		if (isset($this->request->post['newslettersubscribe_option_field'])) {
			$data['newslettersubscribe_option_field'] = $this->request->post['newslettersubscribe_option_field'];
		}else{
			$data['newslettersubscribe_option_field'] = $this->config->get('newslettersubscribe_option_field');
		}
		
		
				$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
				$data['placeholder'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		
		
	  if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		

	
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}	
		
		
		if (isset($this->request->post['type'])) {
			$data['type'] = $this->request->post['type'];
		} elseif (!empty($module_info)) {
			$data['type'] = $module_info['type'];
		} else {
			$data['type'] = 'normal';
		}	
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
	
		$data['token'] = $this->session->data['token'];
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/newslettersubscribe.tpl', $data));
	}
	
		
	public function save(){
		$this->load->language('module/newslettersubscribe');
		
		$this->load->model('setting/setting');
		
		$success=$this->language->get('common_settings_success');
		
		
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {	
			
			$this->model_setting_setting->editSetting('newslettersubscribe', $this->request->post);		
			
			$out = array('message' => $success, 'type' => 'alert-success');
			$this->response->addHeader('Content-type: application/json');
			$this->response->setOutput($out ? json_encode($out) : '');
		}
		
	}
	
	
		protected function validate() {
		
		$this->load->model('setting/setting');
		if (!$this->user->hasPermission('modify', 'module/featured')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->config->get('newslettersubscribe_popupdelay')){
					$this->error['warning'] = $this->language->get('error_save_setting');
		
			}
					
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		

		
		return !$this->error;
	}
	

}
