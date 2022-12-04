<?php

class Utilisateur
{
    private $id;
    private $nom;
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

    public function validUser($bdd){
        $mod = $bdd->getBdd()->prepare("UPDATE utilisateur SET actif = 1 WHERE id_utilisateur = :id");
        $mod->execute(array(
            'id'=>$this->getId()
        ));
    }

    public function selectUserMdpOublie($bdd){
        $req = $bdd->getBdd()->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $req->execute(array(
            'email'=>$this->getEmail()
        ));
        return $req->fetch();
    }

    public function selectUtilisateur($bdd){
        $sel = $bdd->getBdd()->prepare("SELECT * FROM utilisateur");
        $sel->execute();
        $result = $sel->fetchAll();
        return $result;
    }

    public function selectUtilisateurToValid($bdd){
        $sel = $bdd->getBdd()->prepare("SELECT * FROM utilisateur WHERE actif = 0 AND admin = 0");
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
            'actif'=>$this->getActif(),
            'id'=>$this->getId()
        ));
    }

    public function deleteUtilisateur($bdd){
        $del = $bdd->getBdd()->prepare('DELETE FROM utilisateur WHERE id_utilisateur = :id');
        $del->execute(array(
            'id'=>$this->getId()
        ));
    }

    public function updateUtilisateurByUser($bdd){

        $mod = $bdd->getBdd()->prepare("UPDATE utilisateur SET email = :email, mdp = :mdp WHERE id_utilisateur = :id");
        $mod->execute(array(
            'email'=>$this->getEmail(),
            'mdp'=>$this->getMdp(),
        ));
    }
    public function selectUtilisateurByEmail($bdd){
        $sel = $bdd->getBdd()->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $sel->execute(array(
            'email'=>$this->getEmail()
        ));
        $result = $sel->fetch();
        return $result;
    }

    public function testLogin($bdd){
        $test = $bdd->getBdd()->prepare("SELECT * FROM Utilisateur WHERE email = :email");
        $test->execute(array(
            'email'=>$this->getEmail()
        ));
        $res = $test->fetch();
        return $res;
    }
    public function testRegister($bdd){
        $test = $bdd->getBdd()->prepare("SELECT * FROM Utilisateur WHERE (nom = :nom, prenom = :prenom, email = :email, mdp = :mdp)");
        $test->execute(array(
            'nom' => $this->getNom(),
            'prenom' => $this->getPrenom(),
            'email' => $this->getEmail(),
            'mdp' => $this->getMdp()
        ));
        $res = $test->fetch();
        return $res;
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
    public function setId($id)
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