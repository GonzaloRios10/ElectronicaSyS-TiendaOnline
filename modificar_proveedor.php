<?php

include("conexion.php");

?>

<?php

session_start();

$usuario = $_SESSION['UsuarioAdmin'];

if (isset($_SESSION['UsuarioAdmin'])) {

	$id = $_GET['id'];

	$consulta = "SELECT * FROM proveedores prov INNER JOIN localidades loca 
		ON prov.Localidades_idLocalidades = loca.idLocalidades
		INNER JOIN codigo_postal cp ON loca.Codigo_Postal_idCodigo_Postal = cp.idCodigo_Postal
		INNER JOIN provincias provin ON loca.Provincias_idProvincias = provin.idProvincias 
		WHERE idProveedores ='".$id."'";

	$resultado = mysqli_query($conex, $consulta);
		while ($registro = mysqli_fetch_assoc($resultado)) {	
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_modificar-productos.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" type="text/javascript"></script>
	<title>Formulario Proveedor</title>
</head>
<body>
	
	<?php

	include("header_admin.php");

	?>

	<div id="caja_form">
		<center><h1><i class="fa-solid fa-file-lines"></i> Formulario</h1></center>
		<form action="update_proveedor.php" id="form_entrada" method="POST" enctype="multipart/form-data">
			<input placeholder="Codigo" name="id" style="visibility:hidden;" value="<?php echo $registro['idProveedores']?>">
			<center><h2><?php echo $registro['Nombre']?></h2></center>

			<p>Nuevo nombre*</p>
			<input type="text" placeholder="Nombre" name="nombre" value="<?php echo $registro['Nombre']?>">
			<br>
			<p>Nuevo Telefono*</p>
			<input type="text" placeholder="Telefono" name="telefono" value="<?php echo $registro['Telefono']?>">
			<br>
			<p>Nuevo tipo de categoria*</p>
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
			<button type="submit" id="boton_modificar" name="">Actualizar</button>
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
<?php
} 

}else{
	header('location: login.php');
}

?>

</body>
</html>