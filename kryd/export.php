<?php
require_once('../config.php');
require_once('../vqmod/vqmod.php');
VQMod::bootup();
require_once(VQMod::modCheck(DIR_SYSTEM . 'startup.php'));
require_once(VQMod::modCheck(DIR_SYSTEM . 'library/customer.php'));

function xmlentities($string) {
  return str_replace(array('&','"',"'",'<', '>'),array('&amp;','&quot;','&apos;','&lt;','&gt;'),$string);
}

$registry=new Registry();

$loader=new Loader($registry);
$registry->set('load', $loader);

// Request // neu opencart 2.0
$request = new Request();
$registry->set('request', $request);

//$cache = new Cache();// alt opencart <2.0
$cache = new Cache('file');
$registry->set('cache', $cache);

$config=new Config();
$registry->set('config', $config);

$db=new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);

$query = $db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '0'");

foreach ($query->rows as $setting) {
  if (!$setting['serialized']) {
    $config->set($setting['key'], $setting['value']);
  } else {
    $config->set($setting['key'], unserialize($setting['value']));
  }
}

$session = new Session();
$registry->set('session', $session); 
$languages = array();

$query = $db->query("SELECT * FROM " . DB_PREFIX . "language"); 
foreach ($query->rows as $result) {
    $languages[$result['code']] = $result;
}
$config->set('config_language_id', $languages[$config->get('config_admin_language')]['language_id']);
$language = new Language($languages[$config->get('config_admin_language')]['directory']);
$language->load($languages[$config->get('config_admin_language')]['filename']); 
$registry->set('language', $language);  

$registry->set('customer', new Customer($registry));


$loader->model('catalog/product');
$loader->model('tool/image');

$model=$registry->get('model_catalog_product');
$resize=$registry->get('model_tool_image');

$results=$model->getProducts(Array());


header("Content-type:text/xml");
echo '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
echo "<items>\n";
foreach ($results as $item) {
  $image_link=$resize->resize($item["image"],100,100);
  if (!is_int(strpos($image_link,"://"))) {
    $image_link="http://".$_SERVER['SERVER_NAME']."/".$image_link;
  }
  
  echo "  <item>\n";
  echo "    <id>".xmlentities($item["product_id"])."</id>\n";
  echo "    <name>".xmlentities($item["name"])."</name>\n";
  echo "    <price>".xmlentities($item["price"])."</price>\n";
  echo "    <thumb>".xmlentities($image_link)."</thumb>\n";
  echo "  </item>\n";
}
echo '</items>';
?>