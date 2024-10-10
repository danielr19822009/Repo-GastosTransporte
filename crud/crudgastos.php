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
    $descripcion = mysqli_real_escape_string($conectarbd, $_POST['txt_observaciones']);
    $usuario = mysqli_real_escape_string($conectarbd, $_POST['txt_conductor']);
    $tipotransporte = mysqli_real_escape_string($conectarbd, $_POST['txt_tipotransporte']);



    // Declaramos la variable que captura el name del botón del formulario
    $accion = $_POST["guardargasto"]; // Asegúrate de que este nombre coincida
    

   
    switch ($accion) {
        case 'guardargasto':
            // Preparar la consulta
            $sql = "INSERT INTO gastos_transporte(origen, destino, fecha, valor, descripcion, cod_usuario, cod_tipotransporte) 
            VALUES ($origen,$destino,$fecha,$valor,$descripcion,$usuario,$tipotransporte)";


            // Ejecutar la consulta
            $result = mysqli_query($conectarbd, $sql);
            $accionmsn = "Guardado";
            break;


        case 'updategastos':
            // Aquí debe ir la lógica de actualización (no proporcionada en tu código)
            $gastoId = mysqli_real_escape_string($conectarbd, $_POST['gasto_id']); // Necesitas un campo para identificar el gasto
            $sql = "UPDATE gastos_transporte SET origen='$origen', destino='$destino', fecha='$fecha', valor='$valor', descripcion='$descripcion' WHERE id='$gastoId'";
            $result = mysqli_query($conectarbd, $sql);
            $accionmsn = "Modificado";
            break;

      
    }

    // Manejo de errores y mensajes
    if (!$result) {
        $msn = "Error al guardar: " .$accionmsn.$resultado. mysqli_error($conectarbd);
        header("Location: /transporte/menu.php?mensaje="  . urlencode($msn)); // Usar urlencode para asegurar que el mensaje sea seguro
    } else {
        $msn = "Error al guardar: " .$accionmsn. mysqli_error($conectarbd);
        header("Location: /transporte/menu.php?mensaje=" . urlencode($msn)); // Usar urlencode para asegurar que el mensaje sea seguro
    }
}
   
?>
