<?php

class Heros
{
    private $id;
    private $nom;
    private $prenom;
    private $pseudo;
    private $capacite_id;

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getCapacite()
    {
        return $this->capacite_id;
    }

    /**
     * @param mixed $capacite_id
     */
    public function setCapacite($capacite_id)
    {
        $this->capacite_id = $capacite_id;
    }

    /**
     * @return mixed
     */
    public function getEquipe()
    {
        return $this->equipe_id;
    }

    /**
     * @param mixed $equipe_id
     */
    public function setEquipe($equipe_id)
    {
        $this->equipe_id = $equipe_id;
    }
    private $equipe_id;

    public function __construct()
    {
    }
}