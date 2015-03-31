<?php
class ModelCatalogInfoseg extends Model {
	public function addInfoseg($data) {
                
                $this->event->trigger('pre.admin.infoseg.add', $data);
		
                $this->db->query("INSERT INTO " . DB_PREFIX . "infoseg SET name = '" . $this->db->escape($data['name']) . "', edicao = '" . (int)$data['edicao'] . "', filename = '" . $this->db->escape($data['filename']) . "', data = '" . $data['data'] . "', id_issuu = '" . $this->db->escape($data['id_issuu']) . "', cod_revista = '" . $this->db->escape($data['cod_revista']) . "', sort_order = '" . (int)$data['sort_order'] . "'");
                
                $id_revista = $this->db->getLastId();
                
                //var_dump($id_revista);die;
                
                if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "infoseg SET image = '" . $this->db->escape($data['image']) . "' WHERE id_revista = '" . (int)$id_revista . "'");
		} 
                
                $this->event->trigger('post.admin.infoseg.add', $id_revista);

		return $id_revista;
        }

	public function editInfoseg($id_revista, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "infoseg SET name = '" . $this->db->escape($data['name']) . "', edicao = '" . (int)$data['edicao'] . "', filename = '" . $this->db->escape($data['filename']) . "', data = '" . date($data['data']) . "', id_issuu = '" . $this->db->escape($data['id_issuu']) . "', cod_revista = '" . $this->db->escape($data['cod_revista']) . "', sort_order = '" . (int)$data['sort_order'] . "'WHERE id_revista = '" . (int)$id_revista . "'");
                
                if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "infoseg SET image = '" . $this->db->escape($data['image']) . "' WHERE id_revista = '" . (int)$id_revista . "'");
		} 
	}

	public function deleteInfoseg($id_revista) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "infoseg WHERE id_revista = '" . (int)$id_revista . "'");

	}

	public function getInfoseg($id_revista) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "infoseg WHERE id_revista = '" . (int)$id_revista . "'");

		return $query->row;
	}

	public function getInfosegs($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "infoseg";

		if (!empty($data['filter_name'])) {
			$sql .= " WHERE nome LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'name',
			'sort_order'
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

	public function getTotalInfosegs() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "infoseg");

		return $query->row['total'];
	}
}