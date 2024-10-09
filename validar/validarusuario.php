<?php
session_start(); // Iniciar la sesión

require_once("../conexion/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar el valor del input
    $usuario = $_POST['nombre'];
    $password = $_POST['contrasena'];

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conectarbd->prepare("SELECT * FROM usuarios WHERE nomb_usuario = ? AND contrasena = ?");
    $stmt->bind_param("ss", $usuario, $password);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        // Obtener los datos del usuario
        $usuario_data = $result->fetch_assoc();
        
        // Almacenar información en la sesión
        $_SESSION['usuario'] = $usuario_data['nomb_usuario']; // Almacena el nombre del usuario
        $_SESSION['usuario_id'] = $usuario_data['id_usuario']; // Almacena el ID del usuario si lo necesitas
        
        $mensaje = "Bienvenido al sistema de Transporte!!!!";
        
        // El usuario existe, redirigir a menu.php
        header("Location: /transporte/menu.php?mensaje=" . urlencode($mensaje));
        exit(); // Siempre usa exit después de un redireccionamiento
    } else {
        $mensaje = "Error De Usuario registrese por favor:";
        header("Location: /transporte/index.php?mensaje=" . urlencode($mensaje));
        exit(); // Asegúrate de salir después de redirigir
    }

    $stmt->close();
    $conectarbd->close();
}
