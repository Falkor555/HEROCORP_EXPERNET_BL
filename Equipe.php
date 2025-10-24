<?php

class Equipe
{
    private $id;

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
    public function getNomEquipe()
    {
        return $this->nom_equipe;
    }

    /**
     * @param mixed $nom_equipe
     */
    public function setNomEquipe($nom_equipe)
    {
        $this->nom_equipe = $nom_equipe;
    }
    private $nom_equipe;

}