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
        $result = $sel->fetch();
        var_dump($result);
        return $result;
    }

    public function addInscrit($bdd){
        $add = $bdd->getBdd()->prepare("INSERT INTO inscrit (ref_etudiant, ref_conference) VALUES (:refe, :refc)");
        $add->execute(array(
            'refe'=>$this->getRefetudiant(),
            'refc'=>$this->getRefconference()
        ));
    }

    public function updateEtudiant($bdd){
        $mod = $bdd->getBdd()->prepare("UPDATE etudiant SET domaine = :domaine WHERE ref_utilisateur = :refutilisateur");
        $mod->execute(array(
        ));
    }

    public function deleteInscrit($bdd){
        $del = $bdd->getBdd()->prepare('DELETE FROM inscrit WHERE  = :id');
        $del->execute(array(
        ));
    }

}