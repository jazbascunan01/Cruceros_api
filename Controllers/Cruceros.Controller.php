<?php
require_once("Models/Cruceros.Model.php");
require_once("Views/Cruceros.View.php");
require_once("Api.Controller.php");

class CrucerosController extends ApiController
{
    protected $model;
    protected $view;
    public function __construct()
    {
        $this->view = new CrucerosView();
        $this->model = new CrucerosModel();
    }
    public function getCruceros($params = null)
    {
        $cruceros = $this->model->getCruceros();
        $this->view->response($cruceros, 200);
    }

}