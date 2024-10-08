<?php
require_once("conexion/conexion.php");

// Fetch gastos
$sqlgastos = mysqli_query($conectarbd, "
    SELECT gastos.OrigenGasto,
           gastos.DestinoGasto,
           gastos.ValorGasto,
           gastos.FechaGasto,
           usuarios.NombreUsuario,
           usuarios.id,
           gastos.Descripcion
    FROM gastos 
    INNER JOIN usuarios ON gastos.id = usuarios.id
") or die(mysqli_error($conectarbd));

// Fetch users
$sqluser = mysqli_query($conectarbd, "SELECT * FROM usuarios") or die(mysqli_error($conectarbd));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" user-scalable="no">
    <link rel="stylesheet" type="text/css" href="stilos/stilos.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.8/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.8/js/jquery.dataTables.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#mitable').DataTable();
        });
    </script>
</head>

<body>
    <!-- Filter Form -->
    <div id="container" class="well filtrogasto">
        <form method="POST" action="">
            <h3>Totalizar Gasto Por Usuario</h3>
            <div class="col-sm-3">
                <label>De Fecha</label>
                <input class="form-control" style="width:70%" name="txt_fechini" type="date" required>
            </div>
            <div class="col-sm-3">
                <label>A Fecha</label>
                <input class="form-control" style="width:70%" name="txt_fechfin" type="date" required>
            </div>
            <div class="col-sm-3">
                <label>Gestor</label>
                <select class="form-control" name="txt_gestor" style="width:70%" required>
                    <option value="" required></option>
                    <?php
                    while ($vect1 = mysqli_fetch_array($sqluser)) {
                        echo "<option value='" . htmlspecialchars($vect1['DocumentoUsuario']) . "'>" . htmlspecialchars($vect1['DocumentoUsuario']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-1">
                <button type="submit" class="btn btn-info">Go</button>
            </div>
            <div class="col-sm-1">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalfiltro" data-backdrop="static">Ver Filtro</button>
            </div>
        </form>
        <br><br><br><br>
    </div>

    <!-- Filter Variables -->
    <?php
    @$gestor = $_POST['txt_gestor'];
    @$fechini = $_POST['txt_fechini'];
    @$fechafin = $_POST['txt_fechfin'];

    $sqlfiltro = mysqli_query($conectarbd, "
        SELECT DocumentoUsuario, SUM(ValorGasto) AS Total 
        FROM gastos 
        WHERE DocumentoUsuario = '$gestor' 
        AND FechaGasto BETWEEN '$fechini' AND '$fechafin'
    ") or die(mysqli_error($conectarbd));
    ?>

    <!-- Modal for Filter -->
    <div class="modal fade" id="modalfiltro" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title">Registro Gastos</h4>
                </div>
                <div class="modal-body">
                    <table>
                        <thead>
                            <tr>
                                <th style="width:100px">Gestor</th>
                                <th>Total</th>						
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($fila = mysqli_fetch_array($sqlfiltro)) {
                                echo "<tr>";
                                echo "<td style='text-align:center'>" . htmlspecialchars($fila["DocumentoUsuario"]) . "</td>";
                                echo ($fila["Total"]) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>		
                </div>
            </div>
        </div>
    </div>

    <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
		
    <!-- Gastos Table -->	
    <div class="container" style="margin-top:4%">
        <table id="mitable">
            <thead>
                <tr>
                    <th style="width:100px">Origen</th>
                    <th>Destino</th>
                    <th>Valor</th>
                    <th style="width:100px">Fecha</th>
                    <th>Gestor</th>
                    <th>Descripcion</th>
                    <th>Accion</th>							
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($sqlgastos)) {
                    echo "<tr>";
                    echo ($row["OrigenGasto"]) . "</td>";
                    echo ($row["DestinoGasto"]) . "</td>";
                    echo ($row["ValorGasto"]) . "</td>";
                    echo ($row["FechaGasto"]) . "</td>";
                    echo "<td style='text-align:center'>" . htmlspecialchars($row["DocumentoUsuario"]) . "</td>";
                    echo ($row["Descripcion"]) . "</td>";
                    echo "<td style='text-align:center'><a href='crud/crudgastos.php?guardar=modificar&txt_observaciones=" . urlencode($row["DocumentoUsuario"]) . "'>Update</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="menu.php"><button type="button" class="btn btn-danger">Back</button></a>
    </div>
</body>
</html>
