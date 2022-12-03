<?php

class Rdv
{

    private $id;
    private $date;
    private $heure;
    private $refetudiant;
    private $refrepresentant;
    private $refoffre;
    private $etat;

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

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @param mixed $refetudiant
     */
    public function setRefetudiant($refetudiant)
    {
        $this->refetudiant = $refetudiant;
    }

    /**
     * @param mixed $refrepresentant
     */
    public function setRefrepresentant($refrepresentant)
    {
        $this->refrepresentant = $refrepresentant;
    }

    /**
     * @param mixed $refoffre
     */
    public function setRefoffre($refoffre)
    {
        $this->refoffre = $refoffre;
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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @return mixed
     */
    public function getRefetudiant()
    {
        return $this->refetudiant;
    }

    /**
     * @return mixed
     */
    public function getRefrepresentant()
    {
        return $this->refrepresentant;
    }

    /**
     * @return mixed
     */
    public function getRefoffre()
    {
        return $this->refoffre;
    }

    public function selectRdv($bdd){

        $sel = $bdd->getBdd()->prepare("SELECT * FROM rdv WHERE ref_representant = :ref");
        $sel->execute(array(
            'ref'=>$this->getRefrepresentant()
        ));
        return $sel->fetchAll();

    }

    public function addRdv($bdd){

        $add = $bdd->getBdd()->prepare("INSERT INTO rdv (date_rdv, heure, etat, ref_etudiant, ref_representant, ref_offre) VALUES (:daterdv, :heure, :etat, :refetudiant, :refrepresentant, :refoffre)");
        $add->execute(array(
            'daterdv'=>$this->getDate(),
            'heure'=>$this->getHeure(),
            'etat'=>$this->getEtat(),
            'refetudiant'=>$this->getRefetudiant(),
            'refrepresentant'=>$this->getRefrepresentant(),
            'refoffre'=>$this->getRefoffre()
        ));

    }

    public function editRdv(){

        $edit = $this->bdd->getBdd()->prepare("UPDATE rdv SET date_rdv = :daterdv, heure = :heure, etat = :etat, ref_etudiant = :refetudiant, ref_representant = :refrepresentant, ref_offre = :refoffre WHERE id_offre = :id");
        $edit->execute(array(
            'daterdv'=>$this->getDate(),
            'heure'=>$this->getHeure(),
            'etat'=>$this->getEtat(),
            'refetudiant'=>$this->getRefetudiant(),
            'refrepresentant'=>$this->getRefrepresentant(),
            'refoffre'=>$this->getRefoffre(),
            'id'=>$this->getId()
        ));
    }

    public function deleteRdv(){

        $del = $this->bdd->getBdd()->prepare("DELETE FROM rdv WHERE id_rdv = :id");
        $del->execute(array(
            'id'=>$this->getId()
        ));

    }
}