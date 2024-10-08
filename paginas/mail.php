<?php 
	
	@$from  		= $_REQUEST["txt_remitente"];
	@$destinatario  = $_REQUEST["txt_remitente"];
	@$asunto     	= $_REQUEST["txt_asunto"];
	@$cuerpo  		= $_REQUEST["txt_comentario"];

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Enviar E mail</title>
</head>
<body>

	<h2>Formulario de Ayuda</h2>
<br><br>
	<form method="POST" action="">

		<div class="input-group" style="width:30%" >
			<label> Introduce tu email:</label>
			<input name="txt_remitente" type="email" class="form-control"
			 pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
		</div><br>

		<div class="input-group" style="width:30%" >
		<label>Asunto:</label>
			<input name="txt_asunto" type="text" class="form-control"
			 required style="text-transform:uppercase">
		</div><br>

		<label>Comentario:</label>
		<textarea name="txt_comentario" class="form-control" style="width:30%" required></textarea><br><br>


		<input value="Enviar" type="submit" class="btn btn-success">



	</form>

	<?php 
	echo $from. .$asunto;
	?>



</body>


</html>