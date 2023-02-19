<?php
include("conexion.php");

session_start();

if (!empty($_POST['btningresar'])) {
	if (!empty($_POST['nombre']) and !empty($_POST['contraseña'])) {
		$usuario = $_POST['nombre'];
		$password = $_POST['contraseña'];

		$dbusername = $dbpassword = $password = NULL;

		$result_Clientes = mysqli_query($conex, "SELECT * FROM clientes WHERE Usuario = '$usuario'");
		$numrows_Clientes = mysqli_num_rows($result_Clientes);

		$result_Admin = mysqli_query($conex, "SELECT * FROM administradores WHERE Usuario = '$usuario'");
		$numrows_Admin = mysqli_num_rows($result_Admin);

		if ($numrows_Clientes!=0) {
		    if ($row = mysqli_fetch_assoc($result_Clientes)) {
		        $dbusername = $row['Usuario'];
		        $dbpassword = $row['Contraseña'];
		        $dbcategoria = $row['Categorias_usuarios_idCategorias_usuarios'];
		  	}
		}elseif ($numrows_Admin!=0) {
			if ($row = mysqli_fetch_assoc($result_Admin)) {
		        $dbusername = $row['Usuario'];
		        $dbpassword = $row['Contraseña'];
		        $dbcategoria = $row['Categorias_usuarios_idCategorias_usuarios'];
		  	}
		}

		$password = $_POST['contraseña'];

		if (password_verify($password, $dbpassword) && $dbcategoria == 1) {
		    $_SESSION['UsuarioAdmin'] = $usuario;
		    header("Location: mostrar_productos.php");
	    }elseif (password_verify($password, $dbpassword) && $dbcategoria == 2) {
	    	$_SESSION['UsuarioClien'] = $usuario;
		    header("Location: index.php");
	    }else {
		 	?>
	    		<h3>¡Usuario/Contraseña no valido!</h3>
           	<?php
		}

	}else{
		?>
	    <h3>¡Campos vacios!</h3>
        <?php
	}
}

?>