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
    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Elimina un crucero de la BBDD según el id pasado. |
     *---------------------------------------------------*/
    function delete($idCrucero)
    {
        $query = $this->db->prepare("DELETE FROM `cruceros` WHERE ID = ?");
        $query2 = $this->db->prepare("DELETE FROM `tours` WHERE id_crucero = ?");
        $query2->execute([$idCrucero]);
        $query->execute([$idCrucero]);
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Actualiza el crucero. |
     *-----------------------*/
    public function ActualizarCrucero($crucero_id, $nombre, $compania, $capacidad, $origen, $img1, $img2, $descripcion, $detalles)
    {
        $query = $this->db->prepare('UPDATE cruceros SET nombre=?, compania=?, capacidad=?, origen=?, img1=?, img2=?, descripcion=?, detalles=? WHERE ID = ?');
        $query->execute([$nombre, $compania, $capacidad, $origen, $img1, $img2, $descripcion, $detalles, $crucero_id]);
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     |  Ordena los cruceros. |
     *-----------------------*/
    public function GetSortedCruceros($criterio, $orden)
    {
        $query = $this->db->prepare("SELECT * FROM cruceros ORDER BY $criterio $orden");
        $query->execute();
        $cruceros = $query->fetchAll(PDO::FETCH_ASSOC);
        return $cruceros;
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     | Obtiene columnas de la tabla. |
     *-------------------------------*/
    public function obtenerColumnas()
    {
        $sentencia = $this->db->prepare('SELECT column_name FROM information_schema.columns WHERE table_name = :table_name');
        $sentencia->execute([':table_name' => 'cruceros']);
        return $sentencia->fetchAll();
    }

    /*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
     |  Filtrar los cruceros. |
     *------------------------*/
    public function GetFilteredCruceros($filtro, $valor)
    {
        $sql = "SELECT * FROM cruceros WHERE $filtro = :valor";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':valor', $valor);
        $stmt->execute();
        $cruceros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cruceros;
    }

    public function getPaginatedCruceros($inicio, $filas)
    {
        $sql = "SELECT * FROM cruceros LIMIT $inicio, $filas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $cruceros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cruceros;
    }

    public function getTotalRecords()
    {
        $query = $this->db->prepare("SELECT count(*) FROM cruceros");
        $query->execute();
        return $query->fetchColumn();
    }

}