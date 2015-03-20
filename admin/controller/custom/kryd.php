<?php
class ControllerCustomKryd extends Controller{ 
  public function index(){
    $this->language->load('custom/kryd');
  
    $this->document->setTitle($this->language->get('heading_title')); 
  
    $this->data['breadcrumbs']=array();
      
    $this->data['breadcrumbs'][]=array(
     'text'      => $this->language->get('text_home'),
     'href'      => $this->url->link('common/home','token='.$this->session->data['token'],'SSL'),
     'separator' => false
    );
  
    $this->data['breadcrumbs'][]=array(
     'text'      => $this->language->get('cur_crumb'),
     'href'      => $this->url->link('custom/kryd','token='.$this->session->data['token'],'SSL'),
     'separator' => ' :: '
    );
      
    if (isset($this->session->data['success'])) {
     $this->data['success']=$this->session->data['success'];
     unset($this->session->data['success']);
    } else {
     $this->data['success']='';
    }
    
    $this->data['kryd_id']='';
    $this->data['kryd_key']='';
    
    $hassettings=$this->viewSettings();
    $this->data['kryd_has_settings']="no";
    if ($hassettings) $this->data['kryd_has_settings']="yes";
    $this->setErrorMsg();
    
    $this->data['heading_title']=$this->language->get('kryd_title');
    $this->data['kryd_subhead']=$this->language->get('kryd_subhead');
    $this->data['kryd_maintext']=$this->language->get('kryd_maintext');
    
    $this->data['kryd_label_id']=$this->language->get('kryd_label_id');
    $this->data['kryd_label_key']=$this->language->get('kryd_label_key');
    
    $this->data['kryd_save']=$this->language->get('kryd_save');
    
    $this->data['submit_kryd']=$this->url->link('custom/kryd/submit_kryd_account_settings','token='.$this->session->data['token'],'SSL');    // VARS
    $template="custom/kryd.tpl"; // .tpl location and file
    $this->load->model('custom/kryd');
    $this->template=''.$template.'';
    $this->children=array(
      'common/header',
      'common/footer'
    );      
    $this->response->setOutput($this->render());
  }
  
  private function viewSettings() {
    if (file_exists($settingsfile="../kryd/settings.php")) {
      $fdata=file($settingsfile);
      foreach ($fdata as $line) {
        $sarr=Array("id","key");
        foreach ($sarr as $s) {
          $search="KRYD::".$s;
          $p=strpos($line,$search);
          if (is_int($p)) {
            $q=strpos($line,";");
            $kid=substr($line,$p+strlen($search),$q-strlen($search));
            $kid=str_replace(str_split('\'"()'),"",$kid);
            $this->data['kryd_'.$s]=trim($kid);
          }
        }
      }
    } else {
      $this->load->model('setting/setting');
      $data=$this->model_setting_setting->getSetting("kryd");
      if (isset($data["kryd_id"])) $this->data['kryd_id']=$data["kryd_id"];
      if (isset($data["kryd_key"])) $this->data['kryd_key']=$data["kryd_key"];
    }
    if ($this->data['kryd_id'] && $this->data['kryd_key']) return true;
  }
  
  private function setErrorMsg() {
    if (isset($this->session->data['error']) && count($this->session->data['error'])>0) {
     $msg="<ul>";
     foreach ($this->session->data['error'] as $e) {
      $msg.="<li>".$e["msg"]."</li>";
      $this->data['kryd_'.$e["key"]]=$e["val"];
     }
     $msg.="</ul>";
     $this->data['error']=$msg;
     
     unset($this->session->data['error']);
    } else {
     $this->data['error']='';
    }
  }
  
  public function submit_kryd_account_settings() {
    $errors=Array();
    if (isset($this->session->data['error'])) unset($this->session->data['error']);
    
    $kid=$this->request->post['kryd_id'];
    if (trim($kid)=="" || $kid[0]!="C" || strlen(trim($kid))!=7) {
      $errors[]="id";
    }
    
    $kkey=$this->request->post['kryd_key'];
    if (trim($kkey)=="" || strlen(trim($kkey))!=32) {
      $errors[]="key";
    }
    
    if (count($errors)>0) {
      $this->language->load('custom/kryd');
      foreach ($errors as $error) {
        $this->session->data['error'][]=Array("msg"=>$this->language->get("error_".$error),"key"=>$error,"val"=>$this->request->post['kryd_'.$error]);
      }
      $this->redirect($this->url->link('custom/kryd','token='.$this->session->data['token'],'SSL'));
    } else {
      $this->save_kryd_account_settings();
    }
				//$this->redirect($this->url->link('custom/kryd/save_kryd_account_settings','token='.$this->session->data['token'],'SSL'));
  }
  
  private function save_kryd_account_settings() {
    $this->load->model('setting/setting');
    
    //$this->model_setting_setting->deleteSetting("kryd");die();
    
    
    $data=$this->model_setting_setting->getSetting("kryd");
    $data=array_merge($data,$this->request->post);
    
    $this->model_setting_setting->editSetting('kryd',$data);
    
    $this->language->load('custom/kryd');
    $this->session->data['success']=$this->language->get("kryd_success");
    $this->redirect($this->url->link('custom/kryd','token='.$this->session->data['token'],'SSL'));
  }
}
?>