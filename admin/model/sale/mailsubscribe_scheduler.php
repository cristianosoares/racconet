<?php
class ModelSaleMailsubscribeScheduler extends Model {
	
	public function getSchedules($data){
		
		$sql = "SELECT * FROM " . DB_PREFIX . "mailsubscribe_template_scheduler WHERE 1 ";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND name = '" . $this->db->escape($data['filter_name']) . "'";
		}

		if (!empty($data['filter_to'])) {
			$sql .= " AND `to` = '" . $this->db->escape($data['filter_to']) . "'";
		}

		if (!empty($data['filter_active'])) {
			$sql .= " AND `active` = '" . (int)$data['filter_active'] . "'";
		}
		
		if (!empty($data['filter_recurrent'])) {
			$sql .= " AND `recurrent` = '" . (int)$data['filter_recurrent'] . "'";
		}
		
		if (!empty($data['filter_store'])) {
			$sql .= " AND store_id = '" . (int)$data['filter_store'] . "'";
		}

		$sort_data = array(
			'o.order_id',
			'customer',
			'status',
			'o.date_added',
			'o.date_modified',
			'o.total'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY schedule_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
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
	public function getSchedulesTotal($data){
		
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "mailsubscribe_template_scheduler WHERE 1 ";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND name = '" . $this->db->escape($data['filter_name']) . "'";
		}

		if (!empty($data['filter_to'])) {
			$sql .= " AND `to` = '" . $this->db->escape($data['filter_to']) . "'";
		}

		if (!empty($data['filter_active'])) {
			$sql .= " AND `active` = '" . (int)$data['filter_active'] . "'";
		}
		
		if (!empty($data['filter_recurrent'])) {
			$sql .= " AND `recurrent` = '" . (int)$data['filter_recurrent'] . "'";
		}
		
		if (!empty($data['filter_store'])) {
			$sql .= " AND store_id = '" . (int)$data['filter_store'] . "'";
		}

		
		$query = $this->db->query($sql);
		
		return $query->row['total'];	
	}
	public function deleteSchedule($schedule_id){
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "mailsubscribe_template_scheduler WHERE schedule_id='". (int)$schedule_id ."'");
	
	}
	public function getSchedule($schedule_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mailsubscribe_template_scheduler WHERE schedule_id='". (int)$schedule_id ."' ");
		return $query->row;
	}
	 public function saveSchedule($data) {
		 /*
		 `random` = '" . (int)$data['random'] . "',`random_count` = '" . ($data['random_count'] ? (int)$data['random_count'] : 8) . "',
		 remove because random products are not used later apply in both below query
		 */
		 
		 
        if (isset($data['schedule_id']) && $data['schedule_id']) {
            $this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_template_scheduler SET active = '" . (int)$data['active'] . "', `name` = '" . $this->db->escape($data['name']) . "', `date` = '" . $this->db->escape(isset($data['date']) ? $data['date'] : 0) . "', `date_next` = '" . $this->db->escape(isset($data['date_next']) ? $data['date_next'] : 0) . "', `defined_product_text` = '" . $this->db->escape($data['defined_product_text']). "', `defined_products` = '" . $this->db->escape(isset($data['defined_product']) ? serialize($data['defined_product']) : '') . "', `defined_products_more` = '" . $this->db->escape(isset($data['defined_product_more']) ? serialize($data['defined_product_more']) : '') . "', `defined_category` = '" . $this->db->escape(isset($data['defined_category']) ? serialize($data['defined_category']) : '') . "', `defined_manufacture` = '" . $this->db->escape(isset($data['defined_manufacture']) ? serialize($data['defined_manufacture']) : '') . "', `customer` = '" . $this->db->escape((isset($data['customer']) && $data['to'] == 'customer') ? serialize($data['customer']) : '') . "', `affiliate` = '" . $this->db->escape((isset($data['affiliate']) && $data['to'] == 'affiliate') ? serialize($data['affiliate']) : '') . "', `product` = '" . $this->db->escape((isset($data['product']) && $data['to'] == 'product') ? serialize($data['product']) : '') . "', `customer_group_id` = '" . (int)$data['customer_group_id'] . "', `customer_group_only_subscribers` = '" . (isset($data['customer_group_only_subscribers']) ? (int)$data['customer_group_only_subscribers'] : '0') . "', `only_selected_language` = '" . (isset($data['only_selected_language']) ? (int)$data['only_selected_language'] : '0') . "', `time` = '" . ((int)$data['recurrent'] ? (int)$data['rtime'] : (int)$data['time']) . "', `day` = '" . (int)(isset($data['day']) ? $data['day'] : 0)  . "', `frequency` = '" . (int)(isset($data['frequency']) ? $data['frequency'] : 0) . "', store_id = '" . (int)$data['store_id'] . "', language_id = '" . (int)$data['language_id'] . "', template_id = '" . (int)$data['template_id'] . "', `to` = '" . $this->db->escape($data['to']) . "', `subject` = '" . $this->db->escape($data['subject']) . "', `message` = '" . $this->db->escape($data['message']) . "',  `recurrent` = '" . (int)$data['recurrent'] . "',  `defined` = '" . (int)$data['defined'] . "', defined_categories = '" . (int)$data['defined_categories'] . "', defined_manufactures = '" . (int)$data['defined_manufactures'] . "',  special = '" . (int)$data['special'] . "', latest = '" . (int)$data['latest'] . "', popular = '" . (int)$data['popular'] . "', newsletter_id = 0 WHERE schedule_id = '" . (int)$data['schedule_id'] . "'");
        } else {
            $this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_template_scheduler SET active = '" . (int)$data['active'] . "', `name` = '" . $this->db->escape($data['name']) . "', `date` = '" . $this->db->escape(isset($data['date']) ? $data['date'] : 0) . "', `date_next` = '" . $this->db->escape(isset($data['date_next']) ? $data['date_next'] : 0) . "', `defined_product_text` = '" . $this->db->escape($data['defined_product_text']). "', `defined_products` = '" . $this->db->escape(isset($data['defined_product']) ? serialize($data['defined_product']) : '') . "', `defined_products_more` = '" . $this->db->escape(isset($data['defined_product_more']) ? serialize($data['defined_product_more']) : '') . "', `defined_category` = '" . $this->db->escape(isset($data['defined_category']) ? serialize($data['defined_category']) : '') . "', `defined_manufacture` = '" . $this->db->escape(isset($data['defined_manufacture']) ? serialize($data['defined_manufacture']) : '') . "', `customer` = '" . $this->db->escape((isset($data['customer']) && $data['to'] == 'customer') ? serialize($data['customer']) : '') . "', `affiliate` = '" . $this->db->escape((isset($data['affiliate']) && $data['to'] == 'affiliate') ? serialize($data['affiliate']) : '') . "', `product` = '" . $this->db->escape((isset($data['product']) && $data['to'] == 'product') ? serialize($data['product']) : '') . "', `customer_group_id` = '" . (int)$data['customer_group_id'] . "', `customer_group_only_subscribers` = '" . (isset($data['customer_group_only_subscribers']) ? (int)$data['customer_group_only_subscribers'] : '0') . "', `only_selected_language` = '" . (isset($data['only_selected_language']) ? (int)$data['only_selected_language'] : '0') . "', `time` = '" . ((int)$data['recurrent'] ? (int)$data['rtime'] : (int)$data['time']) . "', `day` = '" . (int)(isset($data['day']) ? $data['day'] : 0) . "', `frequency` = '" . (int)(isset($data['frequency']) ? $data['frequency'] : 0) . "', store_id = '" . (int)$data['store_id'] . "', language_id = '" . (int)$data['language_id'] . "', template_id = '" . (int)$data['template_id'] . "', `to` = '" . $this->db->escape($data['to']) . "', `subject` = '" . $this->db->escape($data['subject']) . "', `message` = '" . $this->db->escape($data['message']) . "',  `recurrent` = '" . (int)$data['recurrent'] . "',  `defined` = '" . (int)$data['defined'] . "', defined_categories = '" . (int)$data['defined_categories'] . "', defined_manufactures = '" . (int)$data['defined_manufactures'] . "',  special = '" . (int)$data['special'] . "', latest = '" . (int)$data['latest'] . "', popular = '" . (int)$data['popular'] . "', newsletter_id = 0");
            $data['schedule_id'] = $this->db->getLastId();
        }
        return $data['schedule_id'];
    }
}
?>