<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../ressources/css/homePage.css">
    <title><?php use App\Covoiturage\Lib\ConnexionUtilisateur; echo isset($titre) ? $titre : 'Titre par défaut'; ?></title>
</head>
<body>


<style>


    .l-header {
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: var(--z-fixed);
        background-color: var(--black-color);
    }

    .nav {
        height: var(--header-height);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: var(--font-bold);
    }
    /* Style général du menu */
    .nav-list {
        padding: 0;
        margin: 0;
        list-style: none;
        display: flex;
        justify-content: space-around;
    }

    /* Liens du menu principal */
    .nav-item {
        position: relative;
    }

    /* Style pour les liens du menu principal */
    .nav-link {
        text-decoration: none;
        display: block;
        padding: 10px 15px;
        color: #fff;
        background-color: black;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    /* Effet au survol du lien principal */
    .nav-item:hover .nav-link {
        background-color: #65537A;
    }

    /* Style du sous-menu (initialement caché) */
    .submenu {
        display: none; /* Cacher le sous-menu par défaut */
        position: absolute;
        left: 0;
        top: 100%;
        background-color: #2A2333;
        list-style: none;
        padding: 0;
        margin: 0;
        border-radius: 0 0 8px 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
    }

    /* Affichage du sous-menu lors du survol de l'élément parent */
    .nav-item:hover .submenu {
        display: block; /* Afficher le sous-menu quand le parent est survolé */
        animation: slideIn 0.3s ease-out;
    }

    /* Style des liens dans le sous-menu */
    .submenu-item {
        width: 200px;
    }

    .submenu-link {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: white;
        background-color: #333;
        border-radius: 4px;
        text-align: center;
        transition: background-color 0.3s;
    }

    /* Changement de couleur des liens au survol dans le sous-menu */
    .submenu-link:hover {
        background-color: #65537A;
    }

    /* Animation du sous-menu */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media screen and (max-width: 768px) {
        .nav-menu {
            position: fixed;
            top: -100%;
            left: 0;
            background-image: linear-gradient(to bottom, var(--black-color), var(--first-color));
            width: 100%;
            height: 35%;
            padding: 1.5rem;
            border-radius: 0 0 1rem 1rem;
            transition: 0.5s;
        }

        .show {
            top: var(--header-height);
        }
    }

    @media screen and (min-width: 768px) {
        :root {
            --h1-font-size: 4.5rem;
            --h2-font-size: 2rem;
            --normal-font-size: 1rem;
            --small-font-size: 1.37rem;
        }

        body {
            margin: 0;
        }

        .l-main {
            height: 100vh;
        }

        .nav {
            height: var(--header-height) + 1rem;
        }

        .nav.bd-grid {
            padding: 1rem;
        }

        .nav-list {
            display: flex;
            padding-top: 0;
        }

        .nav-item {
            margin-left: 3rem;
            margin-bottom: 0;
        }

        .nav-toggle {
            display: none;
        }

        .home {
            grid-template-rows: max-content 20px;
            align-content: center;
        }

        .home-information {
            margin-top: 2rem;
        }

        .home-social {
            flex-direction: row;
            padding-top: 8rem;
            padding-bottom: 0;
        }

        .home-social-icon {
            margin-right: 2rem;
            margin-bottom: 0;
        }

        .home-img {
            width: 553px;
            right: 5%;
        }
    }

    @media screen and (min-width: 1200px) {
        .bd-grid {
            margin-left: auto;
            margin-right: auto;
        }
    }




</style>
<header class="l-header">
    <nav class="nav bd-grid">
        <div>
            <a href="#" class="nav-logo">BUT <span>INFORMATIQUE 2ème année</span></a>
        </div>
        <div class="nav-menu" id="nav-menu">
            <ul class="nav-list">
                <li class="nav-item"><a href="controleurFrontal.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="controleurFrontal.php?action=afficherProfil&controleur=utilisateur" class="nav-link">A propos de moi</a></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Mon portfolio d'apprentissages</a>
                    <!-- Sous-menu -->
                    <ul class="submenu">
                        <li class="submenu-item"><a href="controleurFrontal.php?action=afficherProjets&projet=1" class="submenu-link">Projet Perso</a></li>
                        <li class="submenu-item"><a href="controleurFrontal.php?action=afficherProjets&projet=2" class="submenu-link">Projet IUT</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main>
    <?php
    /**
     * @var string $cheminCorpsVue
     */
    require __DIR__ . "/{$cheminCorpsVue}";
    ?>
</main>

</body>
</html>
