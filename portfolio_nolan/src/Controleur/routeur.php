<?php
require_once __DIR__ . 'ControleurUtilisateur.php';



$action = $_GET['action'];

ControleurUtilisateur::$action();





?>
