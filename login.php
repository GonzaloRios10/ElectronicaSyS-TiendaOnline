<?php

include("conexion.php");

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="login.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<title>Iniciar Sesión</title>
</head>

<body class="box">
	
	<?php
	
	include("header.php");

	?>

	<div class="box-form">
		<div class="img">
            <img src="user.png" alt="Foto de Perfil" class="foto-perfil">
        </div>
		<form method="POST" class="box-form-user">
			<?php
			include("procesar_login.php");
			?>
			<br>
			<label>Usuario</label>
			<br><br>
			<input placeholder="Nombre de usuario" type="text" name="nombre">
			<br><br><br>
			<label>Contraseña</label>
			<br><br>
			<input placeholder="Password" type="password" name="contraseña">
			<br><br>
			<a href="formulario_nuevo_usuario.php" id="nueva_cuenta" type="submit">Crear cuenta</a>
			<input type="submit" name="btningresar" id="boton_ingresar" value="Ingresar"><br><br>
			<!-- <a href="#" id="olvi_contraseña" >Olvidaste tu contraseña?</a> -->
		</form>
	</div>
</body>
</html>