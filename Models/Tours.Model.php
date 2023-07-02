<?php

class ToursModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=turismo_maritimo;charset=utf8', 'root', '');
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Obtiene la lista de tours. |
     *----------------------------*/
    public function getAllTours()
    {
        $query = $this->db->prepare('SELECT * FROM tours');
        $query->execute();
        $tours = $query->fetchAll(PDO::FETCH_OBJ);
        return $tours;
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Retorna un tour según el id pasado. |
     *-------------------------------------*/
    public function getTour($id)
    {
        $query = $this->db->prepare('SELECT * FROM tours WHERE ID = ?');
        $query->execute([$id]);
        return $query->fetchAll();
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Guarda un tour en la base de datos. |
     *-------------------------------------*/
    function save($id_crucero, $destino, $fecha_salida, $precio, $descripcion, $img1, $img2, $detalles)
    {
        $query = $this->db->prepare('INSERT INTO tours (id_crucero, destino, fecha_salida, precio, descripcion, img1, img2, detalles) VALUES (?, ?, ?, ?, ?, ?, ?,?)');
        $query->execute([$id_crucero, $destino, $fecha_salida, $precio, $descripcion, $img1, $img2, $detalles]);
        return $this->db->lastInsertId();
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Elimina un tour de la BBDD según el id pasado. |
     *------------------------------------------------*/
    function delete($idTour)
    {
        $query = $this->db->prepare('DELETE FROM tours WHERE ID = ?');
        $query->execute([$idTour]);
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Actualiza el tour. |
     *--------------------*/
    public function ActualizarTour($tour_id, $id_crucero, $destino, $fecha_salida, $precio, $descripcion, $img1, $img2, $detalles)
    {
        $sentencia = $this->db->prepare("UPDATE tours SET id_crucero=?, destino=?, fecha_salida=?, precio=?, descripcion=?, img1=?, img2=?, detalles=? WHERE ID=?");
        return $sentencia->execute(array($id_crucero, $destino, $fecha_salida, $precio, $descripcion, $img1, $img2, $detalles, $tour_id));
    }
    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     |  Ordena los tours. |
     *--------------------*/
    public function GetSortedTours($criterio, $orden)
    {
        $query = $this->db->prepare("SELECT * FROM tours ORDER BY $criterio $orden");
        $query->execute();
        $tours = $query->fetchAll(PDO::FETCH_ASSOC);
        return $tours;
    }
    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Obtiene columnas de la tabla. |
     *-------------------------------*/
    public function obtenerColumnas()
    {
        $sentencia = $this->db->prepare('SELECT column_name FROM information_schema.columns WHERE table_name = :table_name');
        $sentencia->execute([':table_name' => 'tours']);
        return $sentencia->fetchAll();
    }
    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     |  Filtrar los tours. |
     *---------------------*/
    public function GetFilteredTours($filtro, $valor) {
        $sql = "SELECT * FROM tours WHERE $filtro = :valor";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':valor', $valor);
        $stmt->execute();
        $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tours;
    }
    


}