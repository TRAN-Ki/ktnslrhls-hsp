<?php

class Etudiant
{
    private $refutilisateur;
    private $domaine;

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

    public function selectEtudiant($bdd){
        $sel = $bdd->getBdd()->prepare("SELECT * FROM etudiant");
        $sel->execute();
        $result = $sel->fetchAll();
        return $result;
    }

    public function addEtudiant($bdd){
        $add = $bdd->getBdd()->prepare("INSERT INTO etudiant (ref_utilisateur, domaine) VALUES (:ref, :domaine)");
        $add->execute(array(
            'ref'=>$this->getRefUtilisateur(),
            'domaine'=>$this->getDomaine()
        ));
    }

    /**
     * @return mixed
     */
    public function getRefutilisateur()
    {
        return $this->refutilisateur;
    }

    /**
     * @param mixed $refutilisateur
     */
    public function setRefutilisateur($refutilisateur): void
    {
        $this->refutilisateur = $refutilisateur;
    }

    /**
     * @return mixed
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * @param mixed $domaine
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
    }




}