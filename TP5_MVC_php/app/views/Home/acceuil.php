<?php require "app/views/header.php"; ?>
<?php require "app/views/navigation.php"; ?>
<div id="outer" class="container d-flex align-items-center justify-content-center">
    <div id="inner">
</br></br></br></br>
    <h1>Bienvenue <?php echo($_SESSION['auth']['nom']."  ".$_SESSION['auth']['prenom']);?></h1>
    </div>
</div>

<?require "app/views/footer.php";?>

