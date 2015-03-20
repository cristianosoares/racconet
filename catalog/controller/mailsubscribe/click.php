<?php
class ControllerMailsubscribeClick extends Controller {
	public function index() {
        $this->response->redirect($this->url->link('common/home'));
    }

	public function unsubscribe(){
		$this->load->language('mailsubscribe/click');
		
		$this->load->model('mailsubscribe/click');
		
		if(isset($this->request->get['user'])){
			$this->model_mailsubscribe_click->unsubscribe(base64_decode($this->request->get['user']),$this->config->get('config_store_id'));
		
			echo $this->language->get('text_unsubscribe');
			echo '<br><a href="'.$this->url->link('common/home').'">'.$this->language->get('text_backtostore').'</a>';
			
		}
		
	}
	public function imageread(){
		
		$this->load->model('mailsubscribe/click');
		if(isset($this->request->get['codevalue'])){
			
			$pieces = explode("~~", base64_decode($this->request->get['codevalue'])); 
			
			$this->model_mailsubscribe_click->updateStat($pieces[1]);
			/*Late on same function is used to create personal stat of user*/	
		}
		
	}
}
?>