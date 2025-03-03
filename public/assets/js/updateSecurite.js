// Open the modal and show the overlay
function openModal() {
    document.getElementById("securityModal").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

// Close the modal and hide the overlay
function closeModal() {
    document.getElementById("securityModal").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

// Function to save changes and update readonly inputs
function saveChanges() {
    let email = document.getElementById("newEmail").value;
    let oldPass = document.getElementById("oldPassword").value;
    let newPass = document.getElementById("newPassword").value;
    let confirmPass = document.getElementById("confirmPassword").value;
    let currentPassword = document.getElementById("currentPassword").value; // Get the current password value

    // Check if the old password matches the current password
    if (oldPass !== currentPassword) {
        alert("L'ancien mot de passe est incorrect !");
        return;
    }

    // Check if the new password and confirmed password match
    if (newPass !== confirmPass) {
        alert("Les nouveaux mots de passe ne correspondent pas !");
        return;
    }

    // Update the readonly fields with the new email and password hash (showing just the hashed password for security)
    document.getElementById("displayEmail").value = email;
    document.getElementById("displayPassword").value = "••••••••"; // You could implement an actual hash here.

    // Close the modal after saving
    closeModal();
}
