// Import bcrypt.js (if in Node.js environment)
const bcrypt = require('bcryptjs');

// Ouvrir le modal et afficher l'overlay
function openModal() {
    let modal = document.getElementById("securityModal");
    let overlay = document.getElementById("overlay");

    if (modal && overlay) {
        modal.style.display = "block";
        overlay.style.display = "block";
    } 
}

// Fermer le modal et masquer l'overlay
function closeModal() {
    let modal = document.getElementById("securityModal");
    let overlay = document.getElementById("overlay");

    if (modal && overlay) {
        modal.style.display = "none";
        overlay.style.display = "none";
    }
}

// Fonction pour sauvegarder les changements et mettre à jour les inputs en lecture seule
function saveChanges() {

    let email = document.getElementById("newEmail").value;
    let oldPass = document.getElementById("oldPassword").value;
    let newPass = document.getElementById("newPassword").value;
    let confirmPass = document.getElementById("confirmPassword").value;
    let currentPassword = document.getElementById("currentPassword").value; // Récupérer le mot de passe actuel

    // Vérification si l'ancien mot de passe correspond
    if (oldPass !== currentPassword) {
        alert("L'ancien mot de passe est incorrect !");
        return;
    }

    // Vérification si le nouveau mot de passe correspond à la confirmation
    if (newPass !== confirmPass) {
        alert("Les nouveaux mots de passe ne correspondent pas !");
        return;
    }

    // Hash du mot de passe avec bcrypt
    bcrypt.hash(newPass, 10, function(err, hashedPassword) {
        if (err) {
            console.error("Erreur lors du hachage du mot de passe : ", err);
            return;
        }

        // Mise à jour des champs readonly avec le nouvel email et mot de passe
        document.getElementById("displayEmail").value = email;
        document.getElementById("displayPassword").value = hashedPassword; // Affichage du mot de passe hashé

        // Fermer le modal après sauvegarde
        closeModal();
    });
}
