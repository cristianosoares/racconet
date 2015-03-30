<?php
class ModelExtensionInfoseg extends Model {
	public function addInfoseg($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "infoseg SET image = '" . $this->db->escape($data['image']) . "', date_added = NOW(), status = '" . (int)$data['status'] . "'");
	}
	
	public function editInfoseg($id_revista, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "news SET image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "' WHERE news_id = '" . (int)$id_revista . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$id_revista. "'");
		
		foreach ($data['news'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."news_description SET news_id = '" . (int)$id_revista . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$id_revista. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$id_revista . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	}
	
	public function getInfoseg($news_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id . "') AS keyword FROM " . DB_PREFIX . "news WHERE news_id = '" . (int)$news_id . "'"); 
 
		if ($query->num_rows) {
			return $query->row;
		} else {
			return false;
		}
	}
   
	public function getAllInfoseg($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "infoseg ORDER BY data DESC";
		
		if (isset($data['start']) && isset($data['limit'])) {
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
   
	public function deleteInfoseg($id_revista) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "infoseg WHERE id_revista = '" . (int)$id_revista . "'");
	}
   
	public function getTotalInfoseg() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "infoseg");
	
		return $query->row['total'];
	}
}