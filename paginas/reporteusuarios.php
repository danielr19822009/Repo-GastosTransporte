<?php
	header("Content-type: application/vnd.ms-excel");
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=reporteusuarios.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$selec=mysql_query("SELECT NombreUsuario,ApellidoUsuario,DocumentoUsuario FROM gestionti_usuarios ORDER BY DocumentoUsuario ASC");
	
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
		<title>Reporte de Usuarios</title>
		
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>

	<body>
			<table class="table table-hover">
					<tr style="text-align:center">
						<!-- Imprimimos un titulo -->
							<div>
								<span>Reporte Usuarios</span>
							</div>
					</tr>
					
					<tr>
						<th ><strong>Nombre</strong></th>
						<th ><strong>Apellido</strong></th>
						<th ><strong>ID</strong></th>
					</tr>
					<?php
					// Un proceso repetitivo para imprimir cada uno de los registros.
					while($row = mysql_fetch_array($selec)){
						echo "<tr>";
							echo "<td>".$row["NombreUsuario"]."</td>";
							echo "<td>".$row["ApellidoUsuario"]."</td>";
							echo "<td>".$row["DocumentoUsuario"]."</td>";
						echo "<tr>";
					}
					?>
			</table>
	
	</body>
	
	
</html>




