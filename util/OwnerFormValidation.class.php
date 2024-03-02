<?php

require_once "util/OwnerMessage.class.php";

/**
 * Clase utilizada para validar el formulario de entrada del usuario para un objeto Propietario.
 */
class OwnerFormValidation
{
    public const INSERT = array("nif", "name", "phone", "email");
    public const UPDATE = array("nif", "name");
    public const SELECT = array("nif");
    public const DELETE = array("nif");

    public static function checkData($requiredFields)
    {
        $nif = " ";
        $name = " ";
        $phone = " ";
        $email = " ";

        if (isset($_POST["nif"])) $nif = $_POST["nif"];
        if (isset($_POST["name"])) $name = $_POST["name"];
        if (isset($_POST["phone"])) $phone = $_POST["phone"];
        if (isset($_POST["email"])) $email = $_POST["email"];

        $nifRequired = in_array("nif", $requiredFields);
        $nameRequired = in_array("name", $requiredFields);
        $phoneRequired = in_array("phone", $requiredFields);
        $emailRequired = in_array("email", $requiredFields);

        if ($nif != " " || $nifRequired) {
            $nif = htmlspecialchars(trim($nif));
            $pattern = '/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/';
            if (empty($nif) && $nifRequired)                 $_SESSION["error"][] = OwnerMessage::FORM_EMPTY_NIF;
            else if (!empty($nif) && !preg_match($pattern, $nif)) $_SESSION["error"][] = OwnerMessage::FORM_INVALID_NIF;
        }

        if ($name != " " || $nameRequired) {
            $name = htmlspecialchars(trim($name));
            $pattern = '/^[a-zA-Z ]+$/';
            if (empty($name) && $nameRequired)                 $_SESSION["error"][] = OwnerMessage::FORM_EMPTY_NAME;
            else if (!empty($name) && !preg_match($pattern, $name)) $_SESSION["error"][] = OwnerMessage::FORM_INVALID_NAME;
        }

        if ($phone != " " || $phoneRequired) {
            $phone = htmlspecialchars(trim($phone));
            $pattern = "/^[0-9]{9}$/";
            if (empty($phone) && $phoneRequired)                 $_SESSION["error"][] = OwnerMessage::FORM_EMPTY_PHONE;
            else if (!empty($phone) && !preg_match($pattern, $phone)) $_SESSION["error"][] = OwnerMessage::FORM_INVALID_PHONE;
        }

        if ($email != " " || $emailRequired) {
            $email = htmlspecialchars(trim($email));
            if (empty($email) && $emailRequired)                              $_SESSION["error"][] = OwnerMessage::FORM_EMPTY_EMAIL;
            else if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) $_SESSION["error"][] = OwnerMessage::FORM_INVALID_EMAIL;
        }

        return new Owner($nif, $name, $email, $phone);
    }
}
