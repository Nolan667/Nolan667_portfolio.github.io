<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Landing Page</title>
    <link rel="stylesheet" href="../ressources/css/homePage.css">
</head>
<body>
    <div class="overlay first"></div>
    <div class="overlay second"></div>
    <div class="overlay third"></div>

<header>

</header>

    <main class="l-main bd-grid">
        <div class="home">
            <div class="home-information">
                <span class="home-pressent anime-text">Hello, Je suis</span>
                <h1 class="home-title anime-text">Nolan Pujol</h1>
                <span class="home-skill anime-text">Etudiant en informatique spécialité développement d'application communicantes et sécurisées</span>

                <div>
                    <a href="controleurFrontal.php?action=telecharger&controleur=utilisateur" class="home-button anime-text">DOWNLOAD CV</a>
                </div>
            </div>

            <div class="home-img">
                <img src="../ressources/img/hacker.jpg" alt="image" width="400px" height="400px">
            </div>

            <div class="home-social">
                <a href="https://fr.linkedin.com/in/nolan-pujol-a6ab502aa" target="_blank" rel="noopener noreferrer">
                    <ion-icon name="logo-linkedin" class="home-social-icon"></ion-icon>
                </a>
                <a href="https://github.com/Nolan667" target="_blank" rel="noopener noreferrer">
                    <ion-icon name="logo-github" class="home-social-icon"></ion-icon>
                </a>
                <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer">
                    <ion-icon name="logo-twitter" class="home-social-icon"></ion-icon>
                </a>

                <a href="mailto:nolan.pujol@example.com?subject=Contact%20via%20Portfolio&body=Bonjour%20Nolan,%0A%0AJe%20souhaiterais%20vous%20contacter%20concernant%20votre%20portfolio.%0A%0A%20Cordialement,%0A[Nom]">
                    <ion-icon name="mail-outline" class="home-social-icon"></ion-icon>
                </a>



            </div>

        </div>
    </main>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <script src="../ressources/homePage.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>