<?php

// Clase que representa una conexión a la base de datos
class DBConnection
{
    // Atributos que almacenan la información necesaria para la conexión
    private $dsn = "mysql:host=localhost;dbname=mascotasclinic";
    private $user = "root"; // Usuario de la BD
    private $password = ""; // Contraseña de la BD
    private $dbh; // Objeto de conexión PDO

    // Método privado para establecer la conexión a la base de datos
    private function connect()
    {
        $flag = true; // Bandera que indica el estado de la conexión

        try {
            // Intentamos establecer la conexión utilizando PDO
            $this->dbh = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            // Si hay un error, cambiamos el estado de la bandera a falso
            $flag = false;
        }
        return $flag; // Devolvemos el estado de la conexión
    }

    // Método privado para cerrar la conexión a la base de datos
    private function disconnect()
    {
        $this->dbh = null; // Establecemos el objeto de conexión a nulo para cerrar la conexión
    }

    // Método público para realizar consultas a la base de datos
    public function myQuery($sql, $vector)
    {
        $sentencia = null; // Variable que almacenará la sentencia preparada

        // select, insert, update, delete
        // Verificamos si la conexión se establece correctamente
        if ($this->connect()) {

            try {
                // Intentamos preparar la sentencia SQL
                $sentencia = $this->dbh->prepare($sql);
            } catch (PDOException $e) {
                // Manejamos cualquier error en la preparación de la sentencia
            }

            // Ejecutamos la sentencia con los parámetros proporcionados
            if ($sentencia->execute($vector) != false) {
                // Si la ejecución es exitosa, cerramos la conexión a la base de datos
                $this->disconnect();
            }
        }

        return $sentencia; // Devolvemos la sentencia preparada (puede ser NULL si hay errores)
    }
}
