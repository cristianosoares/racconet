<?php 
class ModelSaleMailsubscribe extends Model {
	public function getTemplates(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mailsubscribe_template WHERE 1");
		return $query->rows;
	}
	
		
	public function getTemplate($template_id){
		  $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mailsubscribe_template WHERE template_id = '" . (int)$template_id . "'");
        $template_info = $query->row;

        if ($template_info) {
            $template_info['body'] = array();
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mailsubscribe_template_data WHERE template_id = '" . (int)$template_id . "'");
            foreach ($query->rows as $row) {
                $template_info['subject'][$row['language_id']] = $row['subject'];
				$template_info['body'][$row['language_id']] = $row['body'];
				$template_info['text_message'][$row['language_id']] = $row['text_message'];
                $template_info['defined_text'][$row['language_id']] = $row['defined'];
                $template_info['special_text'][$row['language_id']] = $row['special'];
                $template_info['latest_text'][$row['language_id']] = $row['latest'];
                $template_info['popular_text'][$row['language_id']] = $row['popular'];
                $template_info['categories_text'][$row['language_id']] = $row['categories'];
                $template_info['manufactures_text'][$row['language_id']] = $row['manufactures'];
            }
            return $template_info;
        } else {
            return false;
        }
	}
	public function templateGet($data){
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mailsubscribe_template t LEFT JOIN " . DB_PREFIX . "mailsubscribe_template_data td ON t.template_id = td.template_id WHERE t.template_id = '" . (int)$data['template_id'] . "' AND td.language_id = '" . (int)$data['language_id'] . "' ORDER BY td.template_data_id DESC");	
			return $query->row;
		}
	
	public function deleteTemplate($template_id){
		$this->db->query("DELETE FROM " . DB_PREFIX . "mailsubscribe_template WHERE template_id=".(int)$template_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "mailsubscribe_template_data WHERE template_id = " . (int)$template_id);	
	}
	
	public function insertLatestProducts($data){
		$query = $this->db->query("SELECT *, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$data['customer_group_id'] . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special FROM " . DB_PREFIX . "product as p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$data['language_id'] . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$data['store_id'] . "' ORDER BY p.date_added DESC  LIMIT 0,".(int)$data['limit']);
		return $query->rows;
	}
	public function insertSpecialProducts($data){
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_special WHERE customer_group_id='". $data['customer_group_id'] ."' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) GROUP BY product_id LIMIT 0,".(int)$data['limit']);
		$productdata = array();
		foreach($query->rows as $product){
			$query2 = $this->db->query("SELECT *,(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id ORDER BY ps.priority ASC, ps.price LIMIT 1) AS special FROM " . DB_PREFIX . "product as p," . DB_PREFIX . "product_description as pd  WHERE p.product_id = pd.product_id AND pd.language_id = '" . (int)$data['language_id'] . "' AND p.status = '1' AND p.date_available <= NOW() AND p.product_id='".$product['product_id']."'");
			$productdata[] = $query2->row;
		}
		return $productdata;
	}
	public function getBestSellerProducts($data){
		$product_data = $this->cache->get('product.bestseller.mailsubscribe.' . (int)$data['language_id'] . '.' . (int)$data['store_id']. '.' . (int)$data['customer_group_id'] . '.' . (int)$data['limit']);
		
		 if (!$product_data) {
            $product_data = array();
		$query = $this->db->query("SELECT op.product_id, COUNT(*) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$data['store_id'] . "' GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$data['limit']);	
		
				foreach($query->rows as $product){
					$query2 = $this->db->query("SELECT *,(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$data['customer_group_id'] . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special FROM " . DB_PREFIX . "product as p," . DB_PREFIX . "product_description as pd  WHERE p.product_id = pd.product_id AND pd.language_id = '" . (int)$data['language_id'] . "' AND p.product_id='".$product['product_id']."'");
					$product_data[] = $query2->row;
				}
			$this->cache->set('product.bestseller.mailsubscribe.' . (int)$data['language_id'] . '.' . (int)$data['store_id']. '.' . (int)$data['customer_group_id'] . '.' . (int)$data['limit'], $product_data);
		}
		return $product_data;
	}
	public function insertDefinedProduct($product_id,$data){
		$query = $this->db->query("SELECT *,(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$data['customer_group_id'] . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special FROM " . DB_PREFIX . "product as p,". DB_PREFIX . "product_description as pd WHERE p.product_id = pd.product_id AND p.product_id='". (int)$product_id ."' AND pd.language_id = '" . (int)$data['language_id'] . "' ");
		return $query->row;
	}
	public function getProductsByCategoryId($data) {
        $query = $this->db->query("SELECT p.product_id as product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p2c.category_id = '" . (int)$data['category_id'] . "' AND p2s.store_id='". $data['store_id'] ."'");

        return $query->rows;
    }

    public function getPath($data) {
        $query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.category_id = '" . (int)$data['category_id'] . "' AND cd.language_id = '" . (int)$data['language_id'] . "' ORDER BY c.sort_order, cd.name ASC");

        if ($query->row['parent_id']) {
			$data['category_id'] = $query->row['parent_id'];
            return $this->getPath($data) . ' &raquo; ' . $query->row['name'];
        } else {
            return $query->row['name'];
        }
    }
	
	public function getProductsByManufacturerId($data){
		$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)  WHERE manufacturer_id='". (int)$data['manufacturer_id'] ."' AND p2s.store_id = '" . $data['store_id'] . "'");
		return $query->rows;
		
	}
	public function addTemplate($data){
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_template SET `name` = '" .$this->db->escape($data['template_name'] ? $data['template_name'] : date('Y-m-d H:i:s')) . "', `uri` = '" . $this->db->escape($data['template_uri']) . "', date_modified = NOW(), image_width = '" . (int)($data['image_width']? $data['image_width'] : 140)  . "', image_height = '" . (int)($data['image_height']? $data['image_height'] : 140) . "', show_price = '" . (int)$data['show_price'] . "',  product_description_length = '" . (int)($data['product_description_length'] ? $data['product_description_length'] : 100) . "', product_cols = '" . (int)($data['product_cols'] ? $data['product_cols'] : 4) . "', special_product_count = '" . (int)($data['special_product_count'] ? $data['special_product_count'] : 4) . "', latest_product_count = '" . (int)($data['latest_product_count'] ? $data['latest_product_count'] : 4)  . "', popular_product_count = '" . (int)($data['popular_product_count'] ? $data['popular_product_count'] : 4) . "', heading_color = '" . $this->db->escape($data['heading_color'] ? $data['heading_color'] : '#222222') . "', heading_style = '" . $this->db->escape($data['heading_style']) . "', product_name_color = '" . $this->db->escape($data['product_name_color'] ? $data['product_name_color'] : '#222222') . "', product_name_style = '" . $this->db->escape($data['product_name_style']) . "', product_model_color = '" . $this->db->escape($data['product_model_color'] ? $data['product_model_color'] : '#222222') . "', product_model_style = '" . $this->db->escape($data['product_model_style']) . "', product_price_color = '" . $this->db->escape($data['product_price_color'] ? $data['product_price_color'] : '#222222') . "', product_price_style = '" . $this->db->escape($data['product_price_style']) . "', product_price_color_special = '" . $this->db->escape($data['product_price_color_special'] ? $data['product_price_color_special'] : '#222222') . "', product_price_style_special = '" . $this->db->escape($data['product_price_style_special']) . "',  product_description_color = '" . $this->db->escape($data['product_description_color'] ? $data['product_description_color'] : '#222222') . "', product_description_style = '" . $this->db->escape($data['product_description_style']) . "', show_custom_css='". (int)$data['show_custom_css']."',   custom_css = '" . $this->db->escape($data['custom_css']) . "' ");
            $template_id = $this->db->getLastId();
			
			foreach ($data['body'] as $language_id => $body) {
				
					
                $this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_template_data SET `body` = '" . $this->db->escape($body) . "', `text_message` = '" . $this->db->escape(isset($data['text_message'][$language_id]) ? $data['text_message'][$language_id] : '') . "', `subject` = '" . $this->db->escape(isset($data['subject'][$language_id]) ? $data['subject'][$language_id] : '') . "', `defined` = '" . $this->db->escape(isset($data['defined_text'][$language_id]) ? $data['defined_text'][$language_id] : '') . "', `special` = '" . $this->db->escape(isset($data['special_text'][$language_id]) ? $data['special_text'][$language_id] : '') . "', `latest` = '" . $this->db->escape(isset($data['latest_text'][$language_id]) ? $data['latest_text'][$language_id] : '') . "', `popular` = '" . $this->db->escape(isset($data['popular_text'][$language_id]) ? $data['popular_text'][$language_id] : '') . "', `categories` = '" . $this->db->escape(isset($data['categories_text'][$language_id]) ? $data['categories_text'][$language_id] : '') . "', `manufactures` = '" . $this->db->escape(isset($data['manufactures_text'][$language_id]) ? $data['manufactures_text'][$language_id] : '') . "', `language_id` = '" . (int)$language_id . "', `template_id` = '" . (int)$template_id . "'");
			}
	}
	public function editTemplate($data,$template_id){
		$this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_template SET `name` = '" .$this->db->escape($data['template_name'] ? $data['template_name'] : date('Y-m-d H:i:s')) . "', `uri` = '" . $this->db->escape($data['template_uri']) . "', date_modified = NOW(), image_width = '" . (int)($data['image_width']? $data['image_width'] : 140)  . "', image_height = '" . (int)($data['image_height']? $data['image_height'] : 140) . "', show_price = '" . (int)$data['show_price'] . "',  product_description_length = '" . (int)($data['product_description_length'] ? $data['product_description_length'] : 100) . "', product_cols = '" . (int)($data['product_cols'] ? $data['product_cols'] : 4) . "',  special_product_count = '" . (int)($data['special_product_count'] ? $data['special_product_count'] : 4) . "', latest_product_count = '" . (int)($data['latest_product_count'] ? $data['latest_product_count'] : 4)  . "', popular_product_count = '" . (int)($data['popular_product_count'] ? $data['popular_product_count'] : 4) . "', heading_color = '" . $this->db->escape($data['heading_color'] ? $data['heading_color'] : '#222222') . "', heading_style = '" . $this->db->escape($data['heading_style']) . "', product_name_color = '" . $this->db->escape($data['product_name_color'] ? $data['product_name_color'] : '#222222') . "', product_name_style = '" . $this->db->escape($data['product_name_style']) . "', product_model_color = '" . $this->db->escape($data['product_model_color'] ? $data['product_model_color'] : '#222222') . "', product_model_style = '" . $this->db->escape($data['product_model_style']) . "', product_price_color = '" . $this->db->escape($data['product_price_color'] ? $data['product_price_color'] : '#222222') . "', product_price_style = '" . $this->db->escape($data['product_price_style']) . "', product_price_color_special = '" . $this->db->escape($data['product_price_color_special'] ? $data['product_price_color_special'] : '#222222') . "', product_price_style_special = '" . $this->db->escape($data['product_price_style_special']) . "',  product_description_color = '" . $this->db->escape($data['product_description_color'] ? $data['product_description_color'] : '#222222') . "', product_description_style = '" . $this->db->escape($data['product_description_style']) . "', show_custom_css='". (int)$data['show_custom_css']."',  custom_css = '" . $this->db->escape($data['custom_css']) . "' WHERE template_id='". $template_id ."'");
            
			
			foreach ($data['body'] as $language_id => $body) {
				
					
                $this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_template_data SET `body` = '" . $this->db->escape($body) . "', `text_message` = '" . $this->db->escape(isset($data['text_message'][$language_id]) ? $data['text_message'][$language_id] : '') . "', `subject` = '" . $this->db->escape(isset($data['subject'][$language_id]) ? $data['subject'][$language_id] : '') . "', `defined` = '" . $this->db->escape(isset($data['defined_text'][$language_id]) ? $data['defined_text'][$language_id] : '') . "', `special` = '" . $this->db->escape(isset($data['special_text'][$language_id]) ? $data['special_text'][$language_id] : '') . "', `latest` = '" . $this->db->escape(isset($data['latest_text'][$language_id]) ? $data['latest_text'][$language_id] : '') . "', `popular` = '" . $this->db->escape(isset($data['popular_text'][$language_id]) ? $data['popular_text'][$language_id] : '') . "', `categories` = '" . $this->db->escape(isset($data['categories_text'][$language_id]) ? $data['categories_text'][$language_id] : '') . "', `manufactures` = '" . $this->db->escape(isset($data['manufactures_text'][$language_id]) ? $data['manufactures_text'][$language_id] : '') . "', `language_id` = '" . (int)$language_id . "', `template_id` = '" . (int)$template_id . "'");
			}
	}
	public function getCurrency($currency_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency WHERE currency_id='". (int)$currency_id ."'");
		return $query->row;
	}
	public function getStoreLogo($store_id){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_logo' AND store_id='". (int)$store_id ."'");
		return $query->row;
	}
	public function savedraft($data){
		if (isset($data['id']) && $data['id']) {
            $this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_template_draft SET `to` = '" . $this->db->escape($data['to']) . "', store_id = '" . (int)$data['store_id'] . "', attachments_id = '" . (int)$data['attachments_id'] . "', template_id = '" . (int)$data['inserttemplate'] . "', language_id = '" . (int)$data['language_id'] . "',currency ='". (int)$data['currency'] ."', subject = '" . $this->db->escape($data['subject']) . "', message = '" . $this->db->escape($data['message']) . "', defined_product_text = '" . $this->db->escape($data['defined_product_text']) . "',  `defined_products` = '" . $this->db->escape(isset($data['defined_product']) ? serialize($data['defined_product']) : '') . "', `defined_products_more` = '" . $this->db->escape(isset($data['defined_product_more']) ? serialize($data['defined_product_more']) : '') . "', `defined_category` = '" . $this->db->escape(isset($data['defined_category']) ? serialize($data['defined_category']) : '') . "', `defined_manufacture` = '" . $this->db->escape(isset($data['defined_manufacture']) ? serialize($data['defined_manufacture']) : '') . "', `customer` = '" . $this->db->escape((isset($data['customer']) && $data['to'] == 'customer') ? serialize($data['customer']) : '') . "', `affiliate` = '" . $this->db->escape((isset($data['affiliate']) && $data['to'] == 'affiliate') ? serialize($data['affiliate']) : '') . "', `product` = '" . $this->db->escape((isset($data['product']) && $data['to'] == 'product') ? serialize($data['product']) : '') . "', `customer_group_id` = '" . (int)$data['customer_group_id'] . "', `customer_group_only_subscribers` = '" . (isset($data['customer_group_only_subscribers']) ? (int)$data['customer_group_only_subscribers'] : '0') . "', `only_selected_language` = '" . (isset($data['only_selected_language']) ? (int)$data['only_selected_language'] : '0') . "', defined = '" . $this->db->escape($data['defined']) . "', latest = '" . $this->db->escape($data['latest']) . "', popular = '" . $this->db->escape($data['popular']) . "', defined_categories = '" . $this->db->escape($data['defined_categories']) . "', defined_manufactures = '" . $this->db->escape($data['defined_manufactures']) . "', special = '" . $this->db->escape($data['special']) . "' WHERE draft_id = '" . (int)$data['id'] ."'");
        } else {
            $this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_template_draft SET `to` = '" . $this->db->escape($data['to']) . "', store_id = '" . (int)$data['store_id'] . "', attachments_id = '" . (int)$data['attachments_id'] . "', template_id = '" . (int)$data['inserttemplate'] . "', language_id = '" . (int)$data['language_id'] . "', currency ='". (int)$data['currency'] ."', subject = '" . $this->db->escape($data['subject']) . "', message = '" . $this->db->escape($data['message']) . "', defined_product_text = '" . $this->db->escape($data['defined_product_text']) . "',  `defined_products` = '" . $this->db->escape(isset($data['defined_product']) ? serialize($data['defined_product']) : '') . "', `defined_products_more` = '" . $this->db->escape(isset($data['defined_product_more']) ? serialize($data['defined_product_more']) : '') . "', `defined_category` = '" . $this->db->escape(isset($data['defined_category']) ? serialize($data['defined_category']) : '') . "', `defined_manufacture` = '" . $this->db->escape(isset($data['defined_manufacture']) ? serialize($data['defined_manufacture']) : '') . "',`customer` = '" . $this->db->escape((isset($data['customer']) && $data['to'] == 'customer') ? serialize($data['customer']) : '') . "', `affiliate` = '" . $this->db->escape((isset($data['affiliate']) && $data['to'] == 'affiliate') ? serialize($data['affiliate']) : '') . "', `product` = '" . $this->db->escape((isset($data['product']) && $data['to'] == 'product') ? serialize($data['product']) : '') . "', `customer_group_id` = '" . (int)$data['customer_group_id'] . "', `customer_group_only_subscribers` = '" . (isset($data['customer_group_only_subscribers']) ? (int)$data['customer_group_only_subscribers'] : '0') . "', `only_selected_language` = '" . (isset($data['only_selected_language']) ? (int)$data['only_selected_language'] : '0') . "', defined = '" . $this->db->escape($data['defined']) . "', latest = '" . $this->db->escape($data['latest']) . "', popular = '" . $this->db->escape($data['popular']) . "', defined_categories = '" . $this->db->escape($data['defined_categories']) . "', defined_manufactures = '" . $this->db->escape($data['defined_manufactures']) . "', special = '" . $this->db->escape($data['special']) . "'");
            $data['id'] = $this->db->getLastId();
        }
        return $data['id'];
	}
	public function detail($draft_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mailsubscribe_template_draft WHERE draft_id = '" . (int)$draft_id . "'");
        $data = $query->row;

        if ($data) {
            $path = dirname(DIR_DOWNLOAD) . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR .  $data['attachments_id'];
			   if (file_exists($path)) {
					if (is_dir($path)) {
						$files = array();
						
						$path = array($path . '*');
						
						while(count($path) != 0) {
							$next = array_shift($path);
							if (is_array(glob($next))) { //// important to fix empty folder problem in attachment
								foreach(glob($next) as $file) {
									if (is_dir($file)) {
										$path[] = $file . '/*';
									}
									
									$files[] = $file;
								}
							}
						}
						rsort($files);
						array_pop($files);
						$data['attachments'] = $files;
					}
				}else {
                $data['attachments'] = array();
            }
        }
		

        $data['customer'] = unserialize($data['customer']);
        $data['affiliate'] = unserialize($data['affiliate']);
        $data['product'] = unserialize($data['product']);
        $data['defined_product'] = unserialize($data['defined_products']);
        $data['defined_product_more'] = unserialize($data['defined_products_more']);
        $data['defined_category'] = unserialize($data['defined_category']);
        $data['defined_manufacture'] = unserialize($data['defined_manufacture']);

        return $data;
    }
	
	public function getDrafts($data){
			$sql = "SELECT * FROM " . DB_PREFIX . "mailsubscribe_template_draft WHERE 1";
			
			if (isset($data['filter_date']) && !is_null($data['filter_date'])) {
                $sql .= " AND DATE(datetime) = DATE('" . $this->db->escape($data['filter_date']) . "')";
            }

            if (isset($data['filter_subject']) && !is_null($data['filter_subject'])) {
                $sql .= " AND LCASE(subject) LIKE '" . $this->db->escape(mb_strtolower($data['filter_subject'], 'UTF-8')) . "%'";
            }

            if (isset($data['filter_to']) && !is_null($data['filter_to'])) {
                $sql .= " AND `to` = '" . $this->db->escape($data['filter_to']) . "'";
            }

            if (isset($data['filter_store']) && !is_null($data['filter_store'])) {
                $sql .= " AND `store_id` = '" . (int)$data['filter_store'] . "'";
            }

            $sort_data = array(
                'draft_id',
                'subject',
                'datetime',
                'to',
                'store_id'
            );

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY `" . $data['sort'] . "`";
            } else {
                $sql .= " ORDER BY datetime";
            }

            if (isset($data['order']) && ($data['order'] == 'ASC')) {
                $sql .= " ASC";
            } else {
                $sql .= " DESC";
            }

            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }

                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }

                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }

			$query = $this->db->query($sql);
			return $query->rows;
	}
	public function getDraftsTotal($data){
			$sql = "SELECT COUNT(*) as total FROM " . DB_PREFIX . "mailsubscribe_template_draft WHERE 1";
			
			if (isset($data['filter_date']) && !is_null($data['filter_date'])) {
                $sql .= " AND DATE(datetime) = DATE('" . $this->db->escape($data['filter_date']) . "')";
            }

            if (isset($data['filter_subject']) && !is_null($data['filter_subject'])) {
                $sql .= " AND LCASE(subject) LIKE '" . $this->db->escape(mb_strtolower($data['filter_subject'], 'UTF-8')) . "%'";
            }

            if (isset($data['filter_to']) && !is_null($data['filter_to'])) {
                $sql .= " AND `to` = '" . $this->db->escape($data['filter_to']) . "'";
            }

            if (isset($data['filter_store']) && !is_null($data['filter_store'])) {
                $sql .= " AND `store_id` = '" . (int)$data['filter_store'] . "'";
				
            }
			$query = $this->db->query($sql);
			return $query->row['total'];
	}
	public function deleteDraft($draft_id){
		$query = $this->db->query("SELECT attachments_id FROM " . DB_PREFIX . "mailsubscribe_template_draft WHERE draft_id='". (int)$draft_id ."'");
		if($query->row['attachments_id']){
			$path = dirname(DIR_DOWNLOAD) . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . $query->row['attachments_id'];
			
			if (file_exists($path)) {
				
				if (is_dir($path)) {
					$files = array();
					
					$path = array($path . '*');
					
					while(count($path) != 0) {
						$next = array_shift($path);
				
						foreach(glob($next) as $file) {
							if (is_dir($file)) {
								$path[] = $file . '/*';
							}
							
							$files[] = $file;
						}
				}
				
					rsort($files);
				
					foreach ($files as $file) {
						if (is_file($file)) {
							unlink($file);
						} elseif(is_dir($file)) {
							rmdir($file);	
						} 
					}
				}
			}
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "mailsubscribe_template_draft WHERE draft_id='". (int)$draft_id ."'");
	}
	public function addHistory($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_history SET `to` = '" . $this->db->escape($data['to']) . "', public_id = '" . $this->db->escape(md5($data['subject'] . time())). "', store_id = '" . (int)$data['store_id'] . "', template_id = '" . (int)$data['template_id'] . "', language_id = '" . (int)$data['language_id'] . "', subject = '" . $this->db->escape($data['subject']) . "', message = '" . $this->db->escape($data['message']) . "', attachments_id = '" . $this->db->escape($data['attachments_id']) . "'");
        return $this->db->getLastId();
    }
	public function addQueue($data){
		 	$this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_queue SET email = '" . $this->db->escape($data['email']) . "', history_id = '" . $this->db->escape($data['history_id']) . "'");
	}
	public function addStatQueue($newsletter_id, $data) {/*addHistoryQueue()*/
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mailsubscribe_stats WHERE history_id='". (int)$newsletter_id ."'");
		
		if($query->num_rows){
			$this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_stats SET history_id = '" . (int)$newsletter_id  . "', queue = '" . (int)$data['queue'] . "', recipients = '" . (int)$data['recipients'] . "', views = '0' where stats_id='".(int)$query->row['history_id']."'");
		}else {
        	$this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_stats SET history_id = '" . (int)$newsletter_id  . "', queue = '" . (int)$data['queue'] . "', recipients = '" . (int)$data['recipients'] . "', views = '0'");	
		}
    }
	public function updateFailed($history_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_stats SET failed = failed + 1 WHERE history_id = '" . (int)$history_id . "'");
    }
	public function getTotalEmailsNewsletterModule($store_id){
		$query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "subscribe WHERE store_id = '" . (int)$store_id . "'");
		return $query->row['total'];
	}
	public function getEmailsNewsletterModule($data){
		$query = $this->db->query("SELECT email_id as email FROM " . DB_PREFIX . "subscribe WHERE store_id = '" . (int)$data['store_id'] . "' LIMIT ".(int)$data['start'] .", ".(int)$data['limit']);
		return $query->rows;
	}

}
?>