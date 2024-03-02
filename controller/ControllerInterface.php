<?php

/**
 * Interfaz que contiene todos los métodos obligatorios necesarios en un objeto Controlador.
 */
interface ControllerInterface
{
    /**
     * Procesa la solicitud del usuario.
     */
    public function processRequest();

    /**
     * Agrega un nuevo elemento.
     */
    public function add();

    /**
     * Modifica un elemento existente.
     */
    public function modify();

    /**
     * Elimina un elemento existente.
     */
    public function delete();

    /**
     * Busca un elemento por su identificador.
     */
    public function searchById();

    /**
     * Lista todos los elementos.
     */
    public function listAll();
}
