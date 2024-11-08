


<!-- EXPORTAR BASE DE DATOS O SINO LA APLICACION NO VA A FUNCIONAR :v -->



<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/Archivo1.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de materia con usuario</title>
    <!-- Incluir jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Función para validar el formulario
            $('form').submit(function(event) {
                event.preventDefault(); // Evitar envío automático

                // Obtener valores de los campos
                var nroMateria = $('.nromateria').val().trim();
                var nombreMateria = $('.nombremateria').val().trim();
                var nombrealumno = $('.nombre').val().trim();
                var apalumno = $('.apellido').val().trim();
                var anodiv = $('.anodiv').val().trim();
                var docu = $('.docu').val().trim();

                // Validación número de materia (máximo 3 dígitos numéricos)
                if (!/^\d{1,3}$/.test(nroMateria)) {
                    alert('Número de materia debe ser un máximo de 3 dígitos numéricos.');
                    return;
                }

                // Validación nombre del alumno (máximo 50 caracteres alfabéticos)
                if (!/^[a-zA-Z\s]{1,50}$/.test(nombrealumno)) {
                    alert('Nombre del alumno debe tener máximo 50 caracteres alfabéticos.');
                    return;
                }

                // Validación apellido del alumno (máximo 50 caracteres alfabéticos)
                if (!/^[a-zA-Z\s]{1,50}$/.test(apalumno)) {
                    alert('Apellido del alumno debe tener máximo 50 caracteres alfabéticos.');
                    return;
                }

                // Validación año y división (máximo 50 caracteres)
                if (!/^[a-zA-Z0-9\s]{1,50}$/.test(anodiv)) {
                    alert('El campo de año y división debe tener máximo 50 caracteres alfabéticos.');
                    return;
                }

                // Validación número de documento (mínimo 7 caracteres numéricos)
                if (!/^\d{7,}$/.test(docu)) {
                    alert('Número de documento debe tener al menos 7 dígitos numéricos.');
                    return;
                }

                // Validación nombre de materia (máximo 50 caracteres alfabéticos)
                if (!/^[a-zA-Z\s]{1,50}$/.test(nombreMateria)) {
                    alert('Nombre de materia debe tener máximo 50 caracteres alfabéticos.');
                    return;
                }

                // Si todas las validaciones pasan, envía el formulario
                this.submit(); // Envía el formulario
            });

            // Limpiar campos al hacer clic en el botón Reset
            $('.reset').click(function(event) {
                event.preventDefault();
                $('form')[0].reset();
            });
        });
    </script>
</head>
<body>
    <img src="../img/escuela.jpg" class="esc">
    <div class="cuerpo">
        <h3>ALTA DE MATERIA CON USUARIO</h3>
        <div class="caja">
            datos del usuario y materia
            <form method="POST" action="procesar.php">
                <h4>Datos de la materia</h4>
                <label for="">Numero de materia:</label><br>
                <input type="text" name="nromateria" class="nromateria">
                <br>
                <label for="">Nombre de la materia:</label><br>
                <input type="text" class="nombremateria">
                <br><br>
                <h4>Datos del usuario</h4><br>
                <label for="">Tipo de documento</label><br>
                <select name="documento" id="documentoSelect">
                    <option value="">Seleccione una opción</option>
                    <option value="">DNI</option>
                    <option value="">LC</option>
                    <option value="">LD</option>
                </select>
                <br>
                <label for="">Numero de documento</label><br>
                <input type="text" name="docu" class="docu">
                <br>
                <label for="">Nombre</label><br>
                <input type="text" class="nombre">
                <br>
                <label for="">Apellido</label><br>
                <input type="text" class="apellido">
                <br>
                <label for="">Año de division</label><br>
                <input type="text" class="anodiv">
                
                <input type="submit" value="Dar de alta" class="alta">
                <input type="reset" value="Resetear" class="reset">
            </form>
        </div>
    </div>  
    <footer class="pie">
        <div class="espe">
           <hr> 
        
        
            <h4 class="pietitulo">“E.E.S.T N°6 CHACABUCO – MORÓN (7o 4o año 2024)”</h4>
            <div class="pietexto">
                
                “Proyecto de implementación de sitios web dinámicos”
                <br>
                “Autores: Gallardo, Dominguez, Cajal, Portillo, Speranza, Mosquera, Pavon, Garcia, Ledesma, Lujan, Romero, Loiacono, Baez, Lezcano, Sebriano, Sebriano, Alarcon, Donnarumma, Salmeron, Marrapodi, Cuba, Francisco, D'Atri, Di cerbo, Cabrera, D'Angelo, Casagerone, Iacobacci, Scaramuzza, Luque, Corbalan, Lucero, Potaschnik, Cari, Castellano, Matos, Ianonne, etc.
            </div>
        </div>
    </footer>
</body>
</html>
