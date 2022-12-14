<?php

class Type
{

    private $id;
    private $libelle;

    public function __construct(array $donnees){
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function selectTypeById($bdd){
        $sel = $bdd->getBdd()->prepare("SELECT * FROM type WHERE id_type = :id");
        $sel->execute(array(
            'id'=>$this->getId()
        ));
        return $sel->fetch();
    }

    public function selectType($bdd){
        $sel = $bdd->getBdd()->prepare("SELECT * FROM type");
        $sel->execute();
        return $sel->fetchAll();
    }

    public function addType($bdd){

        $req = $bdd->getBdd()->prepare("INSERT INTO type (libelle) VALUES (:libelle)");
        $req->execute(array(
            'libelle'=>$this->getLibelle()
        ));
    }

    public function updateType(){
        $bdd = new Database();
        $req = $bdd->getBdd()->prepare("UPDATE type SET libelle = :libelle WHERE id_type = :id");
        $req->execute(array(
            'libelle'=>$this->getLibelle(),
            'id'=>$this->getId()
        ));
    }

    public function deleteType(){
        $bdd = new Database();
        $del = $bdd->getBdd()->prepare("DELETE FROM type WHERE id_type = :id");
        $del->execute(array(
            'id'=>$this->getId()
        ));

    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
}