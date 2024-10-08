
<?php
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=reportegastos.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$selec=mysql_query("SELECT origengasto,destinogasto,valorgasto,Descripcion,DocumentoUsuario FROM gestionti_gastos ORDER BY DocumentoUsuario ASC");
	
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
								<span> Reporte Usuarios</span>
							</div>
					</tr>
					
					<tr>		
						<th ><strong>Origen</strong></th>
						<th ><strong>Destino</strong></th>
						<th ><strong>Valor</strong></th>
						<th ><strong>Descripccion</strong></th>
						<th ><strong>Documento</strong></th>
					</tr>
					<?php
					// Un proceso repetitivo para imprimir cada uno de los registros.
					while($row = mysql_fetch_array($selec)){
						
						echo "<tr>";
							echo "<td>".$row["origengasto"]."</td>";
							echo "<td>".$row["destinogasto"]."</td>";
							echo "<td>".$row["valorgasto"]."</td>";
							echo "<td>".$row["Descripcion"]."</td>";
							echo "<td>".$row["DocumentoUsuario"]."</td>";
						echo "<tr>";
					}
					?>
			</table>
	
	</body>
	
	
</html>