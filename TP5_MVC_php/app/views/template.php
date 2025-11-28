<?php require "app/views/header.php"; ?>
<?php require "app/views/navigation.php"; ?>
<div id="outer" class="container d-flex align-items-center justify-content-center">
<h1 class="h2"><?= $titre ?></h1>
    <div id="inner">
        <?= $contenu ?>
    </div>
</div>

<?require "app/views/footer.php";?>