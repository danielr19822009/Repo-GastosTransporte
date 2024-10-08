<?php

require_once("../conexion/conexion.php");

// Verificar la conexión
if (!$conectarbd) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Comprobamos si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asignamos el valor de las cajas de texto a las variables y las escapamos
    $origen = mysqli_real_escape_string($conectarbd, $_POST['txt_origen']);
    $destino = mysqli_real_escape_string($conectarbd, $_POST['txt_destino']);
    $valor = mysqli_real_escape_string($conectarbd, $_POST['txt_valor']);
    $fecha = mysqli_real_escape_string($conectarbd, $_POST['txt_fecha']);
    $observaciones = mysqli_real_escape_string($conectarbd, $_POST['txt_observaciones']);
    $usuario = mysqli_real_escape_string($conectarbd, $_POST['txt_usuario']);

    // Declaramos la variable que captura el name del botón del formulario
    $accion = $_POST["guardargasto"]; // Asegúrate de que este nombre coincida

    switch ($accion) {
        case 'guardargasto':
            // Preparar la consulta
            $sql = "INSERT INTO gastos (OrigenGasto, DestinoGasto, ValorGasto, FechaGasto, Descripcion, id_usuario) VALUES 
                ('$origen', '$destino', '$valor', '$fecha', '$observaciones', '$usuario')";

            // Ejecutar la consulta
            $result = mysqli_query($conectarbd, $sql);
            $accionmsn = "Guardado";
            break;

        case 'updategastos':
            // Aquí debe ir la lógica de actualización (no proporcionada en tu código)
            // Suponiendo que tienes un campo 'id' en tu tabla gastos para identificarlo
            $gastoId = mysqli_real_escape_string($conectarbd, $_POST['gasto_id']); // Necesitas un campo para identificar el gasto
            $sql = "UPDATE gastos SET OrigenGasto='$origen', DestinoGasto='$destino', ValorGasto='$valor', FechaGasto='$fecha', Descripcion='$observaciones' WHERE id='$gastoId'";
            $result = mysqli_query($conectarbd, $sql);
            $accionmsn = "Modificado";
            break;
    }

    // Manejo de errores y mensajes
    if (!$result) {
        $msn = "Error al guardar: " . mysqli_error($conectarbd);
        echo $msn; // Muestra el mensaje de error
        exit(); // Detener la ejecución si hay un error
    } else {
        $msn = "El gasto ha sido $accionmsn correctamente!";
    }

    // Redirigir al menú con el mensaje
    header("Location: ../menu.php?mensaje=" . urlencode($msn)); // Usar urlencode para asegurar que el mensaje sea seguro
    exit();
} else {
    echo "No se ha enviado el formulario.";
}
?>
