// Import bcrypt.js (si nécessaire dans l'environnement)
const bcrypt = require('bcryptjs');

// Ouvrir le modal
function openModal() {
    let modal = document.getElementById("securityModal");
    let overlay = document.getElementById("overlay");

    if (modal && overlay) {
        modal.style.display = "block";
        overlay.style.display = "block";
    }

    // Récupérer la valeur du data-email pour les deux champs et assigner
    let emailField = document.getElementById("newEmail");
    let emailDisplayField = document.getElementById("displayEmail");

    let emailValue = emailField.getAttribute("data-email");
    emailField.value = emailValue;  // Réinitialiser le champ email
    emailDisplayField.value = emailValue;  // Réinitialiser l'affichage de l'email
}

// Fermer le modal sans sauvegarder les changements
function cancelSecurityChanges() {
    // Fermer simplement le modal et masquer l'overlay sans effectuer de changements
    let modal = document.getElementById("securityModal");
    let overlay = document.getElementById("overlay");

    if (modal && overlay) {
        modal.style.display = "none";
        overlay.style.display = "none";
    }

    // Réinitialiser les champs du modal pour ne pas garder les valeurs modifiées
    let emailField = document.getElementById("newEmail");
    let emailDisplayField = document.getElementById("displayEmail");

    let emailValue = emailField.getAttribute("data-email");

    // Réinitialiser les champs email
    emailField.value = emailValue;
    emailDisplayField.value = emailValue;

    // Réinitialiser les autres champs
    document.getElementById("oldPassword").value = "";
    document.getElementById("newPassword").value = "";
    document.getElementById("confirmPassword").value = "";
}

// Sauvegarder les changements de sécurité (email et mot de passe)
function saveSecurityChanges() {
    let email = document.getElementById("newEmail").value;
    let oldPass = document.getElementById("oldPassword").value;
    let newPass = document.getElementById("newPassword").value;
    let confirmPass = document.getElementById("confirmPassword").value;

    console.log("Formulaire prêt à être soumis :");
    console.log("Email: ", email);
    console.log("Ancien mot de passe: ", oldPass);
    console.log("Nouveau mot de passe: ", newPass);

    // Validation des champs avant envoi
    if (!oldPass) {
        alert("L'ancien mot de passe est requis.");
        return;
    }

    if (newPass !== confirmPass) {
        alert("Les nouveaux mots de passe ne correspondent pas.");
        return;
    }

    // Hachage du mot de passe si nécessaire (si le hachage est fait côté serveur, cette partie n'est pas nécessaire)
    bcrypt.hash(newPass, 10, function (err, hashedPassword) {
        if (err) {
            console.error("Erreur lors du hachage du mot de passe : ", err);
            return;
        }

        // Soumettre le formulaire après avoir haché le mot de passe
        console.log("Soumission du formulaire avec le nouveau mot de passe.");
        document.getElementById("newPassword").value = hashedPassword;
        document.getElementById("securityForm").submit();
    });
}
