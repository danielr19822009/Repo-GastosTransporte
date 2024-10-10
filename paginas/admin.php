<?php
// Llamamos la conexión
require_once("./conexion/conexion.php");

// Query de consulta tabla usuarios
$sqlusuarios = $conectarbd->prepare("SELECT * FROM usuarios");

if (!$sqlusuarios->execute()) {
    die("Error en la consulta: " . $sqlusuarios->error);
}

$resultusu = $sqlusuarios->get_result();
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Dashboard</h1>

        <!-- Card con las opciones de acción -->
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <!-- Botones para abrir los paneles de colapso -->
                    <button class="btn btn-info btn-md" data-toggle="collapse" data-parent="#accordion" href="#collapse1">Usuarios</button>
                    <button class="btn btn-info btn-md" data-toggle="collapse" data-parent="#accordion" href="#collapse2">Orígenes</button>
                    <button class="btn btn-info btn-md" data-toggle="collapse" data-parent="#accordion" href="#collapse3">Destinos</button>
                    <button class="btn btn-info btn-md" data-toggle="collapse" data-parent="#accordion" href="#collapse4">Tipo Transportes</button>
                    <button class="btn btn-info btn-md" data-toggle="collapse" data-parent="#accordion" href="#collapse5">Transportes</button>
                    <button class="btn btn-info btn-md" data-toggle="collapse" data-parent="#accordion" href="#collapse6">Clientes</button>
                </div>

                <div id="collapse1" class="panel-collapse collapse" data-parent="#accordion">
                    <div class="panel-body">
                        <?php include_once("./paginas/verusuarios.php"); ?>
                    </div>
                </div>
          
                <div id="collapse2" class="panel-collapse collapse" data-parent="#accordion">
                    <div class="panel-body">
                        <?php include_once("./paginas/verorigenes.php"); ?>
                    </div>
                </div>
          
                <div id="collapse3" class="panel-collapse collapse" data-parent="#accordion">
                    <div class="panel-body">
                        <?php include_once("./paginas/verdestinos.php"); ?>
                    </div>
                </div>
           
                <div id="collapse4" class="panel-collapse collapse" data-parent="#accordion">
                    <div class="panel-body">
                        <?php include_once("./paginas/vertipotransporte.php"); // Asumiendo que el archivo existe ?>
                    </div>
                </div>
            
                <div id="collapse5" class="panel-collapse collapse" data-parent="#accordion">
                    <div class="panel-body">
                        <?php include_once("./paginas/vertransportes.php"); // Asumiendo que el archivo existe ?>
                    </div>
                </div>

                <div id="collapse6" class="panel-collapse collapse" data-parent="#accordion">
                    <div class="panel-body">
                        <?php include_once("./paginas/verclientes.php"); // Asumiendo que el archivo existe ?>
                    </div>
                </div>
           
            </div>
        </div>

        <!-- Modal para Nuevo Usuario -->
        <div class="modal fade" role="dialog" id="myModalusuarios">
            <div class="modal-dialog modal-lg" style="min-height:500px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Lista Usuario</h4>
                    </div>
                    <div class="modal-body">
                        <form action="crud/cruduser.php" method="POST">
                            <div class="form-group">
                                <label for="txt_user">Nombre</label>
                                <input id="txt_user" name="txt_user" type="text" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="txt_ape">Apellido</label>
                                <input id="txt_ape" name="txt_ape" type="text" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="txt_doc">Documento / NIT</label>
                                <input id="txt_doc" name="txt_doc" type="number" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="txt_passw">Contraseña</label>
                                <input id="txt_passw" name="txt_passw" type="password" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="txt_rol">Rol</label>
                                <input id="txt_rol" name="txt_rol" type="text" class="form-control" required />
                            </div>
                            <button name="guardar" value="guser" type="submit" class="btn btn-default">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
