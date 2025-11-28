<?php
if(session_status() == PHP_SESSION_NONE){
	session_start(); 
}?>

<?php
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
//requête SQL: definition and exécution 
$req = "SELECT * FROM categorie";
$result=$pdo->query($req); 
$categories = $result->fetchAll(PDO::FETCH_OBJ);

//recuperation du produit à mettre à jour
$code = $_GET["code"];
$req = "SELECT * FROM produit where code=?";
$params = array($code);
$resultat = $pdo->prepare($req);
$resultat->execute($params);
if(!$resultat) {
    echo "Lecture impossible";
}
else{
    $p = $resultat->fetch(PDO::FETCH_OBJ);
}

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
              move_uploaded_file($_FILES['image']['tmp_name'], 'inc/images/' . basename($_FILES['image']['name']));
              //echo "L'envoi a bien été effectué !";
            }
        }
    }

    $p->designation = $_POST['designation'];
    $p->prix = $_POST['prix'];
    $p->Qte = $_POST['Qte'];
    $p-> code_categorie = $_POST['code_categorie'];
    $p->image = basename($_FILES['image']['name']);

    $errors = array();
    if (empty($_POST['designation']) || empty($_POST['prix']) || empty($_POST['Qte']) ){
      $errors['remplir']='Veuillez remplir tous les champs manquants';
    }
    if($_FILES['image']['error'] == 0 && empty($p->image)){
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
}

//le formulaire contient des données valides prête a étre enregistrées dans la base
if (!empty($_POST) && empty($errors)){
    $req = "UPDATE produit SET designation=:designation, prix=:prix, Qte=:qte, code_categorie=:categorie WHERE code=:code";
    $params = array('designation'=>$p->designation, 
                    'prix'=>$p->prix, 
                    'qte'=>$p->Qte, 
                    'categorie'=>$p->code_categorie, 
                    'code'=>$code);//var_dump($params);

    $resultat = $pdo->prepare($req);
    $resultat->execute($params);
    if($resultat){
        header('Location: crudProduits.php');
        exit();
    }
    else{?>
    <div class="alert alert-danger">
        Erreur dans l'enregistremet!
        </div>
    <?php 
    }
}?>

<?php if(!empty($errors)):?>
  <div class="alert alert-danger">
      <p> Vous n'avez pas rempli le formulaire correctement: </p>
      <ul>
<?php foreach($errors as $error):?>
          <li> <?= $error?></li>
<?php endforeach;?>
      </ul>
  </div>
<?php endif;?>
  
<?php
require('inc/header.php');
?>
<div class="card mx-auto" style="max-width: 30rem;">
  <div class="card-header bg-success text-white">
    Ajout Produit
  </div>
  <div class="card-body">
    <form action="" method=POST enctype="multipart/form-data">

      <div class="form-group">
        <label for="">Designation:</label>
        <input type="text" class="form-control" name="designation" value=<?=$p->designation?>>
      </div>
      
      <div class="form-group">
        <label for="">Catégorie:</label>
        <select class="form-control" name="code_categorie">
<?php 
            foreach($categories as $c){?>
              <option value=<?=$c->code?>><?=$c->nom?></option>
<?php }?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Prix unitaire:</label>
        <input type="text" class="form-control" name="prix" value=<?= $p->prix?>>
      </div>
      <div class="form-group">
        <label for="">Quantité:</label>
        <input type="text" class="form-control" name="Qte" value=<?=$p->Qte?>>
      </div>
      <!-- Ajout champ d'upload ! -->
      <div class="form-group">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image"/>
      </div>
      <!-- Fin ajout du champ -->
      <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>       
  </div>
</div>

<?php
require('inc/footer.php');
?>