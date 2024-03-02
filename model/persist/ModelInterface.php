<?php

/**
 * Interfaz que contiene todos los métodos obligatorios necesarios en un objeto Modelo.
 */
interface ModelInterface
{
    public function add($object); // Método para agregar un objeto
    public function modify($object); // Método para modificar un objeto
    public function delete($id); // Método para eliminar un objeto por su ID
    public function searchById($id); // Método para buscar un objeto por su ID
    public function listAll(); // Método para listar todos los objetos
}
