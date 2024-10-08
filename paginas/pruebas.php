<?php
session_start();

// Validamos que la sesión está activa y no esté vacía
$_SESSION["usuario"];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Gastos</title>
    <link rel="stylesheet" href="css/stylesgastos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body>

    <div class="container">
        <h1>Gastos</h1>
        <hr>
        <form id="expenseForm" action="crud/crudgastos.php" method="POST">
            <div class="form-group">
                <label >Origen de Gasto:</label>
                <input type="text" id="txt_origen" name="txt_origen" required>
            </div>
            <div class="form-group">
                <label >Destino de Gasto:</label>
                <input type="text" id="txt_destino" name="txt_destino" required>
            </div>
            <div class="form-group">
                <label >Valor:</label>
                <input type="number" id="txt_valor" name="txt_valor" required>
            </div>
            <div class="form-group">
                <label >Fecha:</label>
                <input type="date" id="txt_fecha" name="txt_fecha" required>
            </div>
            <div class="form-group">
                <label >Descripción:</label>
                <textarea id="txt_observaciones" name="txt_observaciones" required></textarea>
            </div>
            <div class="form-group">
                <label >Usuario:</label>
                <select id="txt_usuario" class="form-control" name="txt_usuario" required>
                    <option value="" disabled selected>Seleccione un Usuario</option>
                    <option value="<?php echo htmlspecialchars($_SESSION['usuario']); ?>">
                        <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                    </option>
                </select>
            </div>
            <div class="button-group">
                <button name="guardargasto" value="guardargasto">Registrar</button>
            </div>
        </form>

    </div>


</body>

</html>