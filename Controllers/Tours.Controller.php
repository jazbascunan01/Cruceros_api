<?php
require_once("Models/Tours.Model.php");
require_once("Views/Tours.View.php");

class ToursController {

    private $model;
    private $view;
    private $data; 

    public function __construct() {
        $this->model = new ToursModel();
        $this->view = new ToursView();
        $this->data = file_get_contents("php://input"); 
    }

public function getTours($params = null) {
    $tours = $this->model->getAllTours();
    $this->view->response($tours, 200);
}



    public function getTour($params = null) {
        $id = $params[':ID'];
        
        $tour = $this->model->getTour($id);        
        if ($tour)
            $this->view->response($tour, 200);
        else
            $this->view->response("El tour con el id={$id} no existe", 404);
    } 

    public function deleteTour($params = null) {
        $id = $params[':ID'];
        $tour = $this->model->getTour($id);
        if ($tour) {
            $this->model->delete($id);
            $this->view->response("El tour fue borrado con exito.", 200);
        } else
            $this->view->response("El tour con el id={$id} no existe", 404);
    }

    public function addTour($params = []) {     
        $tour = $this->getData(); // la obtengo del body

        // inserta la tarea
        $tour_id = $this->model->save($tour->id_crucero, $tour->destino, $tour->fecha_salida, $tour->precio, $tour->descripcion, $tour->img1, $tour->img2, $tour->detalles);

        // obtengo la recien creada
        $tourNuevo = $this->model->getTour($tour_id);
        
        if ($tourNuevo)
            $this->view->response($tourNuevo, 200);
        else
            $this->view->response("Error al insertar tour", 500);

    }
    function getData(){ 
        return json_decode($this->data); 
    } 



    public function updateTour($params = []) {
        $tour_id = $params[':ID'];
        $tour = $this->model->getTour($tour_id);

        if ($tour) {
            $body = $this->getData();

            $id_crucero = $body->id_crucero;
            $destino = $body->destino;
            $fecha_salida = $body->fecha_salida;
            $precio = $body->precio;
            $descripcion = $body->descripcion;
            $img1 = $body->img1;
            $img2 = $body->img2;
            $detalles = $body->detalles;
            $tour = $this->model->ActualizarTour($tour_id,$id_crucero, $destino, $fecha_salida, $precio, $descripcion, $img1, $img2, $detalles);
            $this->view->response("Tour id=$tour_id actualizado con éxito", 200);
        }
        else 
            $this->view->response("Tour id=$tour_id not found", 404);
    }

}
