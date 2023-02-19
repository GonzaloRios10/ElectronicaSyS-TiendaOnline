<?php

include("conexion.php");

session_start();

if(!isset($_SESSION['carrito'])) {
	header('location: index.php');
}else{
	$arreglo = $_SESSION['carrito'];
}

if (!isset($_SESSION['UsuarioClien'])) {
	header('location: login.php');
}else{
	$user = $_SESSION['UsuarioClien'];
}

// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-4237304971256051-112719-fda83cbf1ededa2f1110256188f18cb8-253418123');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$preference->back_urls = array(
    "success" => "http://localhost/xampp/Proyectos/Electronicasys/registrar_venta.php",
    // "failure" => "http://localhost/xampp/Proyectos/Electronicasys/registrar_venta.php",
    "pending" => "http://localhost/xampp/Proyectos/Electronicasys/registrar_venta.php"    
);

$preference->auto_return = "approved";
$preference->binary_mode = true;

//Crea un ítem en la preferencia
$datos = array();

if (isset($_SESSION['carrito'])) {
	$arregloCarrito = $_SESSION['carrito'];
	for($i = 0; $i < count($arregloCarrito); $i++){
		$item = new MercadoPago\Item();
		$item->title = $arregloCarrito[$i]['Nombre'];
		$item->quantity = $arregloCarrito[$i]['Cantidad'];
		$item->unit_price = $arregloCarrito[$i]['Precio'];
		$datos[] = $item;
	}
}

$preference->items = $datos;

$preference->save();

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_confirmar-compra.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" type="text/javascript"></script>
	<script src="https://sdk.mercadopago.com/js/v2"></script>
	<title>Comprar</title>
</head>
<body>

	<?php
    
    include("header.php");

    ?>

    <script>
	  const mp = new MercadoPago('TEST-71263583-cf93-49f5-b6d8-e1fb015596b8', {
	    locale: 'es-AR'
	  });

	  mp.checkout({
	    preference: {
	      id: '<?php echo $preference->id;?>' 
	    },
	    render: {
	      container: '.cho-container',
	      label: 'Mercado Pago'
	    }
	  });
	</script>

	<div class="row">
		<div class="row-detalles_dePago">
			<h2>Pagar con</h2>
			<br>
			<img style="width: 50px;" src="imagenes_sys/mercado-pago.png">
			<div class="cho-container"></div>
		</div>

		<div class="row-box">
			<center>
				<h2>Detalles de compra</h2>
				<br>
			</center>
			<table class="row-box-table">
				<thead>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio X unidad</th>
				</thead>

				<tbody>
					<?php
						$total = 0;
						for($i = 0; $i < count($arreglo); $i++){
							$total = $total + ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);	
					?>
					<tr>
						<td><?php echo $arreglo[$i]['Nombre'];?></td>
						<td><?php echo $arreglo[$i]['Cantidad'];?></td>
						<td>$ <?php echo number_format($arreglo[$i]['Precio'], 2, ',', ',');?></td>
					</tr>

					<?php
						}
					?>
					
					<tr>
						<td></td>
					</tr>

					<tr>
						<td><strong>Total de la orden</strong></td>
						<td></td>
						<td>$ <?php echo number_format($total, 2, ',', ',');?></td>
					</tr>
				</tbody>
			</table> 
		</div>
	</div>
</body>
</html>