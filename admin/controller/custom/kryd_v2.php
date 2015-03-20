<?php
class ControllerCustomKrydv2 extends Controller{ 
  public function index(){
    $this->load->language('custom/kryd');
  
    $this->document->setTitle($this->language->get('heading_title'));
    
    $data=Array();
    
    $data['breadcrumbs']=array();
    $data['breadcrumbs'][]=array(
     'text'      => $this->language->get('text_home'),
     'href'      => $this->url->link('common/home','token='.$this->session->data['token'],'SSL'),
     'separator' => false
    );
  
    $data['breadcrumbs'][]=array(
     'text'      => $this->language->get('cur_crumb'),
     'href'      => $this->url->link('custom/kryd_v2','token='.$this->session->data['token'],'SSL'),
     'separator' => ' :: '
    );
      
    if (isset($this->session->data['success'])) {
     $data['success']=$this->session->data['success'];
     unset($this->session->data['success']);
    } else {
     $data['success']='';
    }
    
    $data['kryd_id']='';
    $data['kryd_key']='';
    $data['error_id']='';
    $data['error_key']='';
    
    $data=$this->viewSettings($data);
    $data['kryd_has_settings']="no";
    if ($data['kryd_id'] && $data['kryd_key']) $data['kryd_has_settings']="yes";
    $data=$this->setErrorMsg($data);

    
    $data['heading_title']=$this->language->get('kryd_title');
    $data['kryd_subhead']=$this->language->get('kryd_subhead');
    $data['kryd_maintext']=$this->language->get('kryd_maintext');
    
    $data['kryd_label_id']=$this->language->get('kryd_label_id');
    $data['kryd_label_key']=$this->language->get('kryd_label_key');
    
    $data['kryd_save']=$this->language->get('kryd_save');
    $data['kryd_cancel']=$this->language->get('kryd_cancel');
    
    $data['kryd_cancel_action']= $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
    
    $data['submit_kryd']=$this->url->link('custom/kryd_v2/submit_kryd_account_settings','token='.$this->session->data['token'],'SSL');    // VARS
    
    // Template
    $data['header'] = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer'] = $this->load->controller('common/footer');
    $this->response->setOutput($this->load->view('custom/kryd.tpl', $data));
  }
  
  private function viewSettings($data) {
    if (file_exists($settingsfile="../kryd/settings.php")) {
      $data["hassettingsfile"]=true;
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
            $data['kryd_'.$s]=trim($kid);
          }
        }
      }
    } else {
      $data["hassettingsfile"]=false;
      $this->load->model('setting/setting');
      $mydata=$this->model_setting_setting->getSetting("kryd");
      if (isset($mydata["kryd_id"])) $data['kryd_id']=$mydata["kryd_id"];
      if (isset($mydata["kryd_key"])) $data['kryd_key']=$mydata["kryd_key"];
    }
    //if ($data['kryd_id'] && $data['kryd_key']) return true;
    return $data;
  }
  
  private function setErrorMsg($data) {
    if (isset($this->session->data['error']) && count($this->session->data['error'])>0) {
     $msg="<ul>";
     foreach ($this->session->data['error'] as $e) {
      if ($e["msg"]!="") {
        $msg.="<li>".$e["msg"]."</li>";
        $data['error_'.$e["key"]]="yes";
      }
      $data['kryd_'.$e["key"]]=$e["val"];
     }
     
     $msg.="</ul>";
     $data['error']=$msg;
     
     unset($this->session->data['error']);
    } else {
     $data['error']='';
    }
    return $data;
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
      
      if (in_array("id",$errors)) $msg=$this->language->get("error_id"); else $msg="";
      $this->session->data['error'][]=Array("msg"=>$msg,"key"=>"id","val"=>$this->request->post['kryd_id']);
      if (in_array("key",$errors)) $msg=$this->language->get("error_key"); else $msg="";
      $this->session->data['error'][]=Array("msg"=>$msg,"key"=>"key","val"=>$this->request->post['kryd_key']);
      
      $this->response->redirect($this->url->link('custom/kryd_v2','token='.$this->session->data['token'],'SSL'));
    } else {
      $this->save_kryd_account_settings();
    }
  }
  
  private function save_kryd_account_settings() {
    $this->load->model('setting/setting');
    
    $data=$this->model_setting_setting->getSetting("kryd");
    $data=array_merge($data,$this->request->post);
    
    $this->model_setting_setting->editSetting('kryd',$data);
    
    $this->language->load('custom/kryd');
    $this->session->data['success']=$this->language->get("kryd_success");
    $this->response->redirect($this->url->link('custom/kryd_v2','token='.$this->session->data['token'],'SSL'));
  }
}
?>