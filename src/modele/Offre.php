<?php



class Offre
{

    private $id;
    private $libelle;
    private $description;
    private $ref_type;
    private $ref_representant;


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
    public function getRefType()
    {
        return $this->ref_type;
    }

    /**
     * @param mixed $ref_type
     */
    public function setRefType($ref_type): void
    {
        $this->ref_type = $ref_type;
    }

    /**
     * @return mixed
     */
    public function getRefRepresentant()
    {
        return $this->ref_representant;
    }

    /**
     * @param mixed $ref_representant
     */
    public function setRefRepresentant($ref_representant): void
    {
        $this->ref_representant = $ref_representant;
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
        $add = $bdd->getBdd()->prepare("INSERT INTO offre (libelle, description, ref_type, ref_representant) VALUES (:libelle, :description, :ref_type, :ref_representant)");
        $add->execute(array(
            'libelle'=>$this->getLibelle(),
            'description'=>$this->getDescription(),
            'ref_type'=>$this->getRefType(),
            'ref_representant'=>$this->getRefRepresentant()
        ));
    }

    public function editOffre($bdd){

        $edit = $bdd->getBdd()->prepare("UPDATE offre SET libelle = :libelle, description = :description, ref_type = :ref_type, ref_representant = :ref_representant WHERE id_offre = :id");
        $edit->execute(array(
            'libelle'=>$this->getLibelle(),
            'description'=>$this->getDescription(),
            'ref_type'=>$this->getRefType(),
            'ref_representant'=>$this->getRefRepresentant(),
            'id'=>$this->getId()
        ));
        echo "Offre édité par le libelle";

    }

    public function deleteOffre($bdd){

        $del = $bdd->getBdd()->prepare("DELETE FROM offre WHERE id_offre = :id");
        $del->execute(array(
            'id'=>$this->getId()
        ));
        echo "Offre supprimé";

    }
}
