<?php
class ModelMailsubscribeClick extends Model {
	public function unsubscribe($email,$store_id){
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET `newsletter` = '0' WHERE email = '" . $this->db->escape($email) . "' AND store_id = '". (int)$store_id ."'");
		if($this->config->get('option_unsubscribe')){
			$this->db->query("DELETE FROM " . DB_PREFIX . "subscribe WHERE email_id = '" . $this->db->escape($email) . "' AND store_id = '". (int)$store_id ."'");
		}
	}
	public function updateStat($history_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "mailsubscribe_stats SET views = views + 1 WHERE history_id = '" . (int)$history_id . "'");
    }
}
?>