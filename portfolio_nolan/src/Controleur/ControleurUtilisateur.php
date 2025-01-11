<?php

namespace App\Covoiturage\Controleur;

use App\Covoiturage\Modele\HTTP\Session;

use App\Covoiturage\Modele\HTTP\Cookie;

class ControleurUtilisateur extends ControleurGenerique
{
    public static function afficherListe(): void
    {
        $utilisateurs = (new UtilisateurRepository())->recuperer();
        self::afficherVue('vueGeneral.php', ['utilisateurs' => $utilisateurs, "titre" => "Liste des utilisateurs", "cheminCorpsVue" => "utilisateur/liste.php"]);
    }




    public static function afficherHomePage(){


        self::afficherVue('vueGeneral.php',[ "titre" => "Liste des utilisateurs", "cheminCorpsVue" => "homePage.php"]);
    }
    public static function afficherProjets(){


        self::afficherVue('vueGeneral.php',[ "titre" => "Liste des utilisateurs", "cheminCorpsVue" => "projets.php"]);
    }
    public static function afficherProfil()
    {
        self::afficherVue('vueGeneral.php',[ "titre" => "Liste des utilisateurs", "cheminCorpsVue" => "profil.php"]);

    }

    public static function afficherDetailProjet()
    {
       require_once __DIR__ . "/../vue/projet/pageBase.html";


    }




    public static function telecharger()
    {



        $file = '../ressources/img/cv.pdf'; // Remplace par le chemin réel du fichier

        if (file_exists($file)) {
            // Définir les en-têtes pour le téléchargement
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));

            // Nettoyer le tampon de sortie
            ob_clean();
            flush();

            // Lire le fichier pour forcer le téléchargement
            readfile($file);
            exit;
        } else {
            echo "Le fichier demandé n'existe pas.";
        }

    }








    public static function deposerCookie(): void
    {
        $nom_cookie = "user";
        $valeur_cookie = "John Doe";
        $temps_expiration = time() + (130);
        Cookie::enregistrer($nom_cookie, $valeur_cookie, $temps_expiration);
    }

    public static function lireCookie(): void
    {
        Cookie::lire("TestCookie");
    }

    public static function lireAdresseIp(): void
    {
        $user_ip = $_SERVER['REMOTE_ADDR'];
        echo "Adresse IP de l'utilisateur : " . $user_ip;
    }

    public function testSession(): void
    {
        $session = Session::getInstance();
        $session->enregistrer("utilisateur", "Cathy Penneflamme");
        echo "Utilisateur: " . $session->lire("utilisateur") . "<br>";
        echo "La variable 'utilisateur' existe-t-elle? " . ($session->contient("utilisateur") ? "Oui" : "Non") . "<br>";
        $session->supprimer("utilisateur");
        echo "La variable 'utilisateur' existe-t-elle après suppression? " . ($session->contient("utilisateur") ? "Oui" : "Non") . "<br>";
        $session->detruire();
        echo "Session détruite.";
    }
}
?>
