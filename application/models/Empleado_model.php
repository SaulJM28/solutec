<?php
class Empleado_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getEmpleados()
	{
        $this->db->select('empleados.id_emp, empleados.nom, empleados.ap1, empleados.ap2, empleados.correo, empleados.fecha_nac, areas.nom_are');
        $this->db->from('empleados');
        $this->db->join('areas', 'empleados.id_are = areas.id_are', 'INNER JOIN');
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return;
        }
	}

	public function getEmpleadoById($id)
	{
		$query = $this->db->get_where('empleados', array('id_emp' => $id));
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	public function insertEmpleado($nomEmp, $ap1Emp, $ap2Emp, $corrEmp, $fechNacEmp, $id_are)
	{
		$data = array(
			'id_emp' => null,
			'nom' => $nomEmp,
			'ap1' => $ap1Emp,
			'ap2' => $ap2Emp,
			'correo' => $corrEmp,
			'fecha_nac' => $fechNacEmp,
			'id_are' => $id_are
		);
		return $this->db->insert('empleados', $data);
	}

	public function updateEmpleado($id, $nomEmp, $ap1Emp, $ap2Emp, $corrEmp, $fechNacEmp, $id_are)
	{
		$data = array(
            'nom' => $nomEmp,
			'ap1' => $ap1Emp,
			'ap2' => $ap2Emp,
			'correo' => $corrEmp,
			'fecha_nac' => $fechNacEmp,
			'id_are' => $id_are
		);
		$this->db->where('id_emp', $id);
		$this->db->update('empleados', $data);

		return $this->db->affected_rows() > 0;
	}

	public function deleteEmpleado($id)
	{
		$this->db->where('id_emp', $id);
		$this->db->delete('empleados');

		return $this->db->affected_rows() > 0;
	} 
}
