<?php

class Conference
{

    private $id;
    private $nom;
    private $description;
    private $dateconf;
    private $heure;
    private $duree;
    private $valider;
    private $refamphitheatre;

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
    public function setId($id): void
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
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateConf()
    {
        return $this->dateconf;
    }

    /**
     * @param mixed $dateconf
     */
    public function setDateConf($dateconf): void
    {
        $this->dateconf = $dateconf;
    }

    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure): void
    {
        $this->heure = $heure;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getValider()
    {
        return $this->valider;
    }

    /**
     * @param mixed $valider
     */
    public function setValider($valider): void
    {
        $this->valider = $valider;
    }

    /**
     * @return mixed
     */
    public function getRefAmphitheatre()
    {
        return $this->refamphitheatre;
    }

    /**
     * @param mixed $refamphitheatre
     */
    public function setRefAmphitheatre($refamphitheatre): void
    {
        $this->refamphitheatre = $refamphitheatre;
    }


    public function selectConference($bdd){

        $sel = $bdd->getBdd()->prepare("SELECT * FROM conference");
        $sel->execute();
        $result = $sel->fetchAll();
        return $result;

    }

    public function addConference($bdd){

        $add = $bdd->getBdd()->prepare("INSERT INTO conference (nom, description, date_conf, heure, duree, valider, ref_amphitheatre) VALUES (:nom, :description, :date, :heure, :duree, :valider, :ref)");
        $add->execute(array(
            'nom'=>$this->getNom(),
            'description'=>$this->getDescription(),
            'date'=>$this->getDateConf(),
            'heure'=>$this->getHeure(),
            'duree'=>$this->getDuree(),
            'valider'=>$this->getValider(),
            'ref'=>$this->getRefAmphitheatre()
        ));
    }

    public function editConference(){
        $bdd = new Database();
        $edit = $bdd->getBdd()->prepare("UPDATE conference SET nom = :nom, description = :description, date_conf = :date, heure = :heure, duree = :duree, valider = :valider, ref_amphitheatre = :ref WHERE id_conference = :id");
        $edit->execute(array(
            'nom'=>$this->getNom(),
            'description'=>$this->getDescription(),
            'date'=>$this->getDateConf(),
            'heure'=>$this->getHeure(),
            'duree'=>$this->getDuree(),
            'valider'=>$this->getValider(),
            'ref'=>$this->getRefAmphitheatre(),
            'id'=>$this->getId()
        ));
    }

    public function deleteConference(){
        $bdd = new Database();
        $del = $bdd->getBdd()->prepare("DELETE FROM conference WHERE id_conference = :id");
        $del->execute(array(
            'id'=>$this->getId()
        ));
    }
}