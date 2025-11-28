<?php
session_start();
//setcookie('username', NULL, -1);
//setcookie('password', NULL, -1);
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous êtes maintenat déconnecté";
header('Location: login.php');
