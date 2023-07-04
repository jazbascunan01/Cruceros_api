<?php
require_once("Models/Cruceros.Model.php");
require_once("Views/Api.View.php");
require_once("Api.Controller.php");

class CrucerosController extends ApiController
{
    public function getCruceros($params = null)
    {
        if (isset($_REQUEST['criterio'])) {
            $cruceros = $this->GetSortedCruises($_REQUEST['criterio']);
        } else {
            if (isset($_REQUEST['filtrar'])) {
                $cruceros = $this->GetFilteredCruises($_REQUEST['filtrar']);
            } else {
                if (isset($_REQUEST['pagina']) && isset($_REQUEST['filas'])) {
                    $cruceros = $this->paginate($_REQUEST['pagina'], $_REQUEST['filas']);
                    $this->view->response($cruceros, 200);
                } else {
                    $cruceros = $this->crucerosmodel->getcruceros();
                    $this->view->response($cruceros, 200);
                }
            }
        }
    }
    public function GetSortedCruises($criterio)
    {
        if ($this->verifyAttributes($criterio)) {
            if (isset($_REQUEST['orden']) && !empty($_REQUEST['orden'])) {
                $orden = $_REQUEST['orden'];
                $cruceros = $this->crucerosmodel->GetSortedCruceros($criterio, $orden);
                $this->view->response($cruceros, 200);
            } else {
                $orden = "ASC"; // se ordena ascendente por defecto
                $cruceros = $this->crucerosmodel->GetSortedCruceros($criterio, $orden);
                $this->view->response($cruceros, 200);
            }
        } else {
            return $this->view->response("Verificar la columna/atributo de la tabla elegida como criterio", 404);
        }
    }

    public function GetFilteredCruises($filtro)
    {
        if ($this->verifyAttributes($filtro) && isset($_REQUEST['valor'])) {
            $cruceros = $this->crucerosmodel->GetFilteredCruceros($filtro, $_REQUEST['valor']);
            if ($cruceros) {
                $this->view->response($cruceros, 200);
            } else {
                $this->view->response("No se encontraron cruceros filtrados", 404);
            }
        } else {
            return $this->view->response("Verificar el filtro y el valor del filtro", 400);
        }
    }

    public function paginate($pagina, $filas)
    {
        if (!empty($pagina) && !empty($filas) && $pagina > 0 && $filas > 0 && is_numeric($pagina) && is_numeric($filas)) {
            $cantidad = $this->crucerosmodel->getTotalRecords();
            if ($pagina <= $cantidad / $filas) {
                $inicio = $filas * ($pagina - 1);
                $cruceros = $this->crucerosmodel->getPaginatedCruceros($inicio, $filas);
                return $cruceros;
            } else {
                return $this->view->response("La página solicitada con esa cantidad de filas no contiene elementos", 404);
            }
        } else {
            return $this->view->response("Verificar la forma de los parámetros utilizados", 404);
        }
    }

    public function verifyAttributes($filtro)
    {
        $atributos = $this->crucerosmodel->obtenerColumnas();
        return (in_array($filtro, array_column($atributos, 'column_name')));
    }



    public function getCrucero($params = null)
    {
        $id = $params[':ID'];

        $crucero = $this->crucerosmodel->getCrucero($id);
        if ($crucero)
            $this->view->response($crucero, 200);
        else
            $this->view->response("El crucero con el id={$id} no existe", 404);
    }

    public function addCrucero($params = [])
    {
        $crucero = $this->getData(); // la obtengo del body
        // inserta el crucero
        $crucero_id = $this->crucerosmodel->save($crucero->nombre, $crucero->compania, $crucero->capacidad, $crucero->origen, $crucero->img1, $crucero->img2, $crucero->descripcion, $crucero->detalles);

        // obtengo el crucero recien creado
        $cruceroNuevo = $this->crucerosmodel->getCrucero($crucero_id);

        if ($cruceroNuevo)
            $this->view->response($cruceroNuevo, 200);
        else
            $this->view->response("Error al insertar crucero", 500);

    }

    public function deleteCrucero($params = null)
    {
        $id = $params[':ID'];
        $crucero = $this->crucerosmodel->getCrucero($id);
        if ($crucero) {
            $this->crucerosmodel->delete($id);
            $this->view->response("El crucero fue borrado con exito.", 200);
        } else
            $this->view->response("El crucero con el id={$id} no existe", 404);
    }

    public function updateCrucero($params = [])
    {
        $crucero_id = $params[':ID'];
        $crucero = $this->crucerosmodel->getCrucero($crucero_id);

        if ($crucero) {
            $body = $this->getData();

            $nombre = $body->nombre;
            $compania = $body->compania;
            $capacidad = $body->capacidad;
            $origen = $body->origen;
            $img1 = $body->img1;
            $img2 = $body->img2;
            $descripcion = $body->descripcion;
            $detalles = $body->detalles;
            $crucero = $this->crucerosmodel->ActualizarCrucero($crucero_id, $nombre, $compania, $capacidad, $origen, $img1, $img2, $descripcion, $detalles);
            $this->view->response("Crucero id=$crucero_id actualizado con éxito", 200);
        } else
            $this->view->response("Crucero id=$crucero_id not found", 404);
    }

}