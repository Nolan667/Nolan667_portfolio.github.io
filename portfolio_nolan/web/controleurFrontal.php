<?php

use App\Covoiturage\Controleur\ControleurGenerique;
use App\Covoiturage\Controleur\ControleurUtilisateur;
use App\Covoiturage\Lib\PreferenceControleur;

require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';


$chargeurDeClasse = new App\Covoiturage\Lib\Psr4AutoloaderClass(false);
$chargeurDeClasse->register();
$chargeurDeClasse->addNamespace('App\Covoiturage', __DIR__ . '/../src');


$controleurDefaut = 'utilisateur';




$action = $_GET['action'] ?? 'afficherHomePage';
$controleur = $_GET['controleur_defaut'] ?? $controleurDefaut;


$classeControleur = 'App\Covoiturage\Controleur\Controleur' . ucfirst($controleur);


if (!class_exists($classeControleur)) {
    ControleurGenerique::afficherErreur("Le contrôleur {$classeControleur} n'existe pas.");
}


$instanceControleur = new $classeControleur();


// Vérifie si la méthode existe
if (method_exists($instanceControleur, $action)) {
    // Récupérer le paramètre 'login' de l'URL s'il existe
    $login = $_GET['login'] ?? null;

    // Si l'action attend un argument, on le passe
    if ($login) {
        $instanceControleur->$action($login);  // Appel avec argument
    } else {
        $instanceControleur->$action();  // Appel sans argument
    }
} else {
    ControleurGenerique::afficherErreur("La méthode {$action} n'existe pas dans le contrôleur {$classeControleur}.");
}

?>
