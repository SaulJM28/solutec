<?php
class Empleado extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Empleado_model");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
    }

    public function index()
    {
        $this->load->view("empleados");
    }

    public function getListEmpleados()
    {
        $datos = $this->Empleado_model->getEmpleados();
        if (!empty($datos)) {
            $response = array(
                'success' => true,
                'data' => $datos
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'No se encontraron datos con INNER JOIN.'
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
 
    public function getEmpleadoById()
    {
        $id = $this->input->post('id');
        $datos = $this->Empleado_model->getEmpleadoById($id);
        if ($datos) {
            $response = array(
                'success' => true,
                'data' => $datos
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'No se encontraron datos para el ID proporcionado.'
            );
        }
        // Establece la respuesta como JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function insertEmpleado()
    {
        $nomEmp = $this->input->post('nomEmp');
        $ap1Emp = $this->input->post('ap1Emp');
        $ap2Emp = $this->input->post('ap2Emp');
        $corrEmp = $this->input->post('corrEmp');
        $fechNacEmp = $this->input->post('fechNacEmp');
        $id_are = $this->input->post('id_are');
        $resultado = $this->Empleado_model->insertEmpleado($nomEmp, $ap1Emp, $ap2Emp, $corrEmp, $fechNacEmp, $id_are);
        // Verificar el resultado de la inserción
        if ($resultado) {
            // Preparar la respuesta en formato JSON
            $response = array(
                'success' => true,
                'message' => 'Empleado insertado correctamente.'
            );
        } else {
            // Preparar la respuesta en formato JSON para una inserción fallida
            $response = array(
                'success' => false,
                'message' => 'Error al insertar el Empleado.'
            );
        }
        // Establecer la respuesta como JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function updateEmpleado()
    {
        // Recibir los parámetros enviados desde la solicitud
        $id = $this->input->post('id');
        $nomEmp = $this->input->post('nomEmp');
        $ap1Emp = $this->input->post('ap1Emp');
        $ap2Emp = $this->input->post('ap2Emp');
        $corrEmp = $this->input->post('corrEmp');
        $fechNacEmp = $this->input->post('fechNacEmp');
        $id_are = $this->input->post('id_are');

        // Llamar a la función de actualización en el modelo
        $resultado = $this->Empleado_model->updateEmpleado($id, $nomEmp, $ap1Emp, $ap2Emp, $corrEmp, $fechNacEmp, $id_are);

        // Verificar el resultado de la actualización
        if ($resultado) {
            // Preparar la respuesta en formato JSON para una actualización exitosa
            $response = array(
                'success' => true,
                'message' => 'Area actualizado correctamente.'
            );
        } else {
            // Preparar la respuesta en formato JSON para una actualización fallida
            $response = array(
                'success' => false,
                'message' => 'Error al actualizar el Area.'
            );
        }

        // Establecer la respuesta como JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function deleteEmpleado()
    {
        // Recibir los parámetros enviados desde la solicitud
        $id = $this->input->post('id');

        // Llamar a la función de eliminación en el modelo
        $resultado = $this->Empleado_model->deleteEmpleado($id);

        // Verificar el resultado de la eliminación
        if ($resultado) {
            // Preparar la respuesta en formato JSON para una eliminación exitosa
            $response = array(
                'success' => true,
                'message' => 'Registro eliminado exitosamente'
            );
        } else {
            $error = $this->db->error();
            // Preparar la respuesta en formato JSON para una eliminación fallida
            $response = array(
                'success' => false,
                'message' => 'Error al eliminar el registro: ' . $error['message']
            );
        }

        // Establecer la respuesta como JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    } 
}
