<?php

require_once '../bdd/Database.php';

class Hopital
{

    private $id;
    private $nom;
    private $rue;
    private $cp;
    private $bdd;


    public function __construct(array $donnees){
        $this->hydrate($donnees);
        $this->bdd = new Database();
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
     * @param mixed $rue
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
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
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    public function selectHopital(){

        $sel = $this->bdd->getBdd()->prepare("SELECT * FROM hopital");
        $sel->execute();
        $result = $sel->fetchAll();
        echo "Affichage de la table hopital";
        return $result;

    }

    public function addHopital(){

        $add = $this->bdd->getBdd()->prepare("INSERT INTO hopital (nom, rue, cp) VALUES :nom, :rue, :cp");
        $add->execute(array(
            'nom'=>$this->getNom(),
            'rue'=>$this->getRue(),
            'cp'=>$this->getCp()
        ));
        echo "Hopital ajouté";

    }

    public function editHopital(){

        $edit = $this->bdd->getBdd()->prepare("UPDATE hopital SET nom = :nom, rue = :rue, cp = :cp WHERE id_hopital = :id");
        $edit->execute(array(
            'nom'=>$this->getNom(),
            'rue'=>$this->getRue(),
            'cp'=> $this->getCp(),
            'id'=>$this->getId()
        ));
        echo "Hopital édité par le nom : ".$this->getNom().", la rue : ".$this->getRue()." et le cp par : ".$this->getCp();

    }

    public function deleteHopital(){

        $del = $this->bdd->getBdd()->prepare("DELETE FROM hopital WHERE id_hopital = :id");
        $del->execute(array(
            'id'=>$this->getId()
        ));
        echo "Hopital supprimé";

    }
}