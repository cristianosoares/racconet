<?php 
class ModelSaleMailsubscribeHistoryStat extends Model {
	public function getHistory($data){
		$sql ="SELECT mh.history_id, DATE(mh.datetime) AS datetime, mh.subject, mh.store_id, ms.queue, ms.recipients, ms.views,ms.failed FROM ". DB_PREFIX ."mailsubscribe_history mh LEFT JOIN ". DB_PREFIX ."mailsubscribe_stats ms ON (ms.history_id = mh.history_id) WHERE 1" ;
		
	 	if(isset($data['filter_date']) && !is_null($data['filter_date'])) {
			$sql .= " AND DATE(mh.datetime) = DATE('" . $this->db->escape($data['filter_date']) . "')";
		}

		if (isset($data['filter_subject']) && !is_null($data['filter_subject'])) {
			$sql .= " AND LCASE(mh.subject) LIKE '" . $this->db->escape(mb_strtolower($data['filter_subject'], 'UTF-8')) . "%'";
		}

		if (isset($data['filter_store']) && !is_null($data['filter_store'])) {
			$sql .= " AND mh.store_id = '" . (int)$data['filter_store'] . "'";
		}
	
		
		$sort_data = array(
			'mh.history_id',
			'mh.subject',
			'mh.datetime',
			'ms.queue',
			'ms.views',
			'mh.store_id'
		);
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY mh.datetime";
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
	public function getHistoryTotal($data){
	
		$sql ="SELECT COUNT(*) AS total FROM ". DB_PREFIX ."mailsubscribe_history mh LEFT JOIN ". DB_PREFIX ."mailsubscribe_stats ms ON (ms.history_id = mh.history_id) WHERE 1" ;
		
	 	if(isset($data['filter_date']) && !is_null($data['filter_date'])) {
			$sql .= " AND DATE(mh.datetime) = DATE('" . $this->db->escape($data['filter_date']) . "')";
		}

		if (isset($data['filter_subject']) && !is_null($data['filter_subject'])) {
			$sql .= " AND LCASE(mh.subject) LIKE '" . $this->db->escape(mb_strtolower($data['filter_subject'], 'UTF-8')) . "%'";
		}

		if (isset($data['filter_store']) && !is_null($data['filter_store'])) {
			$sql .= " AND mh.store_id = '" . (int)$data['filter_store'] . "'";
		}
		
		$query = $this->db->query($sql);
		return $query->row['total'];	
		
		
	}
	public function deleteHistory($history_id){
		$this->db->query("DELETE FROM ". DB_PREFIX ."mailsubscribe_history WHERE history_id='".(int)$history_id."'");
		$this->db->query("DELETE FROM ". DB_PREFIX ."mailsubscribe_stats WHERE history_id='".(int)$history_id."'");
		$this->db->query("DELETE FROM ". DB_PREFIX ."mailsubscribe_queue WHERE history_id='".(int)$history_id."'");
	}
	
	
}
?>