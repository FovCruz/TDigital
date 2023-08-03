<?php

require_once('Conexion/conexion.php');

// Consulta SQL para obtener las comunas de las regiones que comienzan con m o M
function ObtenerComunas($conn){
    $sql = "SELECT c.id, c.comuna
            FROM comunas c 
            INNER JOIN provincias p ON c.provincia_id = p.id 
            INNER JOIN regiones r ON p.region_id = r.id 
            WHERE region LIKE 'm%' OR 'M%'";


            
    $result = $conn->query($sql);
    
    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }

    return $result;
}


function exportarComunasXMl($conn) {
    $comunasResult = ObtenerComunas($conn); // Obtener resultados de comunas

    if ($comunasResult->num_rows > 0) {
        // Crear el documento XML
        $xmlDoc = new DOMDocument();
        $xmlDoc->formatOutput = true;

        $comunasElement = $xmlDoc->createElement('comunas');
        $xmlDoc->appendChild($comunasElement);

        $comunas = array();

        while ($row = $comunasResult->fetch_assoc()) {
            $comunas[] = $row;
        }

        // Ordenar las comunas por ID
        usort($comunas, function($a, $b) {
            return $a['id'] - $b['id'];
        });

        foreach ($comunas as $row) {
            $comunaElement = $xmlDoc->createElement('comuna');

            $idElement = $xmlDoc->createElement('id', $row['id']);
            $comunaElement->appendChild($idElement);

            $nombreElement = $xmlDoc->createElement('nombre', $row['comuna']);
            $comunaElement->appendChild($nombreElement);

            $comunasElement->appendChild($comunaElement);
        }
        //carpeta de exportacion del xml
        $xmlDoc->save('Resultado en XML/ListaComunas.xml');
        echo "Exportación a XML completa, se encuentra en carpeta 'Resultado en XML'";
    } else {
        echo "No se encontraron comunas.";
    }
}

$conn = conectarBaseDeDatos();

exportarComunasXMl($conn);

$conn->close();
?>