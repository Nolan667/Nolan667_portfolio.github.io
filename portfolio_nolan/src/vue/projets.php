<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elegant Interactive Portfolio Gallery</title>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts for Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../ressources/css/projets.css">
</head>
<body>
<header></header>

<br><br><br><br>
<main>
    <section class="gallery">
        <?php

        if (isset($_GET['projet'])) {
            $projetId = $_GET['projet'];

            if ($projetId == 2) {

                echo '
                <div class="gallery-item" data-category="web" data-id="1">
                    <img src="../ressources/img/sae.png" alt="Référendum en Java Spring Boot">
                    <div class="overlay">
                        <h3>Référendum en Java</h3>
                        <p>Développement d\'une plateforme de référendum pour un client, utilisant Java Spring Boot et une base de données robuste.</p>
                    </div>
                </div>

                <div class="gallery-item" data-category="web" data-id="2">
                    <img src="../ressources/img/sitePHP.png" alt="Site e-commerce en PHP">
                    <div class="overlay">
                        <h3>Site e-commerce en PHP</h3>
                        <p>Création d\'un site de vente en ligne avec PHP, intégrant un panier interactif et une gestion des commandes.</p>
                    </div>
                </div>

                <div class="gallery-item" data-category="web" data-id="5">
                    <img src="../ressources/img/sete.png" alt="Implémentation d\'un jeu de carte">
                    <div class="overlay">
                        <h3>Implémentation d\'un jeu de carte</h3>
                        <p>Nous avons dû implémenter un jeu de carte et y réaliser des calculs mathématiques pour évaluer l\'efficacité des tris.</p>
                    </div>
                </div>';
            } else {
                // Affiche les projets personnels
                echo '
                <div class="gallery-item" data-category="cybersecurity" data-id="3">
                    <img src="../ressources/img/hackerone.png" alt="Bug bounty sur HackerOne">
                    <div class="overlay">
                        <h3>Bug bounty sur HackerOne</h3>
                        <p>Tests de pénétration par recherche de sous domaine d\'un site sur plateforme de bug bounty</p>
                    </div>
                </div>

                <div class="gallery-item" data-category="web" data-id="4">
                    <img src="../ressources/img/webS.png" alt="Projet web scraping">
                    <div class="overlay">
                        <h3>Application de web scraping</h3>
                        <p>Implémentation d\'une petite application de web scraping qui permet de créer des comptes à l\'aide du tools selenium sur différents sites et permet de s\'y connecter pour récolter des données automatisées sur le web</p>
                    </div>
                </div>

                <div class="gallery-item" data-category="web" data-id="6">
                    <img src="../ressources/img/ndc.png" alt="Participation Nuit du code">
                    <div class="overlay">
                        <h3>Participation Nuit du code</h3>
                        <p>Création d\'un site web en rapport avec la thématique de l\'écologie, en combinant de multiples défis (où est charlie, tetris).</p>
                    </div>
                </div>

                <div class="gallery-item" data-category="music" data-id="8">
                    <img src="../ressources/img/piano.png" alt="Projet pianistique">
                    <div class="overlay">
                        <h3>Projet pianistique</h3>
                        <p>Création de morceaux originaux et reprises, combinant technique classique et arrangements modernes.</p>
                    </div>
                </div>';
            }
        } else {
            echo '<p>Aucun projet sélectionné. Veuillez choisir un type de projet.</p>';
        }
        ?>
    </section>
</main>

<!-- Lightbox Modal -->
<div class="lightbox" id="lightbox">
    <span class="close"><i class="fas fa-times"></i></span>
    <div class="lightbox-content">
        <img src="" alt="Expanded Image" id="lightbox-img">
        <div class="lightbox-caption">
            <h3 id="lightbox-title">Project Title</h3>
            <p id="lightbox-description">Detailed description of the project.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const galleryItems = document.querySelectorAll('.gallery-item');

        galleryItems.forEach(item => {
            item.addEventListener('click', () => {
                const projectId = item.getAttribute('data-id'); // Récupère l'ID du projet
                if (projectId) {
                    // Redirige directement vers la page de détail avec l'ID
                    window.location.href = `controleurFrontal.php?action=afficherDetailProjet&id=${projectId}`;
                }
            });
        });
    });
</script>

</body>
</html>
