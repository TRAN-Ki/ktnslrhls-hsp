<?php

class Type
{

    private $id;
    private $libelle;
    private $bdd;



    public function __construct(array $donnees){
        $this->hydrate($donnees);
        $this->bdd = new Database();
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
    public function selectType(){
        $sel = $this->bdd->getBdd()->prepare("SELECT * FROM type");
        $sel->execute();
        $result = $sel->fetchAll();
        return $result;
    }

    public function addType(){


        $req = $this->bdd->getBdd()->prepare("INSERT INTO type (libelle) VALUES (:libelle)");
        $req->execute(array(
            'libelle'=>$this->getLibelle()
        ));
    }

    public function updateType(){
        $req = $this->bdd->getBdd()->prepare('UPDATE Type SET libelle = :libelle WHERE id_type = :id');
        $req->execute(array(
            'libelle'=>$this->getLibelle(),
            'id'=>$this->getId()
        ));
    }

    public function deleteType(){
        $del = $this->bdd->getBdd()->prepare('DELETE Type FROM id_type = :id');
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