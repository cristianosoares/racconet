<?php
/**
 * PHP-API for KRYD. This class is responsible for sending events to the KRYD event server.
 *
 */
class KRYD {

  private static $id;
  private static $key;
  private static $sessionid;
  private static $messageid;
  private static $last_error;
  private static $ready=false;

  /**
    * Handles click-tracking. Saves the kryd_messageid in a cookie and reloads the page without the respective query string key
    *
    */
  private static function handle_tracking() {
  }

  /**
    * Returns the last error that occured
    *
    * @return  Array
    */
  public static function last_error() {
    return self::$last_error;
  }
  
  /**
    * Checks whether credentials are ready yet, and if yes, starts tracking handling
    *
    */
  private static function ready() {
    if (self::$ready or !self::$id or !self::$key) return;
    self::$ready=true;
    self::handle_tracking();
  }
  
  /**
    * Sets the KRYD account ID
    *
    * @param string $id
    */
  public static function id($id) {
    self::$id=$id;
    self::ready();
  }

  /**
    * Sets the KRYD API key
    *
    * @param string $key
    */
  public static function key($key) {
    self::$key=$key;
    self::ready();
  }
  
  /**
    * Sets a custom sessionid 
    *
    * @param string $sessionid
    */
  public static function sessionid($sessionid) {
    self::$sessionid=$sessionid;
  }
  
  /**
    * Sets a custom messageid
    *
    * @param string $messageid
    */
  public static function messageid($messageid) {
    self::$messageid=$messageid;
  }
  
  #$has_settings_start
  /**
    * Finds out whether a fixed settings file exists
    *
    * @return bool
    */
  public static function has_settings() {
    return is_file(dirname(__FILE__)."/settings.php");
  }
  #$has_settings_end
  
  /**
    * Loads settings
    *
    */
  public static function load_settings() {
    #$load_settings_start
    if (KRYD::has_settings()) include(dirname(__FILE__)."/settings.php");
    #$load_settings_end
  }
    
  /**
    * Looks up a user's basket by a given message ID
    *
    * @param string $messageid
    * @return array
    */
  public static function get_basket($messageid) {
		
    if (!self::$id) {self::$last_error=Array('code'=>'accountid_missing','message'=>'KRYD account id missing.');return false;}
    if (!self::$key) {self::$key_missing=Array('code'=>'key_missing','message'=>'KRYD API key missing.');return false;}

				$signature=md5(self::$id.$messageid.self::$key);
				
				$url="http://feedback.kryd.com/basket.lua?accountid=".rawurlencode(self::$id)."&messageid=".rawurlencode($messageid).'&signature='.$signature;
				
				$ch = curl_init();
				
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				
				$response = curl_exec($ch);
				
				return json_decode($response,true);
		}
    
  /**
    * Sends an event with associated options, return true on success and false on error.
    * In case of an error you can receive the error message via last_error()
    *
    * @param string $eventtype
    * @param array $options 
    * @return bool
    */
  public static function event($eventtype,$options=Array()) {
    
    if (!self::$id) {self::$last_error=Array('code'=>'accountid_missing','message'=>'KRYD account id missing.');return false;}
    if (!self::$key) {self::$key_missing=Array('code'=>'key_missing','message'=>'KRYD API key missing.');return false;}
    
    if (self::$sessionid) {
      $sessionid=self::$sessionid;
    } else {
      $sessionid=md5(session_id());
    }
    
    if (self::$messageid) {
      $options["messageid"]=self::$messageid;
    } else {
      if (isset($_COOKIE["kryd_messageid"])) $options["messageid"]=$_COOKIE["kryd_messageid"];
    }
    
    if (isset($_SERVER["HTTP_HOST"])) $options["host"]=$_SERVER["HTTP_HOST"];
    #$custom_event_options
    
    $post=Array(
      'accountid'=>self::$id,
      'sessionid'=>$sessionid,
      'eventtype'=>$eventtype,
      'options'=>json_encode($options),
      'key'=>self::$key      
    );
    
    $query=''; 
    foreach ($post as $key=>$value) {
      if ($query!=='') $query.="&";
      $query.=$key."=".rawurlencode($value);
    }

    $ch=curl_init('https://api.kryd.com/event.lua');
    curl_setopt($ch,CURLOPT_TIMEOUT,2);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$query);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $response=curl_exec($ch);
    $status=curl_getinfo($ch,CURLINFO_HTTP_CODE);
    
    if ($status!=200) {
      self::$last_error=json_decode($response,true);
      return false;
    }
    
    return true;
  }
  
}

KRYD::load_settings();
?>