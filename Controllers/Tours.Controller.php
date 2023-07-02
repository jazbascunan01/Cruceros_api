<?php
require_once("Models/Tours.Model.php");
require_once("Views/Tours.View.php");
require_once("Api.Controller.php");

class ToursController extends ApiController
{

    public function getTours($params = null)
    {
        if (isset($_REQUEST['criterio'])){
            $tours = $this->GetSortedTours($_REQUEST['criterio']); 
        }else{
        $tours = $this->toursmodel->getAllTours();
        $this->toursview->response($tours, 200);
        }
    }

    public function GetSortedTours($criterio)
    {
        if ($this->verificarAtributos($criterio)) {
            if (isset($_REQUEST['orden']) && !empty($_REQUEST['orden'])) {
                $orden = $_REQUEST['orden'];
                $tours= $this->toursmodel->GetSortedTours($criterio, $orden);
                $this->toursview->response($tours, 200);
            } else {
                $orden = "ASC"; // se ordena ascendente por defecto
                $tours= $this->toursmodel->GetSortedTours($criterio, $orden);
                $this->toursview->response($tours, 200);
            }
        } else {
            return $this->toursview->response("Verificar la columna/atributo de la tabla elegida como criterio", 404);
        }
    }
    
    public function verificarAtributos($filtro){
        $atributos = $this->toursmodel->obtenerColumnas();
        return (in_array($filtro, array_column($atributos, 'column_name')));
    }


    public function getTour($params = null)
    {
        $id = $params[':ID'];

        $tour = $this->toursmodel->getTour($id);
        if ($tour)
            $this->toursview->response($tour, 200);
        else
            $this->toursview->response("El tour con el id={$id} no existe", 404);
    }

    public function deleteTour($params = null)
    {
        $id = $params[':ID'];
        $tour = $this->toursmodel->getTour($id);
        if ($tour) {
            $this->toursmodel->delete($id);
            $this->toursview->response("El tour fue borrado con exito.", 200);
        } else
            $this->toursview->response("El tour con el id={$id} no existe", 404);
    }

    public function addTour($params = [])
    {
        $tour = $this->getData(); // la obtengo del body

        // inserta el tour
        $tour_id = $this->toursmodel->save($tour->id_crucero, $tour->destino, $tour->fecha_salida, $tour->precio, $tour->descripcion, $tour->img1, $tour->img2, $tour->detalles);

        // obtengo el tour recien creada
        $tourNuevo = $this->toursmodel->getTour($tour_id);

        if ($tourNuevo)
            $this->toursview->response($tourNuevo, 200);
        else
            $this->toursview->response("Error al insertar tour", 500);

    }


    public function updateTour($params = [])
    {
        $tour_id = $params[':ID'];
        $tour = $this->toursmodel->getTour($tour_id);

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
            $tour = $this->toursmodel->ActualizarTour($tour_id, $id_crucero, $destino, $fecha_salida, $precio, $descripcion, $img1, $img2, $detalles);
            $this->toursview->response("Tour id=$tour_id actualizado con éxito", 200);
        } else
            $this->toursview->response("Tour id=$tour_id not found", 404);
    }

}