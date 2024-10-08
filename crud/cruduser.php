<?php 


require_once("../conexion/conexion.php");

  //VARIABLES DE REGISTRO USUARIOS
	@$user		= $_REQUEST['txt_user'];
	@$ape		= $_REQUEST['txt_ape'];
	@$doc		= $_REQUEST['txt_doc'];
	@$passw		= $_REQUEST['txt_passw'];
	
  //VARIABLES DE REGISTRO CLIENTES
  @$nomclien 	= $_REQUEST['txt_nombclien'];
  @$dirclien 	= $_REQUEST['txt_dirclien'];
  @$telclien 	= $_REQUEST['txt_telclien'];


  //VARIABLES DE BUSCAR USUARIO PARA MODIFICARLO
  	@$buscarpor = $_POST['txt_buscarpor'];
  	@$buscado   = $_POST['txt_buscado'];

 //Declaramos la variable que distingue la acción

  @$accion = $_POST["guardar"];
  
	switch ($accion) {
	
			//CASO REGISTRAR USUARIO
			case 'guser':
				$sql = mysql_query("INSERT INTO gestionti_usuarios(NombreUsuario, ApellidoUsuario, DocumentoUsuario, ClaveUsuario) VALUES ('".$user."','".$ape."', '".$doc."', '".$passw."')",$conectarbd);
				$accionmsn="Guardo";
			break;
			   
			//CASO MODIFICAR USUARIO
			case 'updategastos':
				$sql=mysql_query("UPDATE gestionti_gastos SET Descripcion='".$observaciones."' WHERE DocumentoUsuario='".$conductor."' ",$conexion);
				$accionmsn="Modifico";	
			break;


			//CASO REGISTRAR CLIENTE
			case 'gclient':
				$sql = mysql_query("INSERT INTO gestionti_clientes(NombreCliente, DireccionCliente, TelefonoCliente ) VALUES ('".$nomclien."','".$dirclien."', '".$telclien."') ",$conectarbd);
				$accionmsn="Guardo";
			break;

			//CASO MODIFICAR CLIENTE
			case 'updategastos':
				$sql=mysql_query("UPDATE gestionti_gastos SET Descripcion='".$observaciones."' WHERE DocumentoUsuario='".$conductor."' ",$conexion);
				$accionmsn="Modifico";	
			break;


    if (!$sql) {
        $msn = "Error al Guardar".mysql_error();
        }
    else
      {
      $msn = "El Dato ha sido ".$accionmsn." correctamente!"; 
      } 
     }
       
    // Header location es igual al a href solo que es automatico
 header("Location: ../menu.php?mensaje=".$msn);



 ?>