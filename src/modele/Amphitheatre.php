<?php



class Amphitheatre
{

    private $id;
    private $libelle;
    private $nb_places;


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
     * @param mixed $nb_places
     */
    public function setNbPlaces($nb_places)
    {
        $this->nb_places = $nb_places;
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
    public function getNbPlaces()
    {
        return $this->nb_places;
    }

    public function selectAmphitheatre($bdd){

        $sel = $bdd->getBdd()->prepare("SELECT * FROM amphitheatre");
        $sel->execute();
        $result = $sel->fetchAll();
        echo "Affichage de la table amphiteatre";
        return $result;

    }

    public function addAmphitheatre($bdd){

        $add = $bdd->getBdd()->prepare("INSERT INTO amphitheatre (libelle, nb_places) VALUES (:libelle,:nbplaces)");
        $add->execute(array(
            'libelle'=>$this->getLibelle(),
            'nbplaces'=>$this->getNbPlaces()
        ));
        echo "Amphiteatre ajouté";

    }

    public function editAmphitheatre($bdd){

        $edit = $bdd->getBdd()->prepare("UPDATE amphitheatre SET libelle = :libelle, nb_places = :nbplaces WHERE id_amphitheatre = :id");
        $edit->execute(array(
            'libelle'=>$this->getLibelle(),
            'nbplaces'=>$this->getNbPlaces(),
            'id'=>$this->getId()
        ));
        echo "Amphiteatre édité par le libelle : ".$this->getLibelle()." et le nombre de place par : ".$this->getNbPlaces();

    }

    public function deleteAmphitheatre($bdd){

        $del = $bdd->getBdd()->prepare("DELETE FROM ampitheatre WHERE id_amphitheatre = :id");
        $del->execute(array(
            'id'=>$this->getId()
        ));
        echo "Amphiteatre supprimé";

    }
}