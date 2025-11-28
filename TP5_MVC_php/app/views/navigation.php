<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link <?php if($controller == 'Home'){echo('active');}?>" href="index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if($controller == 'Produit'){echo('active');}?>" href="index.php?url=products">Produits</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php">Catégories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" href="index.php">Utilisateurs</a>
    </li>
  </ul>
</nav>