<?php 
if(session_status() == PHP_SESSION_NONE){
	session_start(); 
}
if(!isset($_SESSION['auth'])){
	$_SESSION['flash']['danger'] = "Vous  n'avez pas le droit d'accèder à cette page";
	header('Location:login.php');
	exit();
}
$produits[0]=array(
  "code" => 1,
  "designation"=>"Éclat automnal", 
  "categorie"=>"Roses rouge",
  "Qte"=>12,
  "prix"=>7,
  "image"=>"im1.jpg",
  "Promo"=>10);
$produits[1]=array(
    "code" => 2,
    "designation"=>"Délicate attention", 
    "categorie"=>"Roses rouge",
    "Qte"=>4,
    "prix"=>10,
    "image"=>"im2.png",
    "Promo"=>20);
$produits[2]=array(
    "code" => 3,
    "designation"=>"Bonne fête papa", 
    "categorie"=>"Bouquet",
    "Qte"=>30,
    "image"=>"im3.jpg",
    "prix"=>50,
    "Promo"=>30);
//print_r($produits[1]["designation"]);


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
$req="SELECT * FROM produit"; 
$result=$pdo->query($req); 
$produits = $result->fetchAll(PDO::FETCH_ASSOC);


?>

<?php require "inc/header.php";?>

<div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">

                            <div class="col-sm-8"><h2>Gestion <b>produits</b></h2></div>
                            <div class="col-sm-4">
                            <div class="search-box mb-4" >
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4 ">
						<a href="#addEmployeeModal" class="btn btn-success float-right" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter Produit</span></a>						
					</div>
                    </div>

                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Designation </i></th>
                            <th>Catégorie</th>
                            <th>Quantité de stock</th>
                            <th>Prix unitaire</th>
                            <th>Image </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($produits as $produit){ 
                            echo '<tr>';
                            echo '<td>'. $produit['code'] . '</td>';
                            echo '<td>'. $produit['designation'] . '</td>';
                            echo '<td>'. $produit['categorie'] . '</td>';
                            echo '<td>'. $produit['Qte'] . '</td>';
                            echo '<td>'. $produit['prix'] . '</td>';
                            echo '<td> <img src="inc/images/'.$produit['image'].'" style="width: 85px;"> </td>';
                        ?>
                            <td>
                                <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
                <!--
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </div>
                -->
            </div>
        </div>        
    </div>     

<?php require "inc/footer.php"; ?>