<?php

/**
 * Clase DTO para Historial.
 */
class History
{
    // ATRIBUTOS

    private $id;
    private $idPet;
    private $date;
    private $motive;
    private $desc;

    // CONSTRUCTOR

    public function __construct($id, $idPet, $date, $motive = NULL, $desc = NULL)
    {
        $this->id = $id;
        $this->idPet = $idPet;
        $this->date = $date;
        $this->motive = $motive;
        $this->desc = $desc;
    }

    // GETTERS Y SETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getIdPet()
    {
        return $this->idPet;
    }
    public function setIdPet($value)
    {
        $this->idPet = $value;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function setDate($value)
    {
        $this->date = $value;
    }

    public function getMotive()
    {
        return $this->motive;
    }
    public function setMotive($value)
    {
        $this->motive = $value;
    }

    public function getDesc()
    {
        return $this->desc;
    }
    public function setDesc($value)
    {
        $this->desc = $value;
    }

    // ESCRIBIR

    public function write()
    {
        return "\n" . $this->id . ";" . $this->idPet . ";" . $this->date . ";" . $this->motive . ";" . $this->desc;
    }
}
