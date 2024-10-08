<?php 


  require_once("../conexion/conexion.php");

  $usuario = $_SESSION['doc'];

    //VARIABLES DE CAMBIO DE CONTRASEÑA
    $nom        =$_POST['txt_nom'];
    $ape        =$_POST['txt_ape'];
    $doc        =$_POST['txt_doc'];

    $clavant 		=$_POST['txt_clavant'];
    $nueclave  	=$_POST['txt_nueclave'];
    $confclave  =$_POST['txt_confclave'];
    

    $sql =mysql_query("SELECT * FROM gestionti_usuarios WHERE DocumentoUsuario='".$_SESSION['doc']."'");
    $row=mysql_fetch_array($sql);

    if($nueclave==$confclave){
      $mensa  = "Las Contraseñas Coinciden";

        $sql=mysql_query("UPDATE gestionti_usuarios SET NombreUsuario='".$nom."', ApellidoUsuario='".$ape."', DocumentoUsuario='".$doc."', ClaveUsuario='".$confclave."' WHERE DocumentoUsuario='".$doc."' ");
      
      }
      
    else{
       $mensa= "Las Contraseñas NO Coinciden";
    }

    header("Location: ../menu.php?mensaje=$mensa");

?>