<?php

require_once "util/PetMessage.class.php";

/**
 * Clase utilizada para validar el formulario de entrada del usuario para un objeto Pet.
 */
class PetFormValidation
{
    public const INSERT = array("idOwner", "name");
    public const UPDATE = array("id", "idOwner", "name");
    public const SELECT = array("id");
    public const DELETE = array("id");

    public static function checkData($requiredFields)
    {
        $id = " ";
        $idOwner = " ";
        $name = " ";

        if (isset($_POST["id"])) $id = $_POST["id"];
        if (isset($_POST["idOwner"])) $idOwner = $_POST["idOwner"];
        if (isset($_POST["name"])) $name = $_POST["name"];

        $idRequired = in_array("id", $requiredFields);
        $idOwnerRequired = in_array("idOwner", $requiredFields);
        $nameRequired = in_array("name", $requiredFields);

        if ($id != " " || $idRequired) {
            $id = htmlspecialchars(trim($id));
            $pattern = '/^\d+$/';
            if (empty($id) && $idRequired)                 $_SESSION["error"][] = PetMessage::FORM_EMPTY_ID;
            else if (!empty($id) && !preg_match($pattern, $id)) $_SESSION["error"][] = PetMessage::FORM_INVALID_ID;
        }

        if ($idOwner != " " || $idOwnerRequired) {
            $idOwner = htmlspecialchars(trim($idOwner));
            $pattern = '/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/';
            if (empty($idOwner) && $idOwnerRequired)                 $_SESSION["error"][] = PetMessage::FORM_EMPTY_IDOWNER;
            else if (!empty($idOwner) && !preg_match($pattern, $idOwner)) $_SESSION["error"][] = PetMessage::FORM_INVALID_IDOWNER;
        }

        if ($name != " " || $nameRequired) {
            $name = htmlspecialchars(trim($name));
            $pattern = '/^[a-zA-Z ]+$/';
            if (empty($name) && $nameRequired)                 $_SESSION["error"][] = PetMessage::FORM_EMPTY_NAME;
            else if (!empty($name) && !preg_match($pattern, $name)) $_SESSION["error"][] = PetMessage::FORM_INVALID_NAME;
        }

        return new Pet($id, $idOwner, $name);
    }
}
