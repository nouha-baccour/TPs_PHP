<?php
require_once 'app\models\Model.php';
class ModelUser extends Model{
	private $data=array();
	// La syntaxe ... = NULL signifie que l'argument est optionel
	// Si un argument optionnel n'est pas fourni,
	// alors il prend la valeur par défaut, NULL dans notre cas
	public function __construct($db,$id=null,$username=null, $password=null){
        parent::__construct($db, 'user');
		if (!is_null($id) && !is_null($username) && !is_null($password)) {
			// Si aucun des paramètre n'est nul,
			// c'est forcement qu'on les a fournis
			// donc on retombe sur le constructeur à 3 arguments
			$this->data['id'] = $id;
			$this->data['username'] = $username;
			$this->data['password'] = $password;
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
    public function findUser($username, $password) {
        try {
            $sql = "SELECT * FROM user where username=? AND password=?"; 
            $params = array($username, $password);
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
            // Handle database-related exceptions, e.g., connection errors, SQL errors
            // You can log the error or perform other actions as needed
            // Throw or return an error message or response if necessary
            // Example: throw new Exception("Error finding all data: " . $e->getMessage());
        }
    }
}