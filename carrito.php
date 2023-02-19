<?php

include("conexion.php");

session_start();
if (isset($_SESSION['carrito'])) {
	if(isset($_GET['id'])) {
		$arreglo = $_SESSION['carrito'];
		$bandera = false;
		$numero = 0;
		for ($i = 0; $i < count($arreglo); $i++) { 
			if ($arreglo[$i]['Id'] == $_GET['id']) {
				$bandera = true;
				$numero = $i;
			}
		}
		if ($bandera == true) {
			$arreglo[$numero]['Cantidad'] = $arreglo[$numero]['Cantidad'] + 1;
			$_SESSION['carrito'] = $arreglo;
			header("location: carrito.php");
		}else{
			$nombre = "";
			$precio = "";
			$imagen = "";
			$resul = $conex->query("SELECT * FROM productos WHERE idProductos=".$_GET['id']);
			$fila = mysqli_fetch_row($resul);
			$nombre = $fila[1];
			$precio = $fila[3];
			$imagen = $fila[5];
			$arregloNuevo = array(
				'Id'=> $_GET['id'],
				'Nombre'=> $nombre,
				'Precio'=> $precio,
				'Imagen'=> $imagen,
				'Cantidad'=> 1
			);
			array_push($arreglo, $arregloNuevo);
			$_SESSION['carrito'] = $arreglo;
			header("location: carrito.php");
		}
	}
}else{
	if(isset($_GET['id'])) {
		$nombre = "";
		$precio = "";
		$imagen = "";
		$resul = $conex->query("SELECT * FROM productos WHERE idProductos=".$_GET['id']);
		$fila = mysqli_fetch_row($resul);
		$nombre = $fila[1];
		$precio = $fila[3];
		$imagen = $fila[5];
		$arreglo[] = array(
			'Id'=> $_GET['id'],
			'Nombre'=> $nombre,
			'Precio'=> $precio,
			'Imagen'=> $imagen,
			'Cantidad'=> 1
		);
		$_SESSION['carrito'] = $arreglo;
		header("location: carrito.php");
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_carrito.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" type="text/javascript"></script>
	<title>Carrito</title>
</head>
<body>
	
	<?php
	
	include("header.php");

	?>

	<div class="row-box">
		<center>
			<h1><i class="fa-solid fa-cart-shopping"></i></h1>
		</center>

		<table class="row-box-table">
			<thead>
				<tr>
					<th>Imagen</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Subtotal</th>
					<th>Eliminar</th>
				</tr>
			</thead>

			<tbody>
				<?php
					$total = 0;
					if (isset($_SESSION['carrito'])) {
						$arregloCarrito = $_SESSION['carrito'];
						for($i = 0; $i < count($arregloCarrito); $i++){
						$total = $total + ($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']);
				?>
				<tr>
					<td>
						<img style="width: 50px;" src="data:image/png;base64,<?php echo base64_encode($arregloCarrito[$i]['Imagen']);?>">
					</td>
					<td><?php echo $arregloCarrito[$i]['Nombre'];?></td>
					<td>$ <?php echo number_format($arregloCarrito[$i]['Precio'], 2, ',', ',');?></td>
					<td>
						<input type="number" class="txtCantidad" 
						value="<?php echo $arregloCarrito[$i]['Cantidad'];?>"
						data-precio="<?php echo $arregloCarrito[$i]['Precio'];?>"
						data-id="<?php echo $arregloCarrito[$i]['Id'];?>"
						>
					</td>
					<td class="cant<?php echo $arregloCarrito[$i]['Id'];?>">
						$ <?php echo number_format($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad'],2,',',',');?>		
					</td>
					<td>
						<a href="#" class="btnEliminar" data-id="<?php echo $arregloCarrito[$i]['Id'];?>">
							<i class="fa-solid fa-trash"></i>
						</a>
					</td>
				</tr>
				<?php
					}
					if ($arregloCarrito != null) {
						?>
						<center>
							<button onclick="window.location='comprar.php'" id="boton_comprar">
								Comprar
							</button>
						</center>
						<?php
					}else{
						header('location: productos.php');
					}
				}
				?>
			</tbody>
		</table>
	</div>

	<script>
		$(document).ready(function(){
			$(".btnEliminar").click(function(event){
				event.preventDefault();
				var id = $(this).data('id');
				var boton = $(this);
				$.ajax({
					method:'POST',
					url:'carrito_borrar.php',
					data:{
						id:id
					}
				}).done(function(respuesta){
					boton.parent('td').parent('tr').remove();
				});
			});
			$(".txtCantidad").keyup(function(){
				var cantidad = $(this).val();
				var precio = $(this).data('precio');
				var id = $(this).data('id');
				incrementar(cantidad, precio, id);
			});
			function incrementar(cantidad, precio, id){
				var multi = parseFloat(cantidad)*parseFloat(precio);
				$(".cant"+id).text("$"+multi);
				$.ajax({
					method:'POST',
					url:'carrito_actualizar.php',
					data:{
						id:id,
						cantidad:cantidad
					}
				}).done(function(respuesta){

				});
			}
		});
	</script>
</body>
</html>