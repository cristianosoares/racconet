<?php
class ControllerMailsubscribeShow extends Controller {
    public function index() {
		$this->load->model('mailsubscribe/show');
		
		$this->load->language('mailsubscribe/show');
			
				
   
		
		if(isset($this->request->get['codevalue'])){
			$pieces = explode("~~", base64_decode($this->request->get['codevalue'])); 
			
			$result = $this->model_mailsubscribe_show->getHistory($pieces[1]);
			
			
			$template = $this->model_mailsubscribe_show->getTemplate($result['template_id']);
			
			$message ='';
			$changemessage ='';
			$codedvalue =$pieces[0]."~~".$pieces[1];
			
			$changemessage = str_replace('{web_version}',$this->language->get('text_web_version').'<a href="'.$this->url->link('mailsubscribe/show&codevalue='. base64_encode($codedvalue), '', 'SSL').'">'.$this->language->get('text_web_version_here').'</a>',$result['message']);
			$changemessage = str_replace('{unsubscribe_url}','<a href="'.$this->url->link('mailsubscribe/click/unsubscribe&user='.base64_encode($pieces[0]), '', 'SSL').'">'.$this->language->get('text_unsubscribe').'</a>',$changemessage);
			
			
			
			$message  = '<html>' . "\n";
			$message .= '  <head>' . "\n";
			$message .= '    <title>' . $result['subject'] . '</title>' . "\n";
			$message .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
			if(isset($template['custom_css'])){
				
				$message .=	'<style type="text/css">'. html_entity_decode($template['custom_css'], ENT_COMPAT, 'UTF-8') . '</style>';
			}
			$message .= '  </head>' . "\n";
			$message .= '  <body>' . html_entity_decode($changemessage, ENT_COMPAT, 'UTF-8') . '</body>' . "\n";
			$message .= '</html>' . "\n";
			
			echo ($message);
		}
		
		
		if(isset($this->request->get['history_id'])){
			$result = $this->model_mailsubscribe_show->getHistory($this->request->get['history_id']);
			
			
			$template = $this->model_mailsubscribe_show->getTemplate($result['template_id']);
			
			$message ='';
						/*$changemessage ='';
						$changemessage = str_replace('{unsubscribe_url}','<a href='.$store_url.'index.php?route=mailsubscribe/click/unsubscribe&user='.base64_encode($email).'>Unsubscribe</a>',$schedule['message']);*/
			$message  = '<html>' . "\n";
			$message .= '  <head>' . "\n";
			$message .= '    <title>' . $result['subject'] . '</title>' . "\n";
			$message .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
			if(isset($template['custom_css'])){
				
				$message .=	'<style type="text/css">'. html_entity_decode($template['custom_css'], ENT_COMPAT, 'UTF-8') . '</style>';
			}
			$message .= '  </head>' . "\n";
			$message .= '  <body>' . html_entity_decode($result['message'], ENT_COMPAT, 'UTF-8') . '</body>' . "\n";
			$message .= '</html>' . "\n";
			
			echo ($message);
			
		}
		
	}
}