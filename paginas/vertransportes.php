<?php
require_once("./conexion/conexion.php");

// Fetch transportes
$sqltransportes = mysqli_query($conectarbd, '
SELECT t.cod_transporte, t.origen, t.destino, t.fecha, t.valor, t.descripcion, t.cod_usuario, t.cod_tipotransporte, t.cod_cliente, t.cod_origen, t.cod_destino , u.nomb_usuario, tt.nomb_transporte 
FROM transporte t 
INNER JOIN usuarios u ON t.cod_usuario = u.cod_usuario 
INNER JOIN tipotransporte tt ON t.cod_tipotransporte = tt.cod_tipotransporte;
') or die(mysqli_error($conectarbd));

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<body>
<hr style="width: 100%; color: black; height: 1px; background-color:black;" />

<!-- Gastos Table -->
<div class="table-responsive">
    <table class="table" id="mitable">
        <thead>
            <tr>
                <th>Codigo#</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Valor</th>
                <th>Descripcion</th>
                <th>Tecnico</th>
                <th>Transporte</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($sqltransportes)) {
                echo "<tr>";
                echo "<td>" . ($row["cod_transporte"]) . "</td>";
                echo "<td>" . ($row["origen"]) . "</td>";
                echo "<td>" . ($row["destino"]) . "</td>";
                echo "<td>" . ($row["fecha"]) . "</td>";
                echo "<td>" . ($row["valor"]) . "</td>";
                echo "<td>" . ($row["descripcion"]) . "</td>";
                echo "<td>" . ($row["nomb_usuario"]) . "</td>";
                echo "<td>" . ($row["nomb_transporte"]) . "</td>";
                echo "<td><a href='update.php?cod_transporte=" . $row["cod_transporte"] . "'>Update</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="../menu.php"><button type="button" class="btn btn-danger">Back</button></a>
</div>
</body>


</html>