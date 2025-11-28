<?php
require_once 'app\models\ModelUser.php';
require_once 'app\models\Model.php';
require_once 'app\models\Database.php';
require 'app\controllers\Controller.php';
require_once 'app/views/View.php';
class ControllerHome extends Controller{
     private $model;

     public static function loggedOnly(){
          if(session_status() == PHP_SESSION_NONE){
               session_start(); 
          }          
          if(!isset($_SESSION['auth'])){
               //$_SESSION['flash']['danger'] = "Vous  n'avez pas le droit d'accèder à cette page";
               require ('app/views/Home/login.php'); //redirige vers la vue
               exit();
          }
     }
     public function index() {
          self::loggedOnly();
          $controller = "Home";
          include('app/views/Home/acceuil.php');
     }
public static function loginProcess(){
     if(session_status() == PHP_SESSION_NONE){
          session_start(); 
     }          
     $controller='Home';
     if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
          $db = Database::getInstance()->getConnection();
          $model = new ModelUser($db);
          $user = $model->findUser($_POST['username'],$_POST['password']);
          if($user == null){
               $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
               require ('app/views/Home/login.php');
               exit();
          }else{
               $_SESSION['auth'] = $user;
               $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
               
               if(isset($_POST['remember']) && !empty($_POST['remember'])){
                    
                    setcookie('username',$user['username'] , time() + 60 * 60 * 24 * 7);
                    setcookie('password',$user['password'] , time() + 60 * 60 * 24 * 7);
               }
               else{
                         
                         if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
                              setcookie('username', null, -1);
                              setcookie('password', null, -1);
                         }
               }
               require ('app/views/Home/acceuil.php'); //redirige vers la vue
               exit();
          }

     }
     if(isset($_COOKIE['username']) && !isset($_SESSION['auth']) ){
          $db = Database::getInstance()->getConnection();
          $model = new ModelUser($db);
          $user = $model->findUser($_COOKIE['username'],$_COOKIE['password']);
          echo'ummm';
          $_SESSION['auth'] = $user;
     }
     if(isset($_SESSION['auth'])){
          require ('app/views/Home/acceuil.php'); 
          exit();
     }
}
public static function logout(){
     session_start();
     unset($_SESSION['auth']);
     $_SESSION['flash']['success'] = "Vous êtes maintenat déconnecté"; 
     require ('app/views/Home/login.php'); 
}

public function create(){}
public function edit(){}
public function delete(){}
// Other actions...
}