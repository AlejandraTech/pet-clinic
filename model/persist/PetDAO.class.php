<?php
require_once "model/Pet.class.php";
require_once "model/persist/DBConnection.class.php";
require_once "model/persist/ModelInterface.php";

class PetDAO implements ModelInterface
{
    private $dbConnection;

    private $sqlListPetsByOwner = "SELECT * FROM mascotas WHERE nifpropietario=?"; // Buscar mascotas dado un propietario (1,5 puntos)

    public function __construct()
    {
        $this->dbConnection = new DBConnection();
    }

    /**
     * Recopila todas las mascotas
     * @param void
     * @return array con todas las mascotas
     */
    public function listAll()
    {
        // Declarar array para los resultados
        $response = array();

        // Parámetros de myQuery
        $sql = "SELECT * FROM mascotas"; // Listar todas las mascotas 
        $vector = array(); // array vacío porque no se necesitan parámetros para una consulta 'seleccionar todo'

        // Preparar la sentencia
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            foreach ($sentence as $line) {
                $pet = new Pet($line["id"], $line["nifpropietario"], $line["nom"]);
                $response[] = $pet;
            }
        }

        return $response;
    }

    /**
     * Escribe una nueva mascota en la base de datos
     * @param pet a agregar
     * @return true si la mascota se agregó correctamente, false en caso contrario
     */
    public function add($pet)
    {
        // Parámetros de myQuery
        $sql = "INSERT INTO mascotas (nifpropietario, nom) VALUES (?, ?)";
        $vector = array($pet->getIdOwner(), $pet->getNames());

        // Preparar la sentencia
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            return true;
        }

        return false;
    }

    /**
     * Recupera una mascota de la base de datos dada su $id
     * @param $id de la mascota a recuperar
     * @return mascota encontrada con ese id en la base de datos. Si no se encuentra ninguna, devuelve null
     */
    public function searchById($id)
    {
        // Declarar variables de resultado
        $pet = null;

        // Obtener datos de la mascota (basado en el parámetro $id)
        $sql = "SELECT * FROM mascotas WHERE id=?";
        $vector = array($id);
        $sentence = $this->dbConnection->myQuery($sql, $vector);
        if ($sentence != null && $sentence->rowCount() != 0) {
            foreach ($sentence as $line) {
                $pet = new Pet($line["id"], $line["nifpropietario"], $line["nom"]);
            }
        }

        $response = $pet;

        return $response;
    }

    /**
     * Recupera una mascota de la base de datos dado el $nif de su propietario
     * @param $nif del propietario de la mascota
     * @return mascota encontrada con el nif del propietario en la base de datos. Si no se encuentra ninguna, devuelve null
     */
    public function searchByOwnerNif($nif)
    {
        // Declarar array para los resultados
        $response = array();

        // Parámetros de myQuery
        $sql = "SELECT * FROM mascotas WHERE nifpropietario=?";
        $vector = array($nif);

        // Preparar la sentencia
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            foreach ($sentence as $line) {
                $pet = new Pet($line["id"], $line["nifpropietario"], $line["nom"]);
                $response[] = $pet;
            }
        }

        return $response;
    }

    /**
     * Modifica una mascota en la base de datos dada su $id y los parámetros
     * @param mascota a modificar
     * @return true si la mascota se modificó correctamente, false en caso contrario
     */
    public function modify($pet)
    {
        // Parámetros de myQuery
        $sql = "UPDATE mascotas SET nifpropietario=?, nom=? WHERE id=?";
        $vector = array($pet->getIdOwner(), $pet->getName(), $pet->getId());

        // Preparar la sentencia
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            return true;
        }

        return false;
    }

    /**
     * Elimina una mascota de la base de datos dada su $id
     * @param $id de la mascota a eliminar
     * @return true si la mascota se eliminó correctamente, false en caso contrario
     */
    public function delete($id)
    {
        // Eliminar referencias en lineas_de_historial
        $this->deleteReferencesInLineasDeHistorial($id);

        // Luego eliminar la mascota
        $sql = "DELETE FROM mascotas WHERE id=?";
        $vector = array($id);

        // Preparar la sentencia
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        return ($sentence != null && $sentence->rowCount() != 0);
    }

    /**
     * Elimina las referencias a una mascota en lineas_de_historial dado su $id
     * @param $id de la mascota
     * @return void
     */
    private function deleteReferencesInLineasDeHistorial($id)
    {
        $sql = "DELETE FROM lineas_de_historial WHERE idmascota=?";
        $vector = array($id);

        // Preparar la sentencia
        $sentence = $this->dbConnection->myQuery($sql, $vector);
    }
}
