<?php
require_once("Models/Cruceros.Model.php");
require_once("Views/Cruceros.View.php");
require_once("Api.Controller.php");

class CrucerosController extends ApiController
{
    public function getCruceros($params = null)
    {
        $cruceros = $this->crucerosmodel->getCruceros();
        $this->crucerosview->response($cruceros, 200);
    }

    public function getCrucero($params = null)
    {
        $id = $params[':ID'];

        $crucero = $this->crucerosmodel->getCrucero($id);
        if ($crucero)
            $this->crucerosview->response($crucero, 200);
        else
            $this->crucerosview->response("El crucero con el id={$id} no existe", 404);
    }

    public function addCrucero($params = [])
    {
        $crucero = $this->getData(); // la obtengo del body
        // inserta el crucero
        $crucero_id = $this->crucerosmodel->save($crucero->nombre, $crucero->compania, $crucero->capacidad, $crucero->origen, $crucero->img1, $crucero->img2,  $crucero->descripcion, $crucero->detalles);

        // obtengo el crucero recien creado
        $cruceroNuevo = $this->crucerosmodel->getCrucero($crucero_id);

        if ($cruceroNuevo)
            $this->crucerosview->response($cruceroNuevo, 200);
        else
            $this->crucerosview->response("Error al insertar crucero", 500);

    }

    public function deleteCrucero($params = null)
    {
        $id = $params[':ID'];
        $crucero = $this->crucerosmodel->getCrucero($id);
        if ($crucero) {
            $this->crucerosmodel->delete($id);
            $this->crucerosview->response("El crucero fue borrado con exito.", 200);
        } else
            $this->crucerosview->response("El crucero con el id={$id} no existe", 404);
    }

    public function updateCrucero($params = [])
    {
        $crucero_id = $params[':ID'];
        $crucero = $this->crucerosmodel->getCrucero($crucero_id);

        if ($crucero) {
            $body = $this->getData();

            $nombre= $body->nombre;
            $compania= $body->compania;
            $capacidad= $body->capacidad;
            $origen= $body->origen;
            $img1= $body->img1;
            $img2= $body->img2;
            $descripcion= $body->descripcion;
            $detalles= $body->detalles;
            $crucero = $this->crucerosmodel->ActualizarCrucero($crucero_id, $nombre, $compania, $capacidad, $origen, $img1, $img2, $descripcion, $detalles);
            $this->crucerosview->response("Crucero id=$crucero_id actualizado con éxito", 200);
        } else
            $this->crucerosview->response("Crucero id=$crucero_id not found", 404);
    }

}