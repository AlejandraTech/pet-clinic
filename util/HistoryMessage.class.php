<?php

class HistoryMessage
{
    // MENSAJES DE ÉXITO Y ERROR DE LA BASE DE DATOS

    const INSERT_SUCCESS = "History(s) inserted successfully";
    const UPDATE_SUCCESS = "History(s) updated successfully";
    const DELETE_SUCCESS = "History(s) deleted successfully";
    const SELECT_SUCCESS = "History(s) found";

    const INSERT_ERROR = "Error inserting history(s)";
    const UPDATE_ERROR = "Error updating history(s)";
    const DELETE_ERROR = "Error deleting history(s)";
    const SELECT_ERROR = "History(s) not found";

    // MENSAJES DE ERROR DEL FORMULARIO

    const FORM_EMPTY_ID = "History ID must be filled";
    const FORM_EMPTY_IDPET = "History pet's ID must be filled";
    const FORM_EMPTY_DATE = "History date must be filled";
    const FORM_EMPTY_MOTIVE = "History motive must be filled";
    const FORM_EMPTY_DESC = "History description must be filled";

    const FORM_INVALID_ID = "History ID's format is invalid";
    const FORM_INVALID_IDPET = "History pet's ID's format is invalid";
    const FORM_INVALID_DATE = "History date's format is invalid";
    const FORM_INVALID_MOTIVE = "History motive's format is invalid";
    const FORM_INVALID_DESC = "History description's format is invalid";

    const ID_ALREADY_EXISTS = "History's ID already exists";
    const ID_DOES_NOT_EXIST = "History's ID does not exist";
}
