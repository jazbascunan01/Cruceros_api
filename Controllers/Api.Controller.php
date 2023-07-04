<?php

abstract class ApiController {
    protected $toursmodel;
    protected $crucerosmodel;
    protected $usuariosmodel;
    protected $view;
    private $data; 

    public function __construct() {
        $this->data = file_get_contents("php://input"); 
        $this->toursmodel = new ToursModel();
        $this->crucerosmodel = new CrucerosModel();
        $this -> view = new ApiView();
        $this -> usuariosmodel = new UsuariosModel();
    }
    function getData(){ 
        return json_decode($this->data); 
    }  

}

