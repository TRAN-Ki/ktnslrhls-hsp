<?php

class Etudiant
{
    private $ref_utilisateur;
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
        $add = $bdd->getBdd()->prepare("INSERT INTO etudiant (domaine) VALUES (:domaine)");
        $add->execute(array(
            'domaine'=>$this->getDomaine(),
        ));
    }

    public function updateEtudiant($bdd){
        $mod = $bdd->getBdd()->prepare("UPDATE etudiant SET domaine = :domaine WHERE ref_utilisateur = :refutilisateur");
        $mod->execute(array(
            'domaine'=>$this->getDomaine(),
            'refutilisateur'=>$this->getRefUtilisateur()
        ));
    }

    public function deleteEtudiant($bdd){
        $del = $bdd->getBdd()->prepare('DELETE FROM etudiant WHERE ref_utilisateur = :id');
        $del->execute(array(
            'id'=>$this->getRefUtilisateur()
        ));
    }



    /**
     * @return mixed
     */
    public function getRefUtilisateur()
    {
        return $this->ref_utilisateur;
    }

    /**
     * @param mixed $ref_utilisateur
     */
    public function setRefUtilisateur($ref_utilisateur)
    {
        $this->ref_utilisateur = $ref_utilisateur;
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