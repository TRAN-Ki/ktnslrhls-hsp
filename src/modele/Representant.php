<?php

class Representant extends Utilisateur
{
    private $ref_utilisateur;
    private $role;
    private $ref_hopital;
    private $bdd;

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

    public function selectRepresentant($bdd){
        $sel = $bdd->getBdd()->prepare("SELECT * FROM representant");
        $sel->execute();
        $result = $sel->fetchAll();
        return $result;
    }

    public function addRepresentant($bdd){
        $add = $bdd->getBdd()->prepare("INSERT INTO representant (role, ref_hopital) VALUES (:role, :refhopital)");
        $add->execute(array(
            'role'=>$this->getRole(),
            'refhopital'=>$this->getRefHopital()
        ));
    }

    public function updateRepresentant($bdd){
        $mod = $bdd->getBdd()->prepare("UPDATE representant SET role = :role, ref_hopital = :refhopital WHERE ref_utilisateur = :refutilisateur");
        $mod->execute(array(
            'role'=>$this->getRole(),
            'refhopital'=>$this->getRefHopital(),
            'refutilisateur'=>$this->getRefUtilisateur()
        ));
    }

    public function deleteRepresentant($bdd){
        $del = $bdd->getBdd()->prepare('DELETE representant FROM ref_utilisateur = :id');
        $del->execute(array(
            'id'=>$this->getIdUtilisateur()
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
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getRefHopital()
    {
        return $this->ref_hopital;
    }

    /**
     * @param mixed $ref_hopital
     */
    public function setRefHopital($ref_hopital)
    {
        $this->ref_hopital = $ref_hopital;
    }


}