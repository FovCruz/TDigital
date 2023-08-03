//Validacion de campos de texto 
const firstNameInput = document.getElementById("firstName");
const lastNameInput = document.getElementById("lastName");

firstNameInput.addEventListener("input", function() {
    this.value = this.value.replace(/[^A-Za-z]/g, "");
});

lastNameInput.addEventListener("input", function() {
    this.value = this.value.replace(/[^A-Za-z]/g, "");
});

// Envío de formulario a PHP
document.getElementById("signupForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "php/ValidarForm.php", true);
    xhr.onload = function() {
        document.getElementById("message").innerHTML = xhr.responseText;
    };
    xhr.send(formData);
});


