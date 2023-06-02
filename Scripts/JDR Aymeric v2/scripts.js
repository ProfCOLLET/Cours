// Fonction pour rafraîchir la page
function refreshPage() {
    location.reload();
}

// Ajouter un gestionnaire d'événements pour le bouton de rafraîchissement
document.getElementById('refresh-button').addEventListener('click', refreshPage);
