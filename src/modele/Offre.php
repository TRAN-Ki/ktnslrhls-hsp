<?php



class Offre
{

    private $id;
    private $libelle;
    private $description;


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
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function selectOffre($bdd){

        $sel = $bdd->getBdd()->prepare("SELECT * FROM offre");
        $sel->execute();
        $result = $sel->fetchAll();
        return $result;

    }

    public function addOffre($bdd){

        $add = $bdd->getBdd()->prepare("INSERT INTO offre (libelle, description) VALUES (:libelle,:description)");
        $add->execute(array(
            'libelle'=>$this->getLibelle(),
            'description'=>$this->getDescription()
        ));
        echo "Offre ajouté";

    }

    public function editOffre($bdd){

        $edit = $bdd->getBdd()->prepare("UPDATE offre SET libelle = :libelle, description = :description WHERE id_offre = :id");
        $edit->execute(array(
            'libelle'=>$this->getLibelle(),
            'description'=>$this->getDescription(),
            'id'=>$this->getId()
        ));
        echo "Offre édité par le libelle : ".$this->getLibelle()." et la description par : ".$this->getDescription();

    }

    public function deleteOffre($bdd){

        $del = $bdd->getBdd()->prepare("DELETE FROM offre WHERE id_offre = :id");
        $del->execute(array(
            'id'=>$this->getId()
        ));
        echo "Offre supprimé";

    }
}