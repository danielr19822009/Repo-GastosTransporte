	
<?php  

	//LLAMAMOS LA CONEXION
	require('\conexion\conexion.php');


	//CREAMOS LA CONSULTA

	$sql = "select * from gestionti_gastos";
	$qur = mysql_query($sql);
		//$sqlgastos=mysql_query("select * from gestionti_gastos");


	//CSV

		// Enable to download this file
			$filename = "Inf-Gastos.csv";

			header("Content-Disposition:attachment; filename=\"$filename\"");
			header("Content-Type: text/csv");

			$display = fopen("php://output", 'w');

			$flag = true;
			while($row = mysql_fetch_array($qur)) {
			    if(!$flag) {
			      // display field/column names as first row
			      fputcsv($display, array_keys($row), ",", '"');
			      $flag = false;
			    }
			    fputcsv($display, array_values($row), ",", '"');
			  }

			fclose($display);






?>	