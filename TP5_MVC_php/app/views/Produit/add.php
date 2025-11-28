
<?php
require_once('app/views/header.php');
?>


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
  


<div class="card mx-auto" style="max-width: 30rem;">
  <div class="card-header bg-success text-white">
    Ajout Produit
  </div>
  <div class="card-body">
    <form action="index.php?url=products/createProcess" method=POST enctype="multipart/form-data">

      <div class="form-group">
        <label for="">Designation:</label>
        <input type="text" class="form-control" name="designation" value=<?php if (isset($p)){echo($p['designation']);} else{echo('');}?>>
      </div>
      
      <div class="form-group">
        <label for="">Catégorie:</label>
        <select class="form-control" name="code_categorie">
        <?php 
            if(!isset($p)){
              foreach($categories as $c){?>
                <option value=<?=$c['code']?>><?=$c['nom']?></option>
              <?php }
            }
            else{ 
              foreach($categories as $c){?>
                <option <?php if($p['code_categorie']==$c['code']){echo('selected="selected"');}?>value=<?=$c['code']?>><?=$c['nom']?></option>
              <?php }
            }?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Prix unitaire:</label>
        <input type="text" class="form-control" name="prix" value=<?php if (isset($p)){echo($p['prix']);} else{echo('');}?>>
      </div>
      <div class="form-group">
        <label for="">Quantité:</label>
        <input type="text" class="form-control" name="Qte" value=<?php if (isset($p)){echo($p['Qte']);} else{echo('');}?>>
      </div>
      <!-- Ajout champ d'upload ! -->
      <div class="form-group">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image"/>
        <input type='hidden' name='image2' value=<?php if (isset($p)){echo($p['image']);} else{echo('');}?>>
      </div>
      <!-- Fin ajout du champ -->

      <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>       
  </div>
</div>

<?php
require('app/views/footer.php');
?>