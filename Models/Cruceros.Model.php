<?php

class CrucerosModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=turismo_maritimo;charset=utf8', 'root', '');
    }
    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Obtiene la lista de cruceros. |
     *-------------------------------*/
    function getcruceros()
    {
        $query = $this->db->prepare('SELECT * FROM cruceros');
        $query->execute();
        $cruceros = $query->fetchAll(PDO::FETCH_OBJ);
        return $cruceros;
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Retorna un crucero según el id pasado. |
     *----------------------------------------*/
    public function getCrucero($id)
    {
        $query = $this->db->prepare('SELECT * FROM cruceros WHERE ID = ?');
        $query->execute([$id]);
        return $query->fetchAll();
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Guarda un crucero en la base de datos. |
     *----------------------------------------*/
    function save($nombre, $compania, $capacidad, $origen, $img1, $img2, $descripcion, $detalles)
    {
        $query = $this->db->prepare('INSERT INTO cruceros(nombre, compania, capacidad, origen, img1, img2, descripcion, detalles) VALUES(?,?,?,?,?,?,?,?)');
        $query->execute([$nombre, $compania, $capacidad, $origen, $img1, $img2, $descripcion, $detalles]);
        return $this->db->lastInsertId();
    }
    private function uploadImage($image)
    {
        $target = "img/task/" . uniqid() . "." . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }
}