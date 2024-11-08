


<!-- EXPORTAR BASE DE DATOS O SINO LA APLICACION NO VA A FUNCIONAR :v -->



<?php 
// Definir las credenciales de la base de datos
$dbhost = 'localhost'; // Dirección del servidor de la base de datos (en este caso, localhost)
$dbuser = 'root'; // Usuario de la base de datos (en este caso, 'root')
$dbpass = ''; // Contraseña de la base de datos (en este caso, está vacía)
$dbname = 'chacabuco'; // Nombre de la base de datos a la que nos queremos conectar

// Crear una conexión a la base de datos utilizando la clase mysqli
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Verificar si hubo un error al intentar conectarse a la base de datos
if ($conn->connect_error) {
    // Si hay un error en la conexión, se termina el script y se muestra el error
    die('Ha ocurrido un error al conectarse a la base de datos: ' . $conn->connect_error);
}

// Si no hubo errores, la conexión fue exitosa, por lo que se imprime el mensaje
echo "Conexión exitosa <br>"; 
?>
