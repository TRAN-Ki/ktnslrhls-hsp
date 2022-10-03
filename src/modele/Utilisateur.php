<?php

class Utilisateur
{
    private $id_utilisateur;
    protected $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $admin;
    private $actif;

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

    public function selectUtilisateur($bdd){
        $sel = $bdd->getBdd()->prepare("SELECT * FROM utilisateur");
        $sel->execute();
        $result = $sel->fetchAll();
        return $result;
    }


    public function addUtilisateur($bdd){
        $add = $bdd->getBdd()->prepare("INSERT INTO utilisateur (nom, prenom, email, mdp, admin, actif) VALUES (:nom , :prenom, :email, :mdp, :admin, :actif)");
        $add->execute(array(
            'nom'=>$this->getNom(),
            'prenom'=>$this->getPrenom(),
            'email'=>$this->getEmail(),
            'mdp'=>$this->getMdp(),
            'admin'=>$this->getAdmin(),
            'actif'=>$this->getActif()
        ));
    }

    public function updateUtilisateur($bdd){
        $mod = $bdd->getBdd()->prepare("UPDATE utilisateur SET nom = :nom , prenom = :prenom, email = :email, mdp = :mdp, admin = :admin, actif = :actif WHERE id_utilisateur = :id");
        $mod->execute(array(
            'nom'=>$this->getNom(),
            'prenom'=>$this->getPrenom(),
            'email'=>$this->getEmail(),
            'mdp'=>$this->getMdp(),
            'admin'=>$this->getAdmin(),
            'actif'=>$this->getActif()
        ));
    }

    public function deleteUtilisateur($bdd){
        $del = $bdd->getBdd()->prepare('DELETE representant FROM id_utilisateur = :id');
        $del->execute(array(
            'id'=>$this->getIdUtilisateur()
        ));
    }



    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * @param mixed $id_utilisateur
     */
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
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
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param mixed $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    }
}