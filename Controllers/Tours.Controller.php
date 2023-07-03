<?php
require_once("Models/Tours.Model.php");
require_once("Views/Tours.View.php");
require_once("Api.Controller.php");

class ToursController extends ApiController
{

    public function getTours($params = null)
    {
        if (isset($_REQUEST['criterio'])) {
            $tours = $this->GetSortedTours($_REQUEST['criterio']);
        } else {
            if (isset($_REQUEST['filtrar'])) {
                $tours = $this->GetFilteredTours($_REQUEST['filtrar']);
            } else {
                if (isset($_REQUEST['pagina']) && isset($_REQUEST['filas'])) {
                    $tours = $this->paginate($_REQUEST['pagina'], $_REQUEST['filas']);
                    $this->toursview->response($tours, 200);
                } else {
                    $tours = $this->toursmodel->getAllTours();
                    $this->toursview->response($tours, 200);
                }
            }
        }
    }

    public function GetSortedTours($criterio)
    {
        if ($this->verifyAttributes($criterio)) {
            if (isset($_REQUEST['orden']) && !empty($_REQUEST['orden'])) {
                $orden = $_REQUEST['orden'];
                $tours = $this->toursmodel->GetSortedTours($criterio, $orden);
                $this->toursview->response($tours, 200);
            } else {
                $orden = "ASC"; // se ordena ascendente por defecto
                $tours = $this->toursmodel->GetSortedTours($criterio, $orden);
                $this->toursview->response($tours, 200);
            }
        } else {
            return $this->toursview->response("Verificar la columna/atributo de la tabla elegida como criterio", 404);
        }
    }

    public function GetFilteredTours($filtro)
    {
        if ($this->verifyAttributes($filtro) && isset($_REQUEST['valor'])) {
            $tours = $this->toursmodel->GetFilteredTours($filtro, $_REQUEST['valor']);
            if ($tours) {
                $this->toursview->response($tours, 200);
            } else {
                $this->toursview->response("No se encontraron tours filtrados", 404);
            }
        } else {
            return $this->toursview->response("Verificar el filtro y el valor del filtro", 400);
        }
    }

    public function paginate($pagina, $filas)
    {
        if (!empty($pagina) && !empty($filas) && $pagina > 0 && $filas > 0 && is_numeric($pagina) && is_numeric($filas)) {
            $cantidad = $this->toursmodel->getTotalRecords();
            if ($pagina <= $cantidad / $filas) {
                $inicio = $filas * ($pagina - 1);
                $tours = $this->toursmodel->getPaginatedTours($inicio, $filas);
                echo("HOLA");
                return $tours;
            } else {
                return $this->toursview->response("La página solicitada con esa cantidad de filas no contiene elementos", 404);
            }
        } else {
            return $this->toursview->response("Verificar la forma de los parámetros utilizados", 404);
        }
    }

    public function verifyAttributes($filtro)
    {
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