document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item');

    galleryItems.forEach(item => {
        item.addEventListener('click', () => {
            const projectId = item.getAttribute('data-id'); // Récupère l'ID du projet
            if (projectId) {
                // Redirige directement vers la page de détail avec l'ID
                window.location.href = `controleurFrontal.php?action=afficherHomePage`;
            }
        });
    });


// Lightbox Functionality
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDescription = document.getElementById('lightbox-description');
    const closeBtn = document.querySelector('.close');

    // Fonction pour ouvrir le lightbox
    function openLightbox(item) {
        const imgSrc = item.querySelector('img').src;
        const title = item.querySelector('.overlay h3').textContent;
        const description = item.querySelector('.overlay p').textContent;

        lightboxImg.src = imgSrc;
        lightboxTitle.textContent = title;
        lightboxDescription.textContent = description;

        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden'; // Empêche le défilement de la page
    }

    // Event listeners pour les éléments de la galerie
    galleryItems.forEach(item => {
        item.addEventListener('click', (e) => {
            // Empêche la redirection si le lightbox est activé
            if (e.target !== lightbox && !lightbox.classList.contains('active')) {
                openLightbox(item);
            }
        });
    });

    // Fonction pour fermer le lightbox
    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = 'auto'; // Restaure le défilement
    }

    // Event listener pour le bouton de fermeture
    closeBtn.addEventListener('click', () => {
        closeLightbox();
    });

    // Event listener pour fermer le lightbox en cliquant en dehors de son contenu
    window.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });
});
