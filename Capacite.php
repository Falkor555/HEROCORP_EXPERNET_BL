<?php

class Capacite
{
    private $id;
    private $nom_capacite;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNomCapacite()
    {
        return $this->nom_capacite;
    }

    /**
     * @param mixed $nom_capacite
     */
    public function setNomCapacite($nom_capacite)
    {
        $this->nom_capacite = $nom_capacite;
    }
}