<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/stylesgastos.css"> <!-- Corregido el tipo -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Gestión de Clientes</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Gestión de Usuarios</h1>

        <!-- Card con las opciones de acción -->
        <div class="card text-center mb-4">
            
            <div class="card-body">
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal1">
                    <span class="glyphicon glyphicon-plus"></span> Nuevo Usuario
                </button>
                <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal2">
                    <span class="glyphicon glyphicon-pencil"></span> Actualizar Usuario
                </button>
                <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal3">
                    <span class="glyphicon glyphicon-user"></span> Nuevo Cliente
                </button>
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal4">
                    <span class="glyphicon glyphicon-refresh"></span> Actualizar Cliente
                </button>
            </div>
        </div>

        <!-- Modal para Nuevo Usuario -->
        <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Datos del Nuevo Usuario</h4>
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
                                <label >Rol</label>
                                <input id="txt_rol" name="txt_rol" type="text" class="form-control" required />
                            </div>
                            <button name="guardar" value="guser" type="submit" class="btn btn-default">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Actualizar Usuario -->
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Buscar Usuario para Modificar</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="txt_buscarpor">Buscar Por:</label>
                                <select id="txt_buscarpor" name="txt_buscarpor" class="form-control" required>
                                    <option value="" disabled selected></option>
                                    <option value="NombreUsuario">Nombre</option>
                                    <option value="ApellidoUsuario">Apellido</option>
                                    <option value="DocumentoUsuario">Documento</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txt_buscado">Valor:</label>
                                <input id="txt_buscado" name="txt_buscado" class="form-control" required />
                            </div>
                            <button name="guardar" value="Buscar" type="submit" class="btn btn-default">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Nuevo Cliente -->
        <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Datos del Nuevo Cliente</h4>
                    </div>
                    <div class="modal-body">
                        <form action="crud/cruduser.php" method="POST">
                            <div class="form-group">
                                <label for="txt_nombclien">Nombre / Razón Social</label>
                                <input id="txt_nombclien" name="txt_nombclien" type="text" class="form-control" style="text-transform:uppercase" required />
                            </div>
                            <div class="form-group">
                                <label for="txt_dirclien">Dirección</label>
                                <input id="txt_dirclien" name="txt_dirclien" type="text" class="form-control" style="text-transform:uppercase" required />
                            </div>
                            <div class="form-group">
                                <label for="txt_telclien">Teléfono</label>
                                <input id="txt_telclien" name="txt_telclien" type="number" class="form-control" required />
                            </div>
                            <button name="guardar" value="gclient" type="submit" class="btn btn-default">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Actualizar Cliente -->
        <div class="modal " id="myModal4" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Buscar Cliente</h4>
                    </div>
                    <div class="modal-body">
                        <form action="modificarusarios.php" method="POST">
                            <div class="form-group">
                                <label for="txt_buscarpor_client"> Por:</label>
                                <select id="txt_buscarpor_client" name="txt_buscarpor" class="form-control" required>
                                    <option value="nom">Nombre / Razón Social</option>
                                    <option value="ape">Telefono</option>
                                
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txt_buscado_client">Dato:</label>
                                <select id="txt_buscado_client" name="txt_buscado" class="form-control" required>
                                    <option value="" disabled selected></option>
                                    <?php
                                    while ($row = mysqli_fetch_array($sqlcliente)) {
                                        echo "<option value=\"{$row['NombreCliente']}\">{$row['NombreCliente']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <button type="" class="btn btn-default">Buscar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

       
    </div>
</body>
</html>
