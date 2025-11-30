<?php

$conexion = new mysqli("localhost", "root", "", "scout23");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

function subirImagen($campo, $carpeta) {
    if (!empty($_FILES[$campo]["name"])) {
        $nombreArchivo = time() . "_" . $_FILES[$campo]["name"];
        $ruta = "uploads/$carpeta/" . $nombreArchivo;
        move_uploaded_file($_FILES[$campo]["tmp_name"], $ruta);
        return $nombreArchivo;
    }
    return null;
}

// Niño
$dni_frente_nino = subirImagen("dni_frente_nino", "dni_frente_nino");
$dni_dorso_nino  = subirImagen("dni_dorso_nino", "dni_dorso_nino");

// Obra social (solo si eligió "SI")
$obra_frente = null;
$obra_dorso  = null;

if ($_POST["obra_social_opcion"] === "si") {
    $obra_frente = subirImagen("obra_frente", "obra_frente");
    $obra_dorso  = subirImagen("obra_dorso", "obra_dorso");
}

// Adulto responsable
$tutor_dni_frente = subirImagen("tutor_dni_frente","tutor_dni_frente");
$tutor_dni_dorso  = subirImagen("tutor_dni_dorso","tutor_dni_dorso");

// Datos principales
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];
$fecha_nac = $_POST["fecha_nac"];
$obra_social = $_POST["obra_social_opcion"];

$tutor_nombre = $_POST["tutor_nombre"];
$tutor_relacion = $_POST["tutor_relacion"];
$tutor_email = $_POST["tutor_email"];

$sql = "INSERT INTO inscripciones
(nombre, edad, fecha_nac, dni_frente_nino, dni_dorso_nino,
 obra_social, obra_frente, obra_dorso,
 tutor_nombre, tutor_relacion, tutor_email,
 tutor_dni_frente, tutor_dni_dorso)
VALUES
('$nombre','$edad','$fecha_nac','$dni_frente_nino','$dni_dorso_nino',
 '$obra_social', '$obra_frente', '$obra_dorso',
 '$tutor_nombre','$tutor_relacion','$tutor_email',
 '$tutor_dni_frente', '$tutor_dni_dorso')
";

if ($conexion->query($sql) === TRUE) {
    echo "<h1>Inscripción guardada correctamente ✔</h1>";
    echo "<h3>En unos minutos te enviaresmo al correo electronico su Inscripcion</h3>";
    echo '<a href="../../index.php">Volver</a>';
} else {
    echo "Error: " . $conexion->error;
}

$conexion->close();
?>
