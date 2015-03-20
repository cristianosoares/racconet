<?php 
class ModelMailsubscribeCron extends Model {
	public function get_scheduled($date, $time, $day){
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "mailsubscribe_template_scheduler WHERE (`active` = 1 AND `time` = '" . (int)$time . "') AND ((`recurrent` = '0' AND `date` = '" . $this->db->escape($date) . "' AND `date_next` = '0000-00-00') OR (`recurrent` = '1' AND `frequency` = '1' AND (`date_next` = '0000-00-00' OR `date_next` = '" . $this->db->escape($date) . "')) OR (`recurrent` = '1' AND (`frequency` = '7' OR `frequency` = '30') AND `day` = '" . (int)$day . "' AND (`date_next` = '0000-00-00' OR `date_next` = '" . $this->db->escape($date) . "'))) ORDER BY schedule_id ASC");
		return $query->rows;
	}
	public function getStore($store_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "store WHERE store_id = '" . (int)$store_id . "'");

        return $query->row;
    }
	public function getCustomers($data = array()) {
		
		$sql = "SELECT *, CONCAT(c.firstname, ' ', c.lastname) AS name, cgd.name AS customer_group FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) WHERE cgd.language_id = '" . (int)$data['language_id'] . "'";
		
		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "c.email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
			$implode[] = "c.newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}	

		if (!empty($data['filter_customer_group_id'])) {
			$implode[] = "c.customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
		}	

		if (!empty($data['filter_ip'])) {
			$implode[] = "c.customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
		}	

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
		}	

		if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
			$implode[] = "c.approved = '" . (int)$data['filter_approved'] . "'";
		}	

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'name',
			'c.email',
			'customer_group',
			'c.status',
			'c.approved',
			'c.ip',
			'c.date_added'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY name";	
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
	public function getTotalCustomers($data = array()) {
      	$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer";
		
		$implode = array();
		
		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_email'])) {
			$implode[] = "email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}
		
		if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
			$implode[] = "newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}
				
		if (!empty($data['filter_customer_group_id'])) {
			$implode[] = "customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
		}	
		
		if (!empty($data['filter_ip'])) {
			$implode[] = "customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
		}	
						
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "status = '" . (int)$data['filter_status'] . "'";
		}			
		
		if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
			$implode[] = "approved = '" . (int)$data['filter_approved'] . "'";
		}		
				
		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}
		
		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}
				
		$query = $this->db->query($sql);
				
		return $query->row['total'];
	}
	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}
	public function getAffiliates($data = array()) {
		$sql = "SELECT *, CONCAT(a.firstname, ' ', a.lastname) AS name, (SELECT SUM(at.amount) FROM " . DB_PREFIX . "affiliate_transaction at WHERE at.affiliate_id = a.affiliate_id GROUP BY at.affiliate_id) AS balance FROM " . DB_PREFIX . "affiliate a";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(a.firstname, ' ', a.lastname) LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "LCASE(a.email) = '" . $this->db->escape(utf8_strtolower($data['filter_email'])) . "'";
		}

		if (!empty($data['filter_code'])) {
			$implode[] = "a.code = '" . $this->db->escape($data['filter_code']) . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "a.status = '" . (int)$data['filter_status'] . "'";
		}	

		if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
			$implode[] = "a.approved = '" . (int)$data['filter_approved'] . "'";
		}		

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(a.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'name',
			'a.email',
			'a.code',
			'a.status',
			'a.approved',
			'a.date_added'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY name";	
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
	public function getTotalAffiliates($data = array()) {
      	$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "affiliate";
		
		$implode = array();
		
		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_email'])) {
			$implode[] = "LCASE(email) = '" . $this->db->escape(utf8_strtolower($data['filter_email'])) . "'";
		}	
				
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "status = '" . (int)$data['filter_status'] . "'";
		}			
		
		if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
			$implode[] = "approved = '" . (int)$data['filter_approved'] . "'";
		}		
				
		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}
		
		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}
				
		$query = $this->db->query($sql);
				
		return $query->row['total'];
	}
	public function getAffiliate($affiliate_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "affiliate WHERE affiliate_id = '" . (int)$affiliate_id . "'");

		return $query->row;
	}
	public function getEmailsByProductsOrdered($products, $start, $end) {
		$implode = array();

		foreach ($products as $product_id) {
			$implode[] = "op.product_id = '" . (int)$product_id . "'";
		}

		$query = $this->db->query("SELECT DISTINCT email FROM `" . DB_PREFIX . "order` o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) WHERE (" . implode(" OR ", $implode) . ") AND o.order_status_id <> '0' LIMIT " . (int)$start . "," . (int)$end);

		return $query->rows;
	}
	public function schedule_next($schedule_id, $date) {
        $this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_template_scheduler SET date_next = '" . $this->db->escape($date) . "' WHERE schedule_id = '" . (int)$schedule_id . "'");
    }

    public function schedule_inactive($schedule_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_template_scheduler SET `active` = '0' WHERE schedule_id = '" . (int)$schedule_id . "'");
    }
	public function getTemplate($template_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mailsubscribe_template WHERE template_id ='".(int) $template_id ."'");
		return $query->row;
	}
	public function addHistory($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_history SET `to` = '" . $this->db->escape($data['to']) . "', public_id = '" . $this->db->escape(md5($data['subject'] . time())). "', store_id = '" . (int)$data['store_id'] . "', template_id = '" . (int)$data['template_id'] . "', language_id = '" . (int)$data['language_id'] . "', subject = '" . $this->db->escape($data['subject']) . "', message = '" . $this->db->escape($data['message']) . "', attachments_id = '" . $this->db->escape($data['attachments_id']) . "'");
        return $this->db->getLastId();
    }
	public function addQueue($data){
		 	$this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_queue SET email = '" . $this->db->escape($data['email']) . "', history_id = '" . $this->db->escape($data['history_id']) . "'");
	}
	public function addStatQueue($newsletter_id, $data) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mailsubscribe_stats WHERE history_id='". (int)$newsletter_id ."'");
		
		if($query->num_rows){
			$this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_stats SET history_id = '" . (int)$newsletter_id  . "', queue = '" . (int)$data['queue'] . "', recipients = '" . (int)$data['recipients'] . "', views = '0' where stats_id='".(int)$query->row['history_id']."'");
		}else {
        	$this->db->query("INSERT INTO " . DB_PREFIX . "mailsubscribe_stats SET history_id = '" . (int)$newsletter_id  . "', queue = '" . (int)$data['queue'] . "', recipients = '" . (int)$data['recipients'] . "', views = '0'");
		
		}
    }
	public function updateSchedularNewsletterID($newsletter_id,$schedule_id){
		$this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_template_scheduler SET newsletter_id = '" . (int)$newsletter_id . "' WHERE schedule_id='".(int)$schedule_id."' ");
	}
	public function get_queue() {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "mailsubscribe_queue WHERE `locked` = '0' ORDER BY queue_id ASC LIMIT 0, " . (int)$this->config->get('mailsubscribe_throttle_count'));
        return $query->rows;
    }
	public function get_newsletter($history_id) {
        $query = $this->db->query("SELECT h.history_id as history_id, `subject`, `message`, `store_id`, `template_id`, `language_id`, `to`, `datetime`, `store_id`, `queue`, `recipients`, `views` FROM " . DB_PREFIX . "mailsubscribe_stats as s LEFT JOIN " . DB_PREFIX . "mailsubscribe_history as h ON (s.history_id = h.history_id) WHERE h.history_id = '" . (int)$history_id . "'");
        return $query->row;
    }
	public function updateLocked($queue_id){
		$this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_queue SET  retries = retries + 1, `locked` = '1' WHERE queue_id = '" . (int)$queue_id . "'");
		
	}
	public function updateRetries($queue_id){
		$this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_queue SET  retries = retries + 1 WHERE queue_id = '" . (int)$queue_id . "'");
	}
	public function removeQueue($queue_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "mailsubscribe_queue WHERE queue_id = '" . (int)$queue_id . "'");
    }
	public function updateStat($history_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_stats SET queue = queue + 1 WHERE history_id = '" . (int)$history_id . "'");
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