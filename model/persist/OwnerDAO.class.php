<?php

require_once "model/Owner.class.php";
require_once "model/persist/DBConnection.class.php";
require_once "model/persist/ModelInterface.php";

class OwnerDAO implements ModelInterface
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DBConnection();
    }

    /**
     * Recopila todos los propietarios.
     * @return array con todos los propietarios.
     */
    public function listAll()
    {
        // Declara un array para los resultados.
        $response = array();

        // Parámetros de myQuery.
        $sql = "SELECT * FROM propietarios";
        $vector = array(); // array vacío porque no se necesitan parámetros para una consulta 'select all'.

        // Prepara la sentencia.
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            foreach ($sentence as $line) {
                $owner = new Owner($line["nif"], $line["nom"], $line["email"], $line["movil"]);
                $response[] = $owner;
            }
        }

        return $response;
    }

    /**
     * Recupera un propietario de la base de datos dado su $nif.
     * @param $nif del propietario a recuperar.
     * @return propietario encontrado con ese nif en la base de datos. Si no se encuentra ninguno, devuelve null.
     */
    public function searchById($nif)
    {
        // Declara un propietario para los resultados.
        $owner = NULL;

        // Parámetros de myQuery.
        $sql = "SELECT * FROM propietarios WHERE nif=?";
        $vector = array($nif);

        // Prepara la sentencia.
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            foreach ($sentence as $line) {
                $owner = new Owner($line["nif"], $line["nom"], $line["email"], $line["movil"]);
            }
        }

        return $owner;
    }

    /**
     * Modifica un propietario en la base de datos dado su $nif y parámetros.
     * @param propietario a modificar.
     * @return true si el propietario se modificó correctamente, false en caso contrario.
     */
    public function modify($owner)
    {
        // Parámetros de myQuery.
        $sql = "UPDATE propietarios SET email=?, movil=? WHERE nif=?";
        $vector = array($owner->getEmail(), $owner->getPhone(), $owner->getNif());

        // Prepara la sentencia.
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            return true;
        }

        return false;
    }

    /**
     * Escribe un nuevo propietario en la base de datos.
     * @param propietario a añadir.
     * @return true si el propietario se añadió correctamente, false en caso contrario.
     */
    public function add($owner)
    {
        // Parámetros de myQuery.
        $sql = "INSERT INTO propietarios (nif, nom, email, movil) VALUES (?, ?, ?, ?)";
        $vector = array($owner->getNif(), $owner->getName(), $owner->getEmail(), $owner->getPhone());

        // Prepara la sentencia.
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            return true;
        }

        return false;
    }

    /**
     * Elimina un propietario de la base de datos dado su $nif.
     * @param $nif del propietario a eliminar.
     * @return true si el propietario se eliminó correctamente, false en caso contrario.
     */
    public function delete($nif)
    {
        // Parámetros de myQuery.
        $sql = "DELETE FROM propietarios WHERE nif=?";
        $vector = array($nif);

        // Prepara la sentencia.
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        if ($sentence != null && $sentence->rowCount() != 0) {
            return true;
        }

        return false;
    }

    /**
     * Obtiene las mascotas asociadas con el propietario dado su $nif.
     * @param $nif del propietario.
     * @return array de mascotas asociadas con el propietario.
     */
    public function getPetsByOwner($nif)
    {
        // Parámetros de myQuery.
        $sql = "SELECT * FROM mascotas WHERE nifpropietario=?";
        $vector = array($nif);

        // Prepara la sentencia.
        $sentence = $this->dbConnection->myQuery($sql, $vector);

        // Recupera las mascotas.
        $pets = [];
        while ($row = $sentence->fetch(PDO::FETCH_ASSOC)) {
            $pet = new Pet($row['id'], $row['nifpropietario'], $row['name'] ?? null);
            $pets[] = $pet;
        }

        return $pets;
    }
}
