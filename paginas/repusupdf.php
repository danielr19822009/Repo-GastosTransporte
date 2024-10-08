<?php
	//LLAMAMOS LA LIBRERIA
	require('\pdf\fpdf.php');
	
	//LLAMAMOS LA CONEXION
	require('\conexion\conexion.php');

	$PDF = new FPDF();
	$PDF ->AddPage();
	//FORMATAO HEADER DEL PDF
	$PDF ->SetFont('Arial','',10); //TRES PARAMETROS QUE SON(1-Tipo letra ,2-formatode la letra cursiva negrita etc, 3-Tamaño de la fuente)
	$PDF->Image('IMAGENES\ti2.png',30,20,60,30,'PNG'); //colocar imagen en nuestro pdf
	$PDF ->Cell(18,10,'',0);
	$PDF ->Ln(0);
	$PDF ->Cell(150,20,'Reporte de Usuarios - Gastos GestionTI',0); //celda del titulo de la hoja pdf
	$PDF ->SetFont('Arial','',9);
	$PDF->Cell(40,10,'Fecha: '.date('d/m/Y'),0,1,'L');
	$PDF ->Ln(30);  //salto de linea
	
	//FORMATO CREACION DE LA TABLA
	$PDF ->SetFont('Arial','B',11);
	$PDF ->Cell(70,8,'',0);
	$PDF ->Cell(100,8,'Listado Usuarios',0);
	$PDF ->Ln(8);
	$PDF ->Ln(15);
	$PDF ->SetFont('Arial','B',8);
	$PDF ->Cell(40,8,'Nombre',0); //1 largo-fila 2 alto-fila 3 nombre-fila
	$PDF ->Cell(40,8,'Apellido',0);
	$PDF ->Cell(40,8,'Documento',0);
	$PDF ->Ln(8);
	
	//FORMATO REGISTROS DE LA BASE DE DATOS
	$PDF ->SetFont('Arial','',8);
	
	if($selecion = 'usuariospdf'){
		//CREAMOS LA CONSULTA
		$sqlusuarios=mysql_query("select * from gestionti_usuarios");

		while($usuarios = mysql_fetch_array($sqlusuarios)){
			$PDF ->Cell(40,8,$usuarios['NombreUsuario'],0);
			$PDF ->Cell(40,8,$usuarios['ApellidoUsuario'],0);
			$PDF ->Cell(40,8,$usuarios['DocumentoUsuario'],0);
			$PDF ->Ln(8);
		}
	}	
		ob_end_clean();
	$PDF ->Output();
?>