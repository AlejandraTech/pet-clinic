<?php

class OwnerMessage
{
    // MENSAJES DE ÉXITO/ERROR DE LA BASE DE DATOS

    const INSERT_SUCCESS = "Owner(s) inserted successfully";
    const UPDATE_SUCCESS = "Owner(s) updated successfully";
    const DELETE_SUCCESS = "Owner(s) deleted successfully";
    const SELECT_SUCCESS = "Owner(s) found";

    const INSERT_ERROR = "Error inserting owner(s)";
    const UPDATE_ERROR = "Error updating owner(s)";
    const DELETE_ERROR = "Error deleting owner(s)";
    const SELECT_ERROR = "Owner(s) not found";

    // MENSAJES DE ERROR DEL FORMULARIO

    const FORM_EMPTY_NIF = "Owner NIF must be filled";
    const FORM_EMPTY_NAME = "Owner name must be filled";
    const FORM_EMPTY_EMAIL = "Owner email must be filled";
    const FORM_EMPTY_PHONE = "Owner phone must be filled";

    const FORM_INVALID_NIF = "Owner NIF's format is invalid";
    const FORM_INVALID_NAME = "Owner name's format is invalid";
    const FORM_INVALID_EMAIL = "Owner email's format is invalid";
    const FORM_INVALID_PHONE = "Owner phone's format is invalid";

    const NIF_ALREADY_EXISTS = "Owner's NIF already exists";
    const NIF_DOES_NOT_EXIST = "Owner's NIF does not exist";
}
