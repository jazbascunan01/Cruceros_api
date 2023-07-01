<?php

abstract class ApiController {

    private $data; 

    public function __construct() {
        $this->data = file_get_contents("php://input"); 
    }

    function getData(){ 
        return json_decode($this->data); 
    }  

}

