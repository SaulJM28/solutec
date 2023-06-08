<?php
class Area extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model( "Area_model" );
		header( "Access-Control-Allow-Origin: *" ); 
		header( "Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With" );
	}

	public function index() {
		$this->load->view( "areas" );
	}

    public function getListAreas(){
        $areas = $this->Area_model->getAreas();
        $data['data'] = $areas;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        /* $this->load->view('empleados_view', $data); */
    }

    public function getAreaById () {
        $id = $this->input->post('id');
        $datos = $this->Area_model->getAreaById($id);
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

    public function insertArea(){
        $nomArea = $this->input->post('nomArea'); 
        $numEmp = $this->input->post('numEmp');
        $resultado = $this->Area_model->insertArea($nomArea, $numEmp);
         // Verificar el resultado de la inserción
         if ($resultado) {
            // Preparar la respuesta en formato JSON
            $response = array(
                'success' => true,
                'message' => 'Area insertado correctamente.'
            );
        } else {
            // Preparar la respuesta en formato JSON para una inserción fallida
            $response = array(
                'success' => false,
                'message' => 'Error al insertar el Area.'
            );
        }
        // Establecer la respuesta como JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function updateArea() {
        // Recibir los parámetros enviados desde la solicitud
        $id = $this->input->post('id');
        $nomArea = $this->input->post('nomArea'); 
        $numEmp = $this->input->post('numEmp');
                
        // Llamar a la función de actualización en el modelo
        $resultado = $this->Area_model->updateArea($id, $nomArea, $numEmp);
        
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

    public function deleteArea() {
        // Recibir los parámetros enviados desde la solicitud
        $id = $this->input->post('id');
        
        // Llamar a la función de eliminación en el modelo
        $resultado = $this->Area_model->deleteArea($id);
        
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
