<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$password = $_POST['password'];
$acceptTerms = isset($_POST['acceptTerms']) ? $_POST['acceptTerms'] : '';

$response = '';

if (empty($firstName) || empty($lastName) || empty($password) || !$acceptTerms) {
    $response = "<br><br>Por favor, completa todos los campos y acepta los términos.";
} else {
    $response = "<br><br>¡Registro exitoso! Bienvenid@, $firstName $lastName.";
}

echo $response;
?>
