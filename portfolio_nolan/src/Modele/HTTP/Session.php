<?php
namespace App\Covoiturage\Modele\HTTP;

use App\Covoiturage\Configuration\ConfigurationSite;
use Exception;

class Session
{
private static ?Session $instance = null;
private int $dureeExpiration = 0; // Durée d'expiration en secondes


/**
* @throws Exception
*/
private function __construct()
{
if (session_start() === false) {
throw new Exception("La session n'a pas réussi à démarrer.");
}


    $this->dureeExpiration = ConfigurationSite::getDureeExpirationSession();

    // Vérifier la dernière activité
    $this->verifierDerniereActivite();

}

public static function getInstance(): Session
{
if (is_null(Session::$instance))
Session::$instance = new Session();
return Session::$instance;
}

public function contient($nom): bool
{

    if(isset($_SESSION[$nom])){

        return true;
}
return false;


}

public function enregistrer(string $nom, mixed $valeur): void
{
    $_SESSION[$nom] = $valeur;


}

public function lire(string $nom): mixed
{


    if(isset($_SESSION[$nom])){
        return $_SESSION[$nom];
    }
    return null;




}

public function supprimer($nom): void
{
    unset($_SESSION[$nom]);


}

public function detruire() : void
{
session_unset();     // unset $_SESSION variable for the run-time
session_destroy();   // destroy session data in storage
Cookie::supprimer(session_name()); // deletes the session cookie
// Il faudra reconstruire la session au prochain appel de getInstance()
Session::$instance = null;
}



public function verifierDerniereActivite()
{
    if (isset($_SESSION['derniereActivite']) && (time() - $_SESSION['derniereActivite'] > ($this->dureeExpiration)))
        session_unset();     // unset $_SESSION variable for the run-time

    $_SESSION['derniereActivite'] = time(); // update last activity time stamp



}

}

