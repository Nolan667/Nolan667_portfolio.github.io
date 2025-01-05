<?php

namespace App\Covoiturage\Modele\HTTP;

class Cookie {

    public static function enregistrer(string $cle, mixed $valeur, ?int $dureeExpiration = null): void {

        $valeurCookie = serialize($valeur);

        if ($dureeExpiration === null) {

            setcookie($cle, $valeurCookie,0);
        } else {

            setcookie($cle, $valeurCookie, time() + $dureeExpiration);
        }
    }

    public static function lire(string $cle): mixed {

        if (isset($_COOKIE[$cle])) {
            return unserialize($_COOKIE[$cle]);
        }
        return null;
    }

    public static function existe(string $cle): bool {

        return isset($_COOKIE[$cle]);
    }

    public static function supprimer(string $cle): void {

        if (isset($_COOKIE[$cle])) {
            unset($_COOKIE[$cle]);

            setcookie($cle, '', 0);
        }
    }
}
