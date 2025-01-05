<?php

namespace App\Covoiturage\Controleur;

use App\Covoiturage\Lib\ConnexionUtilisateur;
use App\Covoiturage\Lib\MotDePasse;
use App\Covoiturage\Lib\VerificationEmail;
use App\Covoiturage\Modele\DataObject\Utilisateur;
use App\Covoiturage\Modele\HTTP\Session;
use App\Covoiturage\Modele\Repository\UtilisateurRepository;
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







    public static function afficherFormulaireConnexion(): void
    {
        self::afficherVue("vueGeneral.php", ["titre" => "Formulaire de connexion", "cheminCorpsVue" => "utilisateur/formulaireConnexion.php"]);
    }

    public static function supprimer(): void
    {
        if (!isset($_GET['login'])) {
            self::afficherErreur("Aucun login spécifié pour la suppression.");
            return;
        }

        $login = $_GET['login'];

        if (!ConnexionUtilisateur::estAdministrateur()) {
            self::afficherErreur("Seul un administrateur peut supprimer un utilisateur.");
            return;
        }

        $utilisateurRepository = new UtilisateurRepository();
        $utilisateur = $utilisateurRepository->recupererParClePrimaire($login);

        if ($utilisateur === null) {
            self::afficherErreur("Le login spécifié n'existe pas.");
            return;
        }

        $utilisateurRepository->supprimer($utilisateur->getLogin());

        self::afficherVue('vueGeneral.php', [
            'titre' => "Suppression d'utilisateur",
            'cheminCorpsVue' => "utilisateur/utilisateurSupprime.php",
            'login' => $login
        ]);
    }

    public static function afficherFormulaireMiseAJour($login): void
    {
        $utilisateurRepository = new UtilisateurRepository();
        $utilisateur = $utilisateurRepository->recupererParClePrimaire($login);

        if ($utilisateur === null) {
            self::afficherErreur("Login inconnu.");
            return;
        }


        if ($utilisateur->getLogin() !== ConnexionUtilisateur::getLoginUtilisateurConnecte() && !ConnexionUtilisateur::estAdministrateur()) {
            self::afficherErreur("La mise à jour n'est possible que pour l'utilisateur connecté.");
            return;
        }

        $estAdministrateur = ConnexionUtilisateur::estAdministrateur();

        self::afficherVue('vueGeneral.php', [
            'titre' => 'Formulaire de mise à jour',
            'cheminCorpsVue' => 'utilisateur/formulaireMiseAJour.php',
            'utilisateur' => $utilisateur,
            'estAdministrateur' => $estAdministrateur
        ]);
    }

    public static function mettreAJour(): void
    {
        $titre = "Détails utilisateur";
        $cheminCorpsVue = "utilisateur/utilisateurMisAJour.php";

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $tableauDonneesFormulaire = [
                'login' => $_GET['login'] ?? '',
                'nom' => $_GET['nom'] ?? '',
                'prenom' => $_GET['prenom'] ?? '',
                'admin' => $_GET['admin'] ?? '',
                'nvPassword' => $_GET['nvPassword'] ?? '',
                'ncPassword' => $_GET['ncPassword'] ?? '',
                'ancienMdp' => $_GET['ancienMdp'] ?? '',
            ];

            $utilisateurRepository = new UtilisateurRepository();
            $utilisateur = $utilisateurRepository->recupererParClePrimaire($tableauDonneesFormulaire['login']);

            if ($utilisateur === null) {
                self::afficherErreur("Le login n'existe pas.");
                return;
            }

            // Vérification des droits d'accès
            if ($utilisateur->getLogin() !== ConnexionUtilisateur::getLoginUtilisateurConnecte() && !ConnexionUtilisateur::estAdministrateur()) {
                self::afficherErreur("La mise à jour n'est possible que pour l'utilisateur connecté ou par un administrateur.");
                return;
            }

            // Validation des mots de passe
            if (!empty($tableauDonneesFormulaire['nvPassword']) || !empty($tableauDonneesFormulaire['ncPassword'])) {
                if ($tableauDonneesFormulaire['nvPassword'] !== $tableauDonneesFormulaire['ncPassword']) {
                    self::afficherErreur("Les deux nouveaux mots de passe doivent correspondre.");
                    return;
                }

                // Vérification de l'ancien mot de passe
                if (!MotDePasse::verifier($tableauDonneesFormulaire['ancienMdp'], $utilisateur->getMdpHache())) {
                    self::afficherErreur("L'ancien mot de passe est incorrect.");
                    return;
                }

                // Hachage du nouveau mot de passe
                $utilisateur->setMdpHache(MotDePasse::hacher($tableauDonneesFormulaire['nvPassword']));
            }

            // Mise à jour des informations de l'utilisateur
            $utilisateur->setNom($tableauDonneesFormulaire['nom']);
            $utilisateur->setPrenom($tableauDonneesFormulaire['prenom']);

            if (ConnexionUtilisateur::estAdministrateur()) {
                $utilisateur->setEstAdmin($tableauDonneesFormulaire['admin'] === '1');
            } else {
                $utilisateur->setEstAdmin(false);
            }

            $utilisateurRepository->mettreAJour($utilisateur);

            self::afficherVue('vueGeneral.php', ['titre' => $titre, 'cheminCorpsVue' => $cheminCorpsVue, 'utilisateur' => $utilisateur]);
        }
    }

    public static function connecter(): void
    {
        $session = Session::getInstance();

        $login = $_GET['login'];
        $mdp = $_GET['mdp'];

        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);

        if ($utilisateur) {

           if (VerificationEmail::aValideEmail($utilisateur)) {

            if (MotDePasse::verifier($mdp, $utilisateur->getMdpHache())) {


                    ConnexionUtilisateur::connecter($utilisateur->getLogin());
                    self::afficherVue('vueGeneral.php', [
                        'cheminCorpsVue' => 'utilisateur/utilisateurConnecte.php',
                        'utilisateur' => $utilisateur,
                        'titre' => 'Utilisateur connecté'
                    ]);
                    return;
                }

                self::afficherErreur("Login et/ou mot de passe incorrect. Tentatives restantes : "); //. (5 - $session->getTentatives()));

            }

            self::afficherErreur("Problème avec l'envoi de l'email de validation.");

        }
        self::afficherErreur("user non trouvé");

        // $session->incrementerTentatives();
    }




    public static function vueUserConnecter(): void
    {
        self::afficherVue('vueGeneral.php', ['cheminCorpsVue' => 'utilisateur/utilisateurConnecte.php', 'titre' => 'Utilisateur connecter']);
    }

    public static function deconnecter(): void
    {
        ConnexionUtilisateur::deconnecter();
        self::afficherVue('vueGeneral.php', ['cheminCorpsVue' => 'utilisateur/utilisateurDeconnecte.php', 'titre' => 'Utilisateur déconnecté']);
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
