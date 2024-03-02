<?php

/**
 * Clase DTO para Propietario.
 */
class Owner
{
    // ATRIBUTOS

    private $nif;
    private $name;
    private $email;
    private $phone;

    // CONSTRUCTOR

    public function __construct($nif, $name = NULL, $email = NULL, $phone = NULL)
    {
        $this->nif = $nif;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    // GETTERS Y SETTERS

    public function getNif()
    {
        return $this->nif;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($value)
    {
        $this->name = $value;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    public function setPhone($value)
    {
        $this->phone = $value;
    }

    // ESCRIBIR

    public function write()
    {
        return "\n" . $this->nif . ";" . $this->name . ";" . $this->email . ";" . $this->phone;
    }
}
