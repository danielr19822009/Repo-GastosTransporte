<?php
require_once("./conexion/conexion.php");

// Fetch users
$sqldestinos = mysqli_query($conectarbd, "SELECT * FROM destinos") or die(mysqli_error($conectarbd));
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
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($sqldestinos)) {
                echo "<tr>";
                echo "<td>" . ($row["cod_destino"]) . "</td>";
                echo "<td>" . ($row["nomb_destino"]) . "</td>";
                echo "<td>" . ($row["descripcion"]) . "</td>";
                echo "<td><a href='update.php?cod_usuario=" . $row["cod_destino"] . "'>Update</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="../menu.php"><button type="button" class="btn btn-danger">Back</button></a>
</div>
</body>


</html>