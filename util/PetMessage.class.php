<?php

/**
 * Clase que define los mensajes relacionados con las operaciones de Pet y la validación del formulario.
 */
class PetMessage
{
    // MENSAJES DE ÉXITO/FALLO EN LA BASE DE DATOS

    const INSERT_SUCCESS = "Pet(s) inserted successfully";
    const UPDATE_SUCCESS = "Pet(s) updated successfully";
    const DELETE_SUCCESS = "Pet(s) deleted successfully";
    const SELECT_SUCCESS = "Pet(s) found";

    const INSERT_ERROR = "Error inserting pet(s)";
    const UPDATE_ERROR = "Error updating pet(s)";
    const DELETE_ERROR = "Error deleting pet(s)";
    const SELECT_ERROR = "Pet(s) not found";

    // MENSAJES DE ERROR DEL FORMULARIO

    const FORM_EMPTY_ID = "Pet ID must be filled";
    const FORM_EMPTY_IDOWNER = "Pet owner's NIF must be filled";
    const FORM_EMPTY_NAME = "Pet name must be filled";

    const FORM_INVALID_ID = "Pet ID's format is invalid";
    const FORM_INVALID_IDOWNER = "Pet owner's NIF's format is invalid";
    const FORM_INVALID_NAME = "Pet name's format is invalid";

    const ID_ALREADY_EXISTS = "Pet's ID already exists";
    const ID_DOES_NOT_EXIST = "Pet's ID does not exist";
}
