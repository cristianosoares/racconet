<?php
class ModelMailsubscribeShow extends Model {
	public function getHistory($history_id){
		$query = $this->db->query("SELECT * FROM  " . DB_PREFIX . "mailsubscribe_history WHERE history_id='".(int)$history_id."'");
		return $query->row;
	}
	public function getTemplate($template_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mailsubscribe_template WHERE template_id ='".(int) $template_id ."'");
		return $query->row;
	}
}
?>