<?php
// Llamamos la conexión
require_once("./conexion/conexion.php");

// Queries
$sqlcliente = "SELECT * FROM clientes";
$sqluser = "SELECT * FROM usuarios";
$sqlgastos = "SELECT * FROM transporte";
$origenes = "SELECT * FROM origenes";
$destinos = "SELECT * FROM destinos";

// Execute queries
$clientes = $conectarbd->query($sqlcliente);
$usuarios = $conectarbd->query($sqluser);
$gastos = $conectarbd->query($sqlgastos);
$origenes = $conectarbd->query($origenes);
$destinos = $conectarbd->query($destinos);
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
		<h4 class="text-center">INFORMACIÓN GASTO</h4>

		<form action="crud/crudgastos.php" method="POST" class="form">
			<div class="form-group">
				<label>Fecha:</label>
				<input id="txt_fecha" name="txt_fecha" type="date" class="form-control" required>
			</div>

			<div class="form-group">
				<label>Realizado por:</label>
				<select id="txt_conductor" name="txt_conductor" class="form-control" required>
					<option value="" disabled selected>Seleccione un conductor</option>
					<?php while ($row = $usuarios->fetch_assoc()): ?>
						<option value="<?php echo htmlspecialchars($row['doc_usuario']); ?>">
							<?php echo htmlspecialchars($row['doc_usuario']); ?>
						</option>
					<?php endwhile; ?>
				</select>
			</div>

			<div class="form-group">
				<label>Origen:</label>
				<select id="txt_origen" name="txt_origen" class="form-control" required>
					<option value="" disabled selected>Seleccione un origen</option>
					<?php while ($row = $origenes->fetch_assoc()): ?>
						<option value="<?php echo htmlspecialchars($row['nomb_origen']); ?>">
							<?php echo htmlspecialchars($row['nomb_origen']); ?>
						</option>
					<?php endwhile; ?>
				</select>
				<button class="btn btn-success" type="button" data-toggle="modal" data-target="#agregarorigenModal">
					Agregar origen
				</button>
			</div>

			<div class="form-group">
				<label>Destino:</label>
				<select id="txt_destino" name="txt_destino" class="form-control" required>
					<option value="" disabled selected>Seleccione un destino</option>
					<?php // Reinicia la consulta para obtener destinos únicos
					$gastos->data_seek(0); // Regresa al inicio del conjunto de resultados
					while ($row = $destinos->fetch_assoc()): ?>
						<option>
							<?php echo htmlspecialchars($row['nomb_destino']); ?>
						</option>
					<?php endwhile; ?>
				</select>
				<button class="btn btn-success" type="button" data-toggle="modal" data-target="#agregardestinoModal">
					Agregar Destino
				</button>
			</div>

			<div class="form-group">
				<label>Transporte:</label>
				<select class="form-control" id="txt_tipotransporte" name="txt_tipotransporte" required>
					<option value="moto">Moto</option>
					<option value="taxi">Taxi</option>
				</select>
			</div>

			<div class="form-group">
				<label for="txt_valor">Valor:</label>
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input id="txt_valor" name="txt_valor" type="number" class="form-control" required>
				</div>
			</div>

			<div class="form-group">
				<label>Observaciones:</label>
				<textarea id="txt_observaciones" name="txt_observaciones" class="form-control" rows="4" required></textarea>
			</div>

			<div class="form-group">
				<button type="submit" name="guardargasto" class="btn btn-success">Guardar</button>
			</div>
		</form>
	</div>


	<!-- Modal  Destino-->
	<div class="modal fade" id="agregardestinoModal" tabindex="-1" role="dialog" aria-labelledby="agregardestinoModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="agregarOrigenModalLabel">Agregar Nuevo Destino</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="crud/crud_origendestino.php" method="POST">
						<div class="form-group">
							<label >Nuevo Destino:</label>
							<input type="text" id="nuevo_destino" name="nuevo_destino" class="form-control" required>
						</div>
						<div class="form-group">
							<label >Descripcion Destino:</label>
							<input type="text" id="nuevo_destino" name="nuevo_destino" class="form-control" required>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" name="agregardestino" class="btn btn-primary">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	
	<!-- Modal agregar origen-->
	<div class="modal fade" id="agregarorigenModal" tabindex="-1" role="dialog" aria-labelledby="agregarOrigenModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="agregarOrigenModalLabel">Agregar Nuevo Origen</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="crud/crud_origendestino.php" method="POST">
						<div class="form-group">
							<label >Nuevo Origen:</label>
							<input type="text" id="nuevo_origen" name="nuevo_origen" class="form-control" required>
						</div>

						<div class="form-group">
							<label >Descripcion Origen:</label>
							<input type="text" id="descripcion_origen" name="descripcion_origen" class="form-control" required>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" name="agregarorigen" class="btn btn-primary">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>



</html>