<?php

class Inscrit
{
    private $refetudiant;
    private $refconference;

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
    public function getRefetudiant()
    {
        return $this->refetudiant;
    }

    /**
     * @param mixed $refetudiant
     */
    public function setRefetudiant($refetudiant): void
    {
        $this->refetudiant = $refetudiant;
    }

    /**
     * @return mixed
     */
    public function getRefconference()
    {
        return $this->refconference;
    }

    /**
     * @param mixed $refconference
     */
    public function setRefconference($refconference): void
    {
        $this->refconference = $refconference;
    }

    public function selectInscritRef($bdd){
        $sel = $bdd->getBdd()->prepare("SELECT * FROM inscrit WHERE ref_conference = :ref AND ref_etudiant = :refe");
        $sel->execute(array(
            'ref'=>$this->getRefconference(),
            'refe'=>$this->getRefetudiant()
        ));
        return $sel->fetch();
    }

    public function addInscrit($bdd){
        $add = $bdd->getBdd()->prepare("INSERT INTO inscrit (ref_etudiant, ref_conference) VALUES (:refe, :refc)");
        $add->execute(array(
            'refe'=>$this->getRefetudiant(),
            'refc'=>$this->getRefconference()
        ));
    }

    public function deleteInscrit(){
        $bdd = new Database();
        $del = $bdd->getBdd()->prepare('DELETE FROM inscrit WHERE ref_etudiant = :refe AND ref_conference = :refc');
        $del->execute(array(
            'refe'=>$this->getRefetudiant(),
            'refc'=>$this->getRefconference()
        ));
    }

}