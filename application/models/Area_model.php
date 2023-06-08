<?php
class Area_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getAreas()
	{
		$query = $this->db->get('areas');
		return $query->result();
	}

	public function getAreaById($id)
	{
		$query = $this->db->get_where('areas', array('id_are' => $id));
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	public function insertArea($nomArea, $numEmp)
	{
		$data = array(
			'id_are' => null,
			'nom_are' => $nomArea,
			'num_emp' => $numEmp
		);
		return $this->db->insert('areas', $data);
	}

	public function updateArea($id, $nomArea, $numEmp)
	{
		$data = array(
			'nom_are' => $nomArea,
			'num_emp' => $numEmp
		);
		$this->db->where('id_are', $id);
		$this->db->update('areas', $data);

		return $this->db->affected_rows() > 0;
	}

	public function deleteArea($id)
	{
		$this->db->where('id_are', $id);
		$this->db->delete('areas');

		return $this->db->affected_rows() > 0;
	}
}
