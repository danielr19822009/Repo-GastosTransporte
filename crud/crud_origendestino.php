<?php
require_once("../conexion/conexion.php");

// Verificar la conexión
if (!$conectarbd) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Declaramos la variable que captura el name del botón del formulario
$accion = isset($_POST["agregarorigen"]) ? "agregarorigen" : (isset($_POST["agregardestino"]) ? "agregardestino" : null);

switch ($accion) {
    case 'agregarorigen':
        // Captura los datos de los input por medio de POST
        $nomb_origen = mysqli_real_escape_string($conectarbd, $_POST['nuevo_origen']);
        $descripcion_origen = mysqli_real_escape_string($conectarbd, $_POST['descripcion_origen']); // Cambié el nombre de la variable

        // Preparar la consulta para evitar inyecciones SQL
        $sqlinsertorigen = $conectarbd->prepare("INSERT INTO origenes (nomb_origen, descripcion) VALUES (?, ?)");
        $sqlinsertorigen->bind_param("ss", $nomb_origen, $descripcion_origen);

        // Ejecutar la consulta
        if ($sqlinsertorigen->execute()) {
            $msn = "Nuevo origen agregado correctamente!";
            header("Location: /transporte/menu.php?page=agregar");
        } else {
            $msn = "Error al agregar el origen: " . $sqlinsertorigen->error;
            header("Location: /transporte/menu.php?mensaje=" . urlencode($msn)); // Usar urlencode para asegurar que el mensaje sea seguro
        }

        // Cerrar la declaración
        $sqlinsertorigen->close();
        break; // Agregar break aquí para evitar caer en el siguiente caso

    case 'agregardestino':
        // Captura los datos de los input por medio de POST
        $nomb_destino = mysqli_real_escape_string($conectarbd, $_POST['nuevo_destino']);
        $descripcion_destino = mysqli_real_escape_string($conectarbd, $_POST['descripcion_destino']); // Cambié el nombre de la variable

        // Preparar la consulta para evitar inyecciones SQL
        $sqlinserdestino = $conectarbd->prepare("INSERT INTO destinos (nomb_destino, descripcion) VALUES (?, ?)");
        $sqlinserdestino->bind_param("ss", $nomb_destino, $descripcion_destino);

        // Ejecutar la consulta
        if ($sqlinserdestino->execute()) {
            $msn = "Nuevo destino agregado correctamente!";
            header("Location: /transporte/menu.php?page=agregar");
        } else {
            $msn = "Error al agregar el destino: " . $sqlinserdestino->error; // Cambié a $sqlinserdestino
            header("Location: /transporte/menu.php?mensaje=" . urlencode($msn)); // Usar urlencode para asegurar que el mensaje sea seguro
        }

        // Cerrar la declaración
        $sqlinserdestino->close();
        break; // Asegúrate de tener un break aquí también
}
?>
