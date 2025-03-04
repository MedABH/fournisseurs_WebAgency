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

    // Optionally, hash the new password (for display only, real hashing should be done server-side)
    // Simulating a hash for demonstration purposes (you can remove this if not necessary):
    let hashedPassword = btoa(newPass); // Base64 encoding just for demonstration, use a proper hash function server-side

    // Update the readonly fields with the new email and hashed password
    document.getElementById("displayEmail").value = email;
    document.getElementById("displayPassword").value = hashedPassword; // Display the hashed password

    // Close the modal after saving
    closeModal();
}

/*function updateProfile() {
    let name = document.getElementById("name").value;
    let contact = document.getElementById("contact").value;
    let adresse = document.getElementById("adresse").value;
    let email = document.getElementById("email").value;
    
    // Basic client-side validation
    if (!name || !contact || !adresse || !email) {
        alert("All fields are required!");
        return;
    }
    
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let data = {
        name: name,
        contact: contact,
        adresse: adresse,
        email: email,
        _token: csrfToken
    };

    fetch('/updateAuth', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Profile updated successfully!');
        } else {
            alert(`Failed to update profile: ${data.message}`);
        }
    })
    .catch(error => console.error('Error:', error));
}*/

function updateProfile() {
    // Your custom logic here (if any)
    document.querySelector('form').submit();
}

