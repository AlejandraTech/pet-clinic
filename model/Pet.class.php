<?php

/**
 * Clase DTO para Mascota.
 */
class Pet
{
    // ATRIBUTOS

    private $id;
    private $idOwner;
    private $names;

    // CONSTRUCTOR

    public function __construct($id, $idOwner, $names)
    {
        $this->id = $id;
        $this->idOwner = $idOwner;
        $this->names = $names;
    }

    // GETTERS Y SETTERS

    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }

    public function getIdOwner()
    {
        return $this->idOwner;
    }
    public function setIdOwner($value)
    {
        $this->idOwner = $value;
    }

    public function getNames()
    {
        return $this->names;
    }
    public function setNames($value)
    {
        $this->names = $value;
    }

    // ESCRIBIR

    public function write()
    {
        return "\n" . $this->id . ";" . $this->idOwner . ";" . $this->names;
    }
}
