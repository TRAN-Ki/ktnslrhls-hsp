<?php



class Logs
{

    private $id;
    private $nom;
    private $date;
    private $heure;
    private $ref;


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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
     * @param mixed $ref
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
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
    public function getNom()
    {
        return $this->nom;
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
    public function getRef()
    {
        return $this->ref;
    }

    public function selectLogs($bdd){

        $sel = $bdd->getBdd()->prepare("SELECT * FROM log");
        $sel->execute();
        $result = $sel->fetchAll();
        echo "Affichage de la table log";
        return $result;

    }

    public function addLogs($bdd){

        $add = $bdd->getBdd()->prepare("INSERT INTO log (nom, date_log, heure, ref_utilisateur) VALUES (:nom, :datelog, :heure, :ref)");
        $add->execute(array(
            'nom'=>$this->getNom(),
            'datelog'=>$this->getDate(),
            'heure'=>$this->getHeure(),
            'ref'=>$this->getRef()
        ));
        echo "Log ajouté";

    }

    public function editLogs($bdd){

        $edit = $bdd->getBdd()->prepare("UPDATE log SET nom = :nom, date_log = :datelog, heure = :heure, ref_utilisateur = :ref WHERE id_log = :id");
        $edit->execute(array(
            'nom'=>$this->getNom(),
            'datelog'=>$this->getDate(),
            'heure'=>$this->getHeure(),
            'ref'=>$this->getRef(),
            'id'=>$this->getId()
        ));
        echo "Log édité par le nom : ".$this->getNom().", la date : ".$this->getDate().", l'heure : ".$this->getHeure()." et la ref de l'utilisateur : ".$this->getRef();

    }

    public function deleteLogs($bdd){

        $del = $bdd->getBdd()->prepare("DELETE FROM log WHERE id_log = :id");
        $del->execute(array(
            'id'=>$this->getId()
        ));
        echo "Log supprimé";

    }
}