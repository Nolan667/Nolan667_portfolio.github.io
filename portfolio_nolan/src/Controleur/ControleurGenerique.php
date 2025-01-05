<?php

namespace App\Covoiturage\Controleur;

use App\Covoiturage\Lib\PreferenceControleur;

class ControleurGenerique
{
    protected static function afficherVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres); // Create variables from the $parametres array
        require_once __DIR__ . '/../vue/' . $cheminVue; // Load the view
    }

    public static function afficherErreur(string $messageErreur = ""): void
    {
        ControleurUtilisateur::afficherVue('vueGeneral.php', ['message' => $messageErreur, "titre" => "ERREUR", "cheminCorpsVue" => 'utilisateur/erreur.php']); // Affichage d'une vue d'erreur
    }

    public static function enregistrerPreference()
    {
        $controleur = $_GET['controleur_defaut'];
        PreferenceControleur::enregistrer($controleur);
        self::afficherVue("vueGeneral.php",["cheminVue"=>'preferenceEnregistree.php']);
    }

    public static function afficherFormulairePreference()
    {
        self::afficherVue("vueGeneral.php",['cheminVue'=>'formulairePreference.php']);
    }
}
