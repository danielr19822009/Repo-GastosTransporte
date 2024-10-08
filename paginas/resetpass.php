<?php 


require_once("/conexion/conexion.php");

	$sql =mysql_query("SELECT * FROM gestionti_usuarios WHERE DocumentoUsuario='".$_SESSION['doc']."'");

	$row=mysql_fetch_array($sql);

?>


<!doctype>

<html>
	</body>
		<head>
		<link rel="stylesheet" type="css" href="">
		</head>

		<div class="">
			 <h4 class="modal-title">Cambiar Contraseña Usuario</h4><br><br>
							  
				<form action="crud/crud_res_pass.php" method="POST">
					<label>Nombre</label>
					<input type="text" name="txt_nom" readonly class="form-control" style="width:30%"required value="<?php echo $row['NombreUsuario']?>"><br>

					<label>Apellido</label>
					<input type="text" name="txt_ape" readonly class="form-control" style="width:30%"required value="<?php echo $row['ApellidoUsuario']?>"><br>

					<label>Documento</label>
					<input type="text" name="txt_doc" readonly class="form-control" style="width:30%"required value="<?php echo $row['DocumentoUsuario']?>"><br>

					<label>Contraseña Anterior</label>
					<input type="text" name="txt_clavant" readonly class="form-control" style="width:30%"required value="<?php echo $row['ClaveUsuario']?>"><br>

					<label>Nueva Contraseña</label>
					<input type="password" name="txt_nueclave" required class="form-control" style="width:30%"><br>

					<label>Confirme Contraseña</label>
					<input type="password" name="txt_confclave" required class="form-control" style="width:30%"><br>					
															
					<button name="guardar" type="submit" class="btn btn-default">Guardar</button>
								
				</form>	

				<div>
					<?php
						@$mensa = $_GET['mensaje'];
						echo $mensa;					
					?>
				</div>			  
							  
		</div>
	</body>

</html>