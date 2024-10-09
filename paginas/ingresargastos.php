<?php
// Llamamos la conexión
require_once("./conexion/conexion.php");


// Queries
$sqlcliente = "SELECT * FROM clientes";
$sqluser = "SELECT * FROM usuarios";

// Execute queries
$clientes = $conectarbd->query($sqlcliente);
$usuarios = $conectarbd->query($sqluser);

// Prepare data for gastos
$sqlgastos = "SELECT gastos_transporte.origen,
                        gastos_transporte.destino,
                        gastos_transporte.valor,
                        gastos_transporte.fecha,
                        usuarios.nomb_usuario,
                        usuarios.doc_usuario
                  FROM gastos_transporte
                  INNER JOIN usuarios ON gastos_transporte.cod_usuario= usuarios.cod_usuario";

$gastos = $conectarbd->query($sqlgastos);
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agregar Gastos</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
</head>

<body>
	<div class="container" style="margin-top: 50px;">
		<h4 class="text-center">INFORMACION GASTO</h4>

		<form action="crud/crudgastos.php" method="POST" class="form">
			<div class="form-group">
				<label for="txt_fecha">Fecha:</label>
				<input id="txt_fecha" name="txt_fecha" type="date" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="txt_conductor">Realizado por:</label>
				<select id="txt_conductor" name="txt_conductor" class="form-control" required>
					<option value="" disabled selected>Seleccione un conductor</option>
					<?php while ($row = $usuarios->fetch_assoc()): ?>
						<option value="<?php echo $row['doc_usuario']; ?>">
							<?php echo $row['doc_usuario']; ?>
						</option>
					<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="txt_origen">Origen:</label>
				<select id="txt_origen" name="txt_origen" class="form-control" required>
					<option value="" disabled selected>Seleccione un origen</option>
					<?php while ($row = $gastos->fetch_assoc()): ?>
						<option>
							<?php echo $row['origen']; ?>
						</option>
					<?php endwhile; ?>
					
				</select>
			</div>

			<div class="form-group">
				<label for="txt_destino">destino:</label>
				<select id="txt_destino" name="txt_destino" class="form-control" required>
					<option value="" disabled selected>Seleccione un destino</option>
					<?php while ($row = $gastos->fetch_assoc()): ?>
						<option>
							<?php echo $row['destino']; ?>
						</option>
					<?php endwhile; ?>
					
				</select>
			</div>

			<div class="form-group">
                <label for="transporte">Transporte:</label>
                <select class="form-control" id="txt_tipotransporte" name="txt_tipotransporte" required>
                    <option value="moto">Moto</option>
                    <option value="taxi">Taxi</option>
                </select>
            </div>

			<div class="form-group">
				<label for="txt_valor">Valor:</label>
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input id="txt_valor" name="txt_valor" type="text" class="form-control" required>
				</div>
			</div>

			<div class="form-group">
				<label for="txt_observaciones">Observaciones:</label>
				<textarea id="txt_observaciones" name="txt_observaciones" class="form-control" rows="4" required></textarea>
			</div>

			<div class="form-group">
				<button type="button" class="btn btn-success">Guardar</button>
			</div>
		
		</form>
	</div>

	
</body>


</html>
