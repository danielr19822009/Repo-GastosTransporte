<!DOCTYPE html>
<html lang="es">

<head>
    <title>GastosGestionTI</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="imagenes/logo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="fondo1">
    <!-- Añadido id="fondo1" -->

    <div class="container">
        <div class="panel panel-primary" style="margin: 3% 20% auto 20%">
            <form role="form" action="/validar/validarusuario.php" method="POST">
                <img src="imagenes/logo.png" class="img-responsive" alt="Logo de la empresa">
                <!-- Atributo alt mejorado -->
                <div class="form-group">
                    <label >Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <br>

                <div class="form-group">
                    <label >Password:</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                </div><br>

                <button type="submit" class="btn btn-success">Ingresar</button><br>
            </form>

            <!-- Muestra el error tras ingresar datos que no existen en la bd -->
            <?php if (isset($_GET['mensaje'])): ?>
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?php echo htmlspecialchars($_GET['mensaje']); ?>',
                confirmButtonText: 'OK'
            });
            </script>
            <?php endif; ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>