<?php

class Postule
{
    private $ref_etudiant;
    private $ref_offre;

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

    public function selectPostuleByRef($bdd){
        $sel = $bdd->getBdd()->prepare("SELECT * FROM postule WHERE ref_offre = :ref AND ref_etudiant = :refe");
        $sel->execute(array(
            'ref'=>$this->getRefOffre(),
            'refe'=>$this->getRefetudiant()
        ));
        return $sel->fetch();
    }

    public function insertPostule($bdd){
        $ins = $bdd->getBdd()->prepare("INSERT INTO postule (ref_etudiant, ref_offre) VALUES (:ref_etudiant, :ref_offre)");
        $ins->execute(array(
            'ref_etudiant'=>$this->getRefEtudiant(),
            'ref_offre'=>$this->getRefOffre(),
        ));
    }

    /**
     * @return mixed
     */
    public function getRefEtudiant()
    {
        return $this->ref_etudiant;
    }

    /**
     * @param mixed $ref_etudiant
     */
    public function setRefEtudiant($ref_etudiant)
    {
        $this->ref_etudiant = $ref_etudiant;
    }

    /**
     * @return mixed
     */
    public function getRefOffre()
    {
        return $this->ref_offre;
    }

    /**
     * @param mixed $ref_offre
     */
    public function setRefOffre($ref_offre)
    {
        $this->ref_offre = $ref_offre;
    }
}