<?php
		
	session_status();
	
		@$user =$_SESSION['usuariosencillo'];
		@$user1=$_SESSION['usuario'];
		@$user2=$_SESSION['doc'];
		
		require_once("\conexion\conexion.php");
		$sqlcliente=mysql_query("SELECT * FROM gestionti_clientes", $conectarbd) or die(mysql_error());
		$sqlcliente1=mysql_query("SELECT * FROM gestionti_clientes", $conectarbd) or die(mysql_error());
		$sqlconductor=mysql_query("SELECT gestionti_gastos.OrigenGasto,
		gestionti_gastos.DestinoGasto,
		gestionti_gastos.ValorGasto,
		gestionti_gastos.FechaGasto,
		gestionti_usuarios.NombreUsuario,
		gestionti_usuarios.DocumentoUsuario
		FROM gestionti_gastos
		INNER JOIN gestionti_usuarios ON gestionti_gastos.DocumentoUsuario=gestionti_usuarios.DocumentoUsuario", $conectarbd) or die(mysql_error());
		
		$sqlusergastos=mysql_query("SELECT gestionti_usuarios.NombreUsuario,
		gestionti_usuarios.ApellidoUsuario,
		gestionti_usuarios.DocumentoUsuario,
		gestionti_gastos.OrigenGasto,
		gestionti_gastos.DestinoGasto,
		gestionti_gastos.ValorGasto,
		gestionti_gastos.FechaGasto,
		gestionti_clientes.NombreCliente,
		gestionti_clientes.DireccionCliente,
		gestionti_clientes.TelefonoCliente
		FROM gestionti_usuarios
		INNER JOIN gestionti_gastos ON gestionti_usuarios.DocumentoUsuario=gestionti_gastos.DocumentoUsuario
		INNER JOIN gestionti_clientes ON gestionti_usuarios.DocumentoUsuario=gestionti_clientes.DocumentoUsuario", $conectarbd) or die(mysql_error());
		
		$sqluser=mysql_query("select * from gestionti_usuarios")or die(mysql_error());
		
		//validar que la seesion exista	
	
?>

<!DOCTYPE html>

<html>
<head>
	<title>AgregarGasto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" user-scalable=no>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
		<div>
			<div class="container" style="width:60%;height:50%">
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
						
						<div id="collapse1" class="panel-collapse collapse in">
							<div class="panel-body">
							
								<form action="crud/crudgastos.php" method="POST" class="form-inline">
									<div class="form-group">
									<label>Descripcion</label>
										<textarea type="number" name="txt_usuario_id" readonly required value="<?php echo $row['usuario_id']?>"></textarea>
										
									</div>
									
									<button name="guardar" value="updategastos" type="submit" class="btn btn-success">Guardar </button>
									
							    </form>
						
						
							</div>
						</div>
					</div>
				</div>
				
				
			</div>
		</div>	

</body>

</html>
	