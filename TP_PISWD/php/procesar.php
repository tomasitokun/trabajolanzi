


<!-- EXPORTAR BASE DE DATOS O SINO LA APLICACION NO VA A FUNCIONAR :v -->



<?php
// Incluye el archivo de conexión a la base de datos, asumiendo que está en la misma carpeta
include 'conexion.php'; 

// Verifica si el formulario ha sido enviado usando el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica si los datos del formulario han sido enviados correctamente (número de materia y DNI)
    if (isset($_POST['nromateria']) && isset($_POST['docu'])) {
        // Asigna las variables a los datos recibidos del formulario
        $nroMateria = $_POST['nromateria']; // Almacena el número de la materia recibido del formulario
        $docu = $_POST['docu']; // Almacena el número de documento (DNI) recibido del formulario

        // Muestra en pantalla el número de la materia y el DNI recibidos (esto es útil para depuración)
        echo "Número de materia: $nroMateria<br>";
        echo "DNI: $docu<br>";
        
    } else {
        // Si no se recibieron los datos del formulario, muestra un mensaje de error
        echo "No se recibieron los datos del formulario.";
    }

    // A continuación, se obtiene el número de materia y el DNI directamente de $_POST, ya que ya se ha verificado que existen
    $nroMateria = $_POST['nromateria']; // Obtiene el número de materia del formulario
    $docu = $_POST['docu']; // Obtiene el número de documento del formulario

    // Prepara una consulta SQL para obtener el ID del usuario usando el número de documento (DNI)
    $sqlUsuario = "SELECT id_usu FROM usuario WHERE numero_documento = ?"; // La consulta SQL
    $stmtUsuario = $conn->prepare($sqlUsuario); // Prepara la consulta usando la conexión a la base de datos
    $stmtUsuario->bind_param("s", $docu); // Vincula el parámetro $docu (DNI) a la consulta como tipo de dato string
    $stmtUsuario->execute(); // Ejecuta la consulta
    $resultUsuario = $stmtUsuario->get_result(); // Obtiene el resultado de la consulta

    // Verifica si se encontró algún usuario con el DNI proporcionado
    if ($resultUsuario->num_rows > 0) {
        // Si se encontró un usuario, obtiene su ID
        $rowUsuario = $resultUsuario->fetch_assoc(); // Extrae el resultado como un arreglo asociativo
        $id_usu = $rowUsuario['id_usu']; // Almacena el ID del usuario

        // Prepara una consulta SQL para obtener el ID de la materia usando el número de materia
        $sqlMateria = "SELECT id_materia FROM materia WHERE id_materia = ?"; // Consulta SQL
        $stmtMateria = $conn->prepare($sqlMateria); // Prepara la consulta con la conexión a la base de datos
        $stmtMateria->bind_param("i", $nroMateria); // Vincula el parámetro $nroMateria (número de materia) como tipo de dato entero
        $stmtMateria->execute(); // Ejecuta la consulta
        $resultMateria = $stmtMateria->get_result(); // Obtiene el resultado de la consulta

        // Verifica si se encontró una materia con el número de materia proporcionado
        if ($resultMateria->num_rows > 0) {
            // Si se encuentra la materia, obtiene su ID
            $rowMateria = $resultMateria->fetch_assoc(); // Extrae el resultado como un arreglo asociativo
            $id_materia = $rowMateria['id_materia']; // Almacena el ID de la materia

            // Prepara la consulta para insertar los datos en la tabla 'materia_usuario'
            $sqlInsert = "INSERT INTO materia_usuario (id_materia, id_usuario) VALUES (?, ?)"; // Consulta SQL de inserción
            $stmtInsert = $conn->prepare($sqlInsert); // Prepara la consulta para ejecutar la inserción
            $stmtInsert->bind_param("ii", $id_materia, $id_usu); // Vincula los parámetros (id_materia y id_usu) a la consulta como enteros
            $stmtInsert->execute(); // Ejecuta la consulta de inserción

            // Si la inserción fue exitosa, muestra un mensaje
            echo "Registro insertado exitosamente.";
        } else {
            // Si no se encuentra la materia con el número de materia proporcionado, muestra un mensaje de error
            echo "Materia no encontrada.";
        }
    } else {
        // Si no se encuentra el usuario con el DNI proporcionado, muestra un mensaje de error
        echo "Usuario no encontrado.";
    }
}
?>
