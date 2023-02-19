<?php

include("conexion.php");

?>

<?php
session_start();

$usuario = $_SESSION['UsuarioAdmin'];

if (isset($_SESSION['UsuarioAdmin'])) {

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_formulario_nuevo-producto.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" type="text/javascript"></script>
	<title>Formulario Producto</title>
</head>
<body>
	
	<?php

	include("header_admin.php");

	?>

	<?php
	}else{
		header('location: login.php');
	}

	?>

	<div id="caja_form">
		<center><h1><i class="fa-solid fa-file-lines"></i> Formulario</h1></center>
		
		<form id="form_entrada" method="POST" enctype="multipart/form-data">
			<br>
			<center><h2>Nuevo Proveedor </h2></center>

			<?php
			include("registro_proveedores.php");
			?>
			
			<p>Nombre*</p>
			<input type="text" placeholder="Nombre del proveedor" name="nombre">
			<br>
			<p>Telefono*</p>
			<input type="text" placeholder="Telefono del proveedor" name="telefono"></input>
			<p>Ciudad y Provincia*</p>
			<br>
			<select id="lista1">
				<?php
				$consulta = "SELECT * FROM provincias";
				$ejecutar = mysqli_query($conex, $consulta);
				?>

				<?php
				while($row = mysqli_fetch_array($ejecutar)){
					$id = $row['idProvincias'];
					$desc_loca = $row['Desc_provincia'];
					?>
						<option value="<?php echo $id?>"><?php echo $desc_loca?></option>
					<?php
					}
				?>
				<option disabled="true" selected="true" value="0">Seleccione una provincia</option>
			</select>
			<br><br>
			<select id="select2lista" name="localidad_provincia"></select>
			<br>

			<button type="submit" id="boton_registrar" name="registrar">Registrar</button>
		</form>

		<br><br>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#lista1').val(0);
			recargarLista();

			$('#lista1').change(function(){
				recargarLista();
			});
		})
	</script>
	<script type="text/javascript">
		function recargarLista(){
			$.ajax({
				type:"POST",
				url:"datos.php",
				data:"provincia=" + $('#lista1').val(),
				success:function(r){
					$('#select2lista').html(r);
				}
			});
		}
	</script>
	
</body>
</html>