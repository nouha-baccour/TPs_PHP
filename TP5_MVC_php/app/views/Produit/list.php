<script>
		function suggest(str) {
	
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("table").innerHTML = this.responseText;
					}
				};
				xhr.open("GET", "index.php?url=products/search&c=" + str, true);
				xhr.send();
			
		}
</script>
<?php require "app/views/header.php"; ?>
<?php require "app/views/navigation.php"; ?>
<div id="outer" class="container d-flex align-items-center justify-content-center">


<main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">

                            <div class="col-sm-8"><h2>Gestion <b>produits</b></h2></div>
                            <div class="col-sm-4">
                            <div class="search-box mb-4" >
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Search&hellip;"onkeyup="suggest(this.value)">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4 ">
						<a href="index.php?url=products/create" class="btn btn-success float-right" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter Produit</span></a>						
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
                    <tbody id="table">
                        <?php
                        foreach($produits as $produit){ 
                            echo '<tr>';
                            echo '<td>'. $produit['code']. '</td>';
                            echo '<td>'. $produit['designation'] . '</td>';
                            echo '<td>'. $produit['categorie']. '</td>';
                            echo '<td>'. $produit['Qte'].'</td>';
                            echo '<td>'. $produit['prix']. '</td>';
                            echo '<td> <img src="assests/images/'.$produit['image'].'" style="width: 85px;"> </td>';
                        ?>
                            <td>
                                <a href="index.php?url=products/edit&code=<?=$produit['code']?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="index.php?url=products/delete&code=<?=$produit['code']?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
    

</div>

<?require "app/views/footer.php";?>
<!--<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> -->
