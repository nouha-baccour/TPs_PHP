<?php
require_once 'app\models\ModelProduit.php';
require_once 'app\models\Model.php';
require_once 'app\models\Database.php';
require_once 'app\controllers\Controller.php';
require_once 'app/views/View.php';

class ControllerProduit extends Controller{
    private $model;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $this->model = new ModelProduit($db);
    }
    public static function loggedOnly(){
		if(session_status() == PHP_SESSION_NONE){
			session_start(); 
		}		
		if(!isset($_SESSION['auth'])){
			//$_SESSION['flash']['danger'] = "Vous  n'avez pas le droit d'accèder à cette page";
			require ('view/Acceuil/login.php'); //redirige vers la vue
			exit();
		  }
	}
	public static function search() {
		self::loggedOnly();
		$c = $_GET['c'];
		$db = Database::getInstance()->getConnection();
        $model = new ModelProduit($db);
		$produits = $model->getbyDesignation($c); //appel au modèle pour gerer la BD
		//var_dump ($produits); die();
		$controller = "Produit";
		require ('app/views/Produit/listFilter.php');  //redirige vers la vue
	}
    public function index() {
		self::loggedOnly();
        $produits  = $this->model->findAll();
        $controller = "Produit";
        include('app/views/Produit/list.php');
    }
    public function create() {
		self::loggedOnly();
        $db = Database::getInstance()->getConnection();
        $modelCategorie = new Model ($db, "categorie");
		$categories=$modelCategorie->findAll();
        include('app/views/Produit/add.php');//redirige vers la vue
    }
    public function createProcess() {
		self::loggedOnly();
        //traitement du formulaire
		if (!empty($_POST)){
			// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
			if (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
			{
				// Testons si le fichier n'est pas trop gros
				if ($_FILES['image']['size'] <= 1000000)
				{
					// Testons si l'extension est autorisée
					$fileInfo = pathinfo($_FILES['image']['name']);
					$extension = $fileInfo['extension'];
					$allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
					if (in_array($extension, $allowedExtensions))
					{
					// On peut valider le fichier et le stocker définitivement
					move_uploaded_file($_FILES['image']['tmp_name'], 'assests/images/' . basename($_FILES['image']['name']));
					$image = basename($_FILES['image']['name']);
					//echo "L'envoi a bien été effectué !";
					}
				}
			}
			if ($_FILES['image']['error'] != 0 && !empty($_POST['image2'])){
				$image = $_POST['image2'];
			}
			if ($_FILES['image']['error'] != 0 && empty($_POST['image2'])){
				$image = "erreur";
			}
			$p = ['designation'=>$_POST['designation'],
                'prix'=>$_POST['prix'],
                'Qte'=>$_POST['Qte'],
                'image'=>$image,
                'code_categorie'=>$_POST['code_categorie']];
            
            
            
            $errors = array();
			if (empty($_POST['designation']) || empty($_POST['prix']) || empty($_POST['Qte']) || ($_FILES['image']['error'] != 0 && empty($_POST['image2']))){
				$errors['remplir']='Veuillez remplir tous les champs manquants';
			}
			if (!empty($_POST['prix']) && !is_numeric($_POST['prix'])){
				$errors['prix'] = 'Le prix doit être un nombre';
				$p['prix'] = '';
			}
			if (!empty($_POST['Qte']) && ! is_numeric($_POST['Qte'])){
				$errors['Qte'] = 'La quantité doit être un nombre';
				$p['Qte']  = '';
			}
		}else{
			$errors['remplir']='Formulaire vide';
			$p = ['designation'=>'',
                'prix'=>'',
                'Qte'=>'',
                'image'=>'',
                'code_categorie'=>''];
		}
		
		//le formulaire contient des données valides prête a étre enregistrées dans la base
		if (empty($errors)){
			if(isset($_POST['code'])){
                $status = $this->model->update($_POST['code'],$p);
			}
			else{
				$status = $this->model->save($p);
			}
			if ($status)
				$this->index();
			else{
				$message='duppCode';
				require ('view/produit/error.php');
			}
		}
		else{
			$db = Database::getInstance()->getConnection();
            $modelCategorie = new Model ($db, "categorie");
		    $categories=$modelCategorie->findAll();
			if(isset($_POST['code'])){
				$p['code'] = $_POST['code']; 
				require ('app/views/produit/update.php');
			}
			else{
				require ('app/views/produit/add.php');
			}
		}
		
    }
    public function edit(){
		self::loggedOnly();
        $db = Database::getInstance()->getConnection();
        $modelCategorie = new Model ($db, "categorie");
		$categories=$modelCategorie->findAll();
		$code = $_GET['code'];
		$p = $this->model->find($code);
		require ('app\views\produit/update.php');//redirige vers la vue
    }
    public function delete(){
		self::loggedOnly();
        $code = $_GET['code']; 
		$status = $this->model->delete($code);
		if (!$status){
			$message='prodnotfound';
			require ('app\views/produit/error.php');//redirige vers la vue
		}
		else{
			$this->index();
		}
		
    }
// Other actions...
}