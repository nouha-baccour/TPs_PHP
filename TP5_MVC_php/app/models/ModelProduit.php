<?php
require_once 'app\models\Model.php';
class ModelProduit extends Model{
	private $data=array();
	// La syntaxe ... = NULL signifie que l'argument est optionel
	// Si un argument optionnel n'est pas fourni,
	// alors il prend la valeur par défaut, NULL dans notre cas
	public function __construct($db,$code=null,$designation=null, $prix=null, $qte=null, $categorie=null){
        parent::__construct($db, 'Produit');
		if (!is_null($designation) && !is_null($prix) && !is_null($qte) && !is_null($categorie)) {
			// Si aucun des paramètre n'est nul,
			// c'est forcement qu'on les a fournis
			// donc on retombe sur le constructeur à 3 arguments
			$this->data['code'] = $code;
			$this->data['designation'] = $designation;
			$this->data['prix'] = $prix;
			$this->data['qte'] = $qte;
			$this->data['categorie'] = $categorie;
		}
	}
	public function __get($attr){
		if (!isset($this->data[$attr]))
			return "erreur";
		else return ($this->data[$attr]);
	}
	
	public function __set($attr,$value) {
		$this->data[$attr] = $value; 
	}
    public function findAll() {
        try {
            $sql = "SELECT produit.code, produit.designation, produit.prix, produit.Qte, produit.image, categorie.nom as categorie
				FROM produit
				LEFT JOIN categorie
				ON code_categorie = categorie.code"; 
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
            // Handle database-related exceptions, e.g., connection errors, SQL errors
            // You can log the error or perform other actions as needed
            // Throw or return an error message or response if necessary
            // Example: throw new Exception("Error finding all data: " . $e->getMessage());
        }
    }
	public function getbyDesignation($c){
		$sql = "SELECT produit.code, produit.designation, produit.prix, produit.Qte, produit.image, categorie.nom as categorie
				FROM produit
				LEFT JOIN categorie
				ON code_categorie = categorie.code
				WHERE produit.designation LIKE ?";
		$params = array('%'.$c.'%');
		$stmt = $this->db->prepare($sql);
        $stmt->execute($params);
		if(!$stmt) {
			/*$erreur=$conn->errorInfo();
		    echo "Lecture impossible, code", $conn->errorCode(),$erreur[2];*/
		}
		else{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
			//return $result->fetchAll(PDO::FETCH_CLASS, 'Produit'); 
		}
	}
}