<?php
require_once 'Utilisateur.php';
class Representant extends Utilisateur
{

    private $refutilisateur;
    private $role;
    private $refhopital;

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
        $add = $bdd->getBdd()->prepare("INSERT INTO representant (ref_utilisateur, role, ref_hopital) VALUES (:refuser, :role, :refhopital)");
        $add->execute(array(
            'refuser'=>$this->getRefUtilisateur(),
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
        $del = $bdd->getBdd()->prepare('DELETE FROM representant WHERE ref_utilisateur = :id');
        $del->execute(array(
            'id'=>$this->getRefUtilisateur()
        ));
    }

    public function isRepresentant($bdd){
        $is = $bdd->getBdd()->prepare('SELECT * FROM representant WHERE ref_utilisateur = :id');
        $is->execute(array(
            'id' => $this->getRefUtilisateur()
        ));
        $res1 = $is->fetch();
        return $res1;
    }
    /**
     * @return mixed
     */
    public function getRefUtilisateur()
    {
        return $this->refutilisateur;
    }

    /**
     * @param mixed $refutilisateur
     */
    public function setRefUtilisateur($refutilisateur)
    {
        $this->refutilisateur = $refutilisateur;
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
        return $this->refhopital;
    }

    /**
     * @param mixed $refhopital
     */
    public function setRefHopital($refhopital)
    {
        $this->refhopital = $refhopital;
    }


}
