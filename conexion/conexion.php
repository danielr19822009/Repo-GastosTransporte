<?php 

// DATOS PARA CONECTARME A LA BASE DE DATOS
$servidorbd = "localhost";
$usuariobd = "root";
$clavebd = "root";
$basedatos = "transporte";

// Establecer la conexión
$conectarbd = new mysqli($servidorbd, $usuariobd, $clavebd, $basedatos);

// Verificar la conexión
if ($conectarbd->connect_error) {
    die("Error de conexión: " . $conectarbd->connect_error);
    echo "Error de conexión: " . $conectarbd->connect_error;
}

// Establecer el conjunto de caracteres
mysqli_set_charset($conectarbd, "utf8");

// Iniciar la sesión
session_start();

// Comprobar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['nombre'];
    $clave = $_POST['contrasena'];

    // Consulta para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE nomb_usuario = ? AND contrasena = ?";
    $stmt = $conectarbd->prepare($sql);
    $stmt->bind_param("ss", $usuario, $clave);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Si el usuario existe
    if ($resultado->num_rows > 0) {
        // Establecer las variables de sesión
        $usuarioData = $resultado->fetch_assoc();
        $_SESSION['id'] = $usuarioData['id']; // Asumiendo que tienes un campo 'id' en tu tabla
        $_SESSION['usuario'] = $usuarioData['usuario'];

        // Redirigir a la página principal o a otra página
        header("Location: index.php");
        exit();
    } else {
        echo "Credenciales incorrectas.";
    }
}


?>
