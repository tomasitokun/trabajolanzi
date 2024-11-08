


<!-- EXPORTAR BASE DE DATOS O SINO LA APLICACION NO VA A FUNCIONAR :v -->


<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php'; 

// Verifica si el formulario ha sido enviado usando el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtiene los datos del formulario enviados por POST
    $nroMateria = $_POST['nromateria']; // Almacena el número de materia recibido
    $docu = $_POST['docu']; // Almacena el número de documento (DNI) recibido

    // Verifica que los campos necesarios (nroMateria y docu) no estén vacíos
    if (!empty($nroMateria) && !empty($docu)) {
        
        // Prepara la consulta para obtener el id_materia a partir del número de materia
        $queryMateria = "SELECT id_materia FROM materia WHERE id_materia = ?"; // Consulta SQL para obtener el id de la materia
        $stmtMateria = $conn->prepare($queryMateria); // Prepara la consulta con la conexión a la base de datos
        $stmtMateria->bind_param("i", $nroMateria); // Vincula el número de materia (nroMateria) como tipo de dato entero
        $stmtMateria->execute(); // Ejecuta la consulta
        $resultMateria = $stmtMateria->get_result(); // Obtiene el resultado de la consulta

        // Verifica si se encontró la materia con el número proporcionado
        if ($resultMateria->num_rows > 0) {
            // Si la materia se encuentra, obtiene su id_materia
            $rowMateria = $resultMateria->fetch_assoc(); // Extrae el resultado como un arreglo asociativo
            $id_materia = $rowMateria['id_materia']; // Almacena el id_materia

            // Prepara la consulta para obtener el id_usuario a partir del número de documento
            $queryUsuario = "SELECT id_usu FROM usuario WHERE numero_documento = ?"; // Consulta SQL para obtener el id del usuario
            $stmtUsuario = $conn->prepare($queryUsuario); // Prepara la consulta con la conexión a la base de datos
            $stmtUsuario->bind_param("s", $docu); // Vincula el número de documento (docu) como tipo de dato string
            $stmtUsuario->execute(); // Ejecuta la consulta
            $resultUsuario = $stmtUsuario->get_result(); // Obtiene el resultado de la consulta

            // Verifica si se encontró el usuario con el número de documento proporcionado
            if ($resultUsuario->num_rows > 0) {
                // Si el usuario se encuentra, obtiene su id_usu
                $rowUsuario = $resultUsuario->fetch_assoc(); // Extrae el resultado como un arreglo asociativo
                $id_usuario = $rowUsuario['id_usu']; // Almacena el id_usuario

                // Prepara la consulta para eliminar la fila correspondiente de la tabla materia_usuario
                $queryBaja = "DELETE FROM materia_usuario WHERE id_materia = ? AND id_usuario = ?"; // Consulta SQL de eliminación
                $stmtBaja = $conn->prepare($queryBaja); // Prepara la consulta con la conexión a la base de datos
                $stmtBaja->bind_param("ii", $id_materia, $id_usuario); // Vincula los parámetros id_materia y id_usuario como enteros
                $stmtBaja->execute(); // Ejecuta la consulta de eliminación

                // Verifica si la eliminación fue exitosa
                if ($stmtBaja->execute()) {
                    echo "Baja realizada con éxito."; // Si la eliminación fue exitosa, muestra un mensaje
                } else {
                    echo "Error al realizar la baja: " . $conn->error; // Si hubo un error en la eliminación, muestra el error
                }

                // Cierra el statement para la eliminación
                $stmtBaja->close();
            } else {
                // Si no se encuentra el usuario con el número de documento proporcionado, muestra un mensaje
                echo "No se encontró el usuario con el documento proporcionado.";
            }

            // Cierra el statement para la consulta del usuario
            $stmtUsuario->close();
        } else {
            // Si no se encuentra la materia con el número de materia proporcionado, muestra un mensaje
            echo "No se encontró la materia con el número proporcionado.";
        }

        // Cierra el statement para la consulta de la materia
        $stmtMateria->close();
    } else {
        // Si los campos del formulario no fueron completados, muestra un mensaje pidiendo completar los campos
        echo "Por favor, complete todos los campos.";
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>
