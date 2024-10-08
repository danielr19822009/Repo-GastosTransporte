<!--CERRAMOS LA SESSION Y DESTRUIMOS SUS VALORES-->
<?php
	session_start();
?>

<?php
	session_destroy();
	
	//REDIRECIONAMOS AL INDEX
	header("Location: ../index.php"); 
?>