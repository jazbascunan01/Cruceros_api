<?php

class ToursModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=turismo_maritimo;charset=utf8', 'root', '');
    }

    /**
     * Obtiene la lista de tours.
     */
    public function getAllTours() {
        $query = $this->db->prepare('SELECT * FROM tours');
        $query->execute();
        $tours = $query->fetchAll(PDO::FETCH_OBJ);
        return $tours;
    }

    
    /**
     * Retorna un tour según el id pasado.
     */
    public function getTour($id) {
        $query = $this->db->prepare('SELECT * FROM tours WHERE ID = ?');
        $query->execute([$id]);
        return $query->fetchAll();
    }

    /**
     * Guarda un tour en la base de datos.
     */
    function save($id_crucero, $destino, $fecha_salida, $precio, $descripcion, $img1, $img2, $detalles)
    {
        $destino_final = 'images/' . uniqid() . '.jpg';
        $destino_final2 = 'images/' . uniqid() . '.jpg';
        move_uploaded_file($img1, $destino_final);
        move_uploaded_file($img2, $destino_final2);
        $query = $this->db->prepare('INSERT INTO tours (id_crucero, destino, fecha_salida, precio, descripcion, img1, img2, detalles) VALUES (?, ?, ?, ?, ?, ?, ?,?)');
        $query->execute([$id_crucero, $destino, $fecha_salida, $precio, $descripcion, $destino_final,$destino_final2, $detalles]);
        return $this->db->lastInsertId();
    }

    private function uploadImage($image){
        $target = "img/task/" . uniqid() . "." . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));  
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }
 
    /**
     * Elimina un tour de la BBDD según el id pasado.
     */
    function delete($idTour) {
        $query = $this->db->prepare('DELETE FROM tours WHERE ID = ?');
        $query->execute([$idTour]); 
    }

    /**
     * Actualiza el tour.
    */

     public function ActualizarTour($tour_id,$id_crucero, $destino, $fecha_salida, $precio, $descripcion, $img1, $img2, $detalles){
        $sentencia =  $this->db->prepare("UPDATE tours SET id_crucero=?, destino=?, fecha_salida=?, precio=?, descripcion=?, img1=?, img2=?, detalles=? WHERE ID=?");
        return $sentencia->execute(array($id_crucero, $destino, $fecha_salida, $precio, $descripcion, $img1, $img2, $detalles, $tour_id));
    }


}
