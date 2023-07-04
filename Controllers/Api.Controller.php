<?php

abstract class ApiController {
    protected $toursmodel;
    protected $toursview;

    protected $crucerosmodel;
    protected $crucerosview;
    protected $usuariosmodel;
    protected $usuariosview;
    private $data; 

    public function __construct() {
        $this->toursview = new ToursView();
        $this->crucerosview = new CrucerosView();
        $this->data = file_get_contents("php://input"); 
        $this->toursmodel = new ToursModel();
        $this->crucerosmodel = new CrucerosModel();
        $this -> usuariosview = new UsuariosView();
        $this -> usuariosmodel = new UsuariosModel();
    }
    function getData(){ 
        return json_decode($this->data); 
    }  

}

