<?php
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
                $mensaje="Bienvenido al sistema de Transporte!!!!";
               
                // El usuario existe, redirigir a admin.php
                header("Location: /transporte/admin.php?mensaje=" . $mensaje);

                exit(); // Siempre usa exit después de un redireccionamiento
        } else {
                $mensaje="Error De Usuario registrese por favor:";
                header("Location: /transporte/index.php?mensaje=" . $mensaje);
        }
        $stmt->close();
        $conectarbd->close();
}
