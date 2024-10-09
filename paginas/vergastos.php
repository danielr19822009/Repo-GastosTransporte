<?php
require_once("conexion/conexion.php");

// Fetch gastos
$sqlgastos = mysqli_query($conectarbd, "
    SELECT gastos_transporte.origen,
           gastos_transporte.destino,
           gastos_transporte.valor,
           gastos_transporte.fecha,
           usuarios.nomb_usuario,
           usuarios.doc_usuario,
           usuarios.cod_usuario,
           gastos_transporte.descripcion
    FROM gastos_transporte 
    INNER JOIN usuarios ON gastos_transporte.cod_usuario = usuarios.cod_usuario") or die(mysqli_error($conectarbd));

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
                    <option value="" disabled selected>Seleccione un gestor</option>
                    <?php
                    while ($vect1 = mysqli_fetch_array($sqluser)) {
                        echo "<option value='" . htmlspecialchars($vect1['doc_usuario']) . "'>" . htmlspecialchars($vect1['doc_usuario']) . "</option>";
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
    // Obtener los valores de POST de manera segura
    $gestor = isset($_POST['txt_gestor']) ? $_POST['txt_gestor'] : null;
    $fechini = isset($_POST['txt_fechini']) ? $_POST['txt_fechini'] : null; 
    $fechafin = isset($_POST['txt_fechfin']) ? $_POST['txt_fechfin'] : null; 

    // Solo ejecutar la consulta si se han proporcionado los datos
    if ($gestor && $fechini && $fechafin) {
        $sqlfiltro = $conectarbd->prepare("
            SELECT doc_usuario, SUM(valor) AS Total 
            FROM gastos_transporte 
            WHERE doc_usuario = ? 
            AND fecha BETWEEN ? AND ?
            GROUP BY doc_usuario
        ");

        // Ejecutar la consulta con parámetros
        $sqlfiltro->bind_param("sss", $gestor, $fechini, $fechafin); // Usar bind_param para mysqli
        $sqlfiltro->execute();

        // Obtener los resultados
        $resultados = $sqlfiltro->get_result(); // Obtener el resultado de la consulta
    }
    ?>

    <!-- Modal for Filter -->
    <div class="modal fade" id="modalfiltro" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Registro Gastos</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:100px">Gestor</th>
                                <th>Total</th>						
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($resultados)) {
                                while ($fila = $resultados->fetch_assoc()) { // Usar fetch_assoc() para mysqli
                                    echo "<tr>";
                                    echo "<td style='text-align:center'>" . htmlspecialchars($fila["doc_usuario"]) . "</td>";
                                    echo "<td style='text-align:center'>" . htmlspecialchars($fila["Total"]) . "</td>"; 
                                    echo "</tr>";
                                }
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
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Valor</th>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    <th>Tecnico</th>
                    <th>Acción</th>							
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($sqlgastos)) {
                    echo "<tr>";
                    echo "<td>" . ($row["origen"]) . "</td>";
                    echo "<td>" . ($row["destino"]) . "</td>";
                    echo "<td>" . ($row["valor"]) . "</td>";
                    echo "<td>" . ($row["fecha"]) . "</td>";
                    echo "<td>" . ($row["descripcion"]) . "</td>";
                    echo "<td>" . ($row["nomb_usuario"]) . "</td>";
                    echo "<td><a href='update.php?cod_usuario=".$row["cod_usuario"]. "'>Update</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="menu.php"><button type="button" class="btn btn-danger">Back</button></a>
    </div>
</body>


</html>
