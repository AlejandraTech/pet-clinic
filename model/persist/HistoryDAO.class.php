<?php
require_once "model/History.class.php";
require_once "model/persist/DBConnection.class.php";
require_once "model/persist/ModelInterface.php";

/**
 * Clase DAO para Historial.
 */
class HistoryDAO implements ModelInterface
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DBConnection();
    }

    /**
     * Obtiene todas las visitas.
     * @return array con todas las visitas.
     */
    public function listAll()
    {
        $response = array();

        $sql = "SELECT * FROM lineas_de_historial ORDER BY fecha ASC";
        $vector = array();

        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            foreach ($sentence as $line) {
                $history = new History($line["id"], $line["idmascota"], $line["fecha"], $line["motivo_visita"], $line["descripcion"]);
                $response[] = $history;
            }
        }

        return $response;
    }

    /**
     * Escribe un nuevo historial en la base de datos.
     * @param history historial a agregar
     * @return true si el historial se agregó correctamente, false en caso contrario
     */
    public function add($history)
    {
        $sql = "INSERT INTO lineas_de_historial (idmascota, fecha, motivo_visita, descripcion) VALUES (?, ?, ?, ?)";
        $vector = array($history->getIdPet(), $history->getDate(), $history->getMotive(), $history->getDesc());

        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            return true;
        }

        return false;
    }

    /**
     * Recupera un historial de la base de datos dado su $id.
     * @param $id del historial a recuperar
     * @return historial encontrado con ese id en la base de datos. Si no se encuentra ninguno, devuelve null
     */
    public function searchById($id)
    {
        $response = array();

        $sql = "SELECT * FROM lineas_de_historial WHERE id=?";
        $vector = array($id);

        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            foreach ($sentence as $line) {
                $history = new History($line["id"], $line["idmascota"], $line["fecha"], $line["motivo_visita"], $line["descripcion"]);
                $response[] = $history;
            }
        }

        return $response;
    }

    /**
     * Recupera un historial de la base de datos dado su $idPet.
     * @param $idPet del historial a recuperar
     * @return historial encontrado con ese idPet en la base de datos. Si no se encuentra ninguno, devuelve null
     */
    public function searchByPetId($idPet)
    {
        $response = array();

        $sql = "SELECT * FROM lineas_de_historial WHERE idmascota=?";
        $vector = array($idPet);

        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            foreach ($sentence as $line) {
                $history = new History($line["id"], $line["idmascota"], $line["fecha"], $line["motivo_visita"], $line["descripcion"]);
                $response[] = $history;
            }
        }

        return $response;
    }

    /**
     * Modifica un historial en la base de datos dado su $id y parámetros.
     * @param history historial a modificar
     * @return true si el historial se modificó correctamente, false en caso contrario
     */
    public function modify($history)
    {
        $sql = "UPDATE lineas_de_historial SET idMascota=?, fecha=?, motivo_visita=?, descripcion=? WHERE id=?";
        $vector = array($history->getIdPet(), $history->getDate(), $history->getMotive(), $history->getDesc(), $history->getId());

        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            return true;
        }

        return false;
    }

    /**
     * Elimina un historial de la base de datos dado su $id.
     * @param $id del historial a eliminar
     * @return true si el historial se eliminó correctamente, false en caso contrario
     */
    public function delete($id)
    {
        $sql = "DELETE FROM lineas_de_historial WHERE id=?";
        $vector = array($id);

        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            return true;
        }

        return false;
    }
}
