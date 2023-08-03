
<?php
// configuracion para la conexion de la BD
function conectarBaseDeDatos() {

    $servername = "localhost";
    $username = "root";
    $password = "oracle";
    $dbname = "taller_digital";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    } 

    return $conn;
}
?>