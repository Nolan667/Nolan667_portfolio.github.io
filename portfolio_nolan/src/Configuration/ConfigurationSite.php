<?php

namespace App\Covoiturage\Configuration;

class ConfigurationSite
{
    // Durée d'expiration de la session en secondes (ex : 30 minutes)
    public static function getDureeExpirationSession(): int
    {
        return 30 * 60; // 30 minutes
    }


    public static function getDebug()
    {


    }


    public static function getURLAbsolue(): string {


        return 'http://localhost:8080/TD8/web/controleurFrontal.php';

    }
}
