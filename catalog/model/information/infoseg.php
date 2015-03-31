<?php
class ModelInformationInfoseg extends Model {
	public function getAllInfoseg() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "infoseg ORDER BY sort_order ASC");

		return $query->rows;
	}
}