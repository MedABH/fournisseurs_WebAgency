// Ouvrir le modal et afficher l'overlay
function openModal() {
    console.log("Tentative d'ouverture du modal"); // Débogage
    let modal = document.getElementById("securityModal");
    let overlay = document.getElementById("overlay");

    if (modal && overlay) {
        console.log("Modal et overlay trouvés"); // Débogage
        modal.style.display = "block";
        overlay.style.display = "block";
    } else {
        console.error("Modal ou overlay non trouvé !"); // Si l'élément n'est pas trouvé
    }
}

// Fermer le modal et masquer l'overlay
function closeModal() {
    console.log("Tentative de fermeture du modal"); // Débogage
    let modal = document.getElementById("securityModal");
    let overlay = document.getElementById("overlay");

    if (modal && overlay) {
        modal.style.display = "none";
        overlay.style.display = "none";
    } else {
        console.error("Modal ou overlay non trouvé !"); // Si l'élément n'est pas trouvé
    }
}

// Fonction pour sauvegarder les changements et mettre à jour les inputs en lecture seule
function saveChanges() {
    console.log("Tentative de sauvegarde des changements"); // Débogage

    let email = document.getElementById("newEmail").value;
    let oldPass = document.getElementById("oldPassword").value;
    let newPass = document.getElementById("newPassword").value;
    let confirmPass = document.getElementById("confirmPassword").value;
    let currentPassword = document.getElementById("currentPassword").value; // Récupérer le mot de passe actuel

    // Vérification si l'ancien mot de passe correspond
    if (oldPass !== currentPassword) {
        alert("L'ancien mot de passe est incorrect !");
        console.error("L'ancien mot de passe ne correspond pas"); // Débogage
        return;
    }

    // Vérification si le nouveau mot de passe correspond à la confirmation
    if (newPass !== confirmPass) {
        alert("Les nouveaux mots de passe ne correspondent pas !");
        console.error("Les mots de passe ne correspondent pas"); // Débogage
        return;
    }

    // Hash du mot de passe (exemple simplifié)
    let hashedPassword = btoa(newPass); // Encodage Base64 juste pour l'exemple

    // Mise à jour des champs readonly avec le nouvel email et mot de passe
    document.getElementById("displayEmail").value = email;
    document.getElementById("displayPassword").value = hashedPassword; // Affichage du mot de passe hashé

    console.log("Changements sauvegardés avec succès"); // Débogage

    // Fermer le modal après sauvegarde
    closeModal();
}
