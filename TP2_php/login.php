<?php 
if(session_status() == PHP_SESSION_NONE){
	session_start();
} 

$_users[0]['username']='admin';
$_users[0]['password']='admin';
$_users[1]['username']='nouha';
$_users[1]['password']='nouha';
$_users[2]['username']='youssef';
$_users[2]['password']='youssef';

//database connexion
$host="localhost";
$base="magasin";
$user="root";
$pass="";
try{
  $pdo= new PDO("mysql:host=$host;dbname=$base" ,$user,$pass) ;
}
catch(PDOException $except){
  echo"Echec de la connexion: ". $except->getMessage();
die();
}
//definition and exécution de la requête SQL:
$req="SELECT * FROM user"; 
$result=$pdo->query($req); 
$_users = $result->fetchAll(PDO::FETCH_ASSOC);
// $_users contient le tableau utilisateurs



if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
   $user=null;
   foreach($_users as $row){
    if (($row['username'] == $_POST['username']) && ($row['password'] == $_POST['password'])){
      $user = $row;
      $result->closeCursor(); 
      break;
    }
   }
    if($user == null){
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
    }else{
		$_SESSION['auth'] = $user;
    $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
    
    if($_POST['remember']){
			setcookie('username',$user['username'] , time() + 60 * 60 * 24 * 7);
      setcookie('password',$user['password'] , time() + 60 * 60 * 24 * 7);
    }
    elseif(!$_POST['remember']) {
			if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
				setcookie('username', null, -1);
				setcookie('password', null, -1);
		  }
    }
    header('Location: crudProduits.php');
    exit();
    }
  }
?>
<?php require "inc/header.php";?>
<main>
<section  style="background-color: #A1F799;">
  <div class="container py-5 h-80">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 ">


          <?php if(isset($_SESSION['flash'])):?>
            <?php foreach($_SESSION['flash'] as $type => $message):?>
                <div class="alert alert-<?= $type; ?>">
                  <?= $message; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']) ?>
          <?php endif; ?>

          <blockquote class="blockquote text-center">
            <p class="h3 mb-4 "> Se connecter </p>
          </blockquote>
          
          <form action="" method="POST">

          <div class="form-group mb-4">
            <label for=""> Pseudo ou e-mail</label>
            <input type="text" name="username" value ="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username'];?>" class="form-control" required>
          </div>

          <div class="form-group mb-4">
            <label for=""> Mot de passe <a href="forget.php"> (J'ai oublié mon mot de passe)</a></label>
            <input type="password" name="password" value ="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password'];?>" class="form-control" required>
          </div>

          <div class="form-group mb-4">
            <label>
              <input type="checkbox" name="remember"  value="1" <?php if(isset($_COOKIE['username'])) {echo 'checked="checked"';} else { echo ''; }?>  > Se souvenir de moi
            </label>
          </div>	
          <button type="submit" class="btn btn-primary btn-block">Se connecter</button><br>
          Vous n'avez pas un compte ?<a href="register.php">  s'inscrire </a>
          </form>


            

           

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</main> 











<?php require "inc/footer.php"; ?>