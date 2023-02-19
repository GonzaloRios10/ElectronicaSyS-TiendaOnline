<?php

include("conexion.php");

if (isset($_POST['registrar'])) {
	if(isset($_POST['user'])){

		$nom = $_POST['nombre'];
		$ape = $_POST['apellido'];
		$email = $_POST['email'];
		$tel = $_POST['telefono'];
		$ciudad = $_POST['localidad_provincia'];
		$user = $_POST['user'];
	    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
	    $rol = 2;

	    $user_exist = $conex->query("SELECT * FROM clientes WHERE Usuario = '$user'");

	    if (mysqli_num_rows($user_exist) > 0) {
	    	?>
	    	<br> 
	    	<h3>¡Usuario existente!</h3>
           <?php
	    }else{
	    	$consulta = "INSERT INTO clientes(Nombre, Apellido, Email, Telefono, Localidades_idLocalidades, Usuario, Contraseña, Categorias_usuarios_idCategorias_usuarios) VALUES ('$nom', '$ape', '$email',
	    	'$tel', '$ciudad', '$user', '$pass', '$rol')";

		    $resultado = mysqli_query($conex, $consulta);

		    if ($resultado) {
		    	?>
		    	<br> 
		    	<h3>¡Registrado correctamente!</h3>
	           <?php
		    } else {
		    	?>
		    	<br>  
		    	<h3>¡Ups ha ocurrido un error!</h3>
	           <?php
		    }
	    }
	    
    } else {
	    	?>
	    	<br>  
	    	<h3>¡Por favor complete los campos!</h3>
           <?php
    }
}



?>

