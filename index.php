<?php

include("conexion.php");

session_start(); 

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_index.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<title>ElectronicaSyS | Tienda Online</title>
</head>

<body>

	<?php
	
	include("header.php");

	?>

	<a href="https://api.whatsapp.com/send?phone=+54 9 376 511-3779&text=Hola, Necesito más información!" class="btn-wsp" target="_BLANK">
		<i class="fa fa-whatsapp icono"></i>
	</a>

	<div id="encabezado">
		<img id="logo_sys" src="SSPNG-03.png" style="width: 250px;">
		<h1>TIENDA DE ELECTRONICA SYS</h1>
		<br>
		<p>Marcando la diferencia</p><br>
	</div>

	<div class="container-cards">
    	<div class="card">
    		<figure>
    			<img src="https://http2.mlstatic.com/D_NQ_NP_601511-MLA40520982050_012020-O.jpg">
    		</figure>
    		<div class="contenido">
    			<h3>Auriculares</h3>
    			<p>Auriculares de tipo vincha marca Noga y mucho más.</p> 
				<a href="productos.php">Leer Más</a>
    		</div>
    	</div>
    	<div class="card">
    		<figure>
    			<img src="https://axa.com.ar/webaxa/16193/teclado-mouse-gamer-nkb-91-noga.jpg">
    		</figure>
    		<div class="contenido">
    			<h3>Teclados y mouse</h3>
    			<p>Combos gamer de teclados y mouse retroiluminados.</p>
    			<a href="productos.php">Leer Más</a>
    		</div>
    	</div>
    	<div class="card">
    		<figure>
    			<img src="https://http2.mlstatic.com/D_NQ_NP_796292-MLA50638648982_072022-V.jpg">
    		</figure>
    		<div class="contenido">
    			<h3>Celulares</h3>
    			<p>Celulares de ultimo modelo, tanto android como iphone.</p>
    			<a href="productos.php">Leer Más</a>
    		</div>
    	</div>
    	<div class="card">
    		<figure>
    			<img src="https://http2.mlstatic.com/D_NQ_NP_607304-MLA49212560696_022022-O.jpg">
    		</figure>
    		<div class="contenido">
    			<h3>Parlantes</h3>
    			<p>Parlantes inalambricos con bluetooth, radio, y más.</p>
    			<a href="productos.php">Leer Más</a>
    		</div>
    	</div>
    </div>

	<div id="container-nosotros">
		<div id="box-img-nosotros">
			<img src="https://www.emprenderalia.com/wp-content/uploads/Crear-una-tienda-online-en-10-pasos-3-meses-y-sin-inversion.jpg">
		</div>
		<div id="box-nosotros">
			<h1 id="titulo">Acerca de nuestra tienda</h1>
			<hr>
			<h2 id="subt">
				Electrónica SyS es una tienda online de Teléfonos y productos tecnologicos varios.
			</h2>
			<br><br>
			<hr>
			<p id="p1">
				En nuestra tienda podes encontrar una gran variedad de productos de diversas marcas y gamas de los mismos. Desde teléfonos Iphone, Samsung, auriculares de todo tipo, parlantes, accesorios para tu dispositi movil, etc.
			</p>
			<br><br>
			<p id="p2">
				Lo que deseamos brindar a nuestros clientes en sus compras es una buena experiencia desde la atencion, guia y muestra de los productos, ofreciendo calidad de los mismo y una confianza hacia nosotros.
			</p>
		</div>
	</div>

	<div id="container-formasdepago">
		<div class="formadepago">
			<h2 class="tittle-formadepago">Efectivo</h2>
			<figure>
    			<img src="imagenes_sys/efectivo.png">
    		</figure>
			<p class="desc-formadepago">Podes acceder a los productos pagando en efectivo y accediendo a descuentos</p>
		</div>

		<div class="formadepago" id="pago2">
			<h2 class="tittle-formadepago">Mercado Pago</h2>
			<figure>
    			<img src="imagenes_sys/mercado-pago.png">
    		</figure>
			<p class="desc-formadepago">Trabajamos con mercado pago, la billetera universal Argentina online más completa</p>
		</div>
	</div>

	<div id="container-clientes">
		<br>
		<h1 id="tittle-comentarios">Algunos clientes y sus reseñas</h1>
		<div class="container_comentarios">
			<div class="row-slider">
		        <ul>
		            <li>
		                <div class="caja_clientes">
							<div class="img-user">
								<img src="user.png">
							</div>
							<strong>@Adri10mrtnez</strong>
							<p class="user-comentario">
								Muy buenos productos y ni hablar de la atencion que brindan!
							</p>
						</div>
		            </li>
		            <li>
		                <div class="caja_clientes">
							<div class="img-user">
								<img src="user.png">
							</div>
							<strong>@Yesenia1039</strong>
							<p class="user-comentario">
								Atencion y productos 10/10😃
							</p>
						</div>
		            </li>
		            <li>
		                <div class="caja_clientes">
							<div class="img-user">
								<img src="user.png">
							</div>
							<strong>@LucaNataotaku10</strong>
							<p class="user-comentario">
								Excelente atencion y productos, muy recomendables
							</p>
						</div>
		            </li>
		            <li>
		                <div class="caja_clientes">
							<div class="img-user">
								<img src="user.png">
							</div>
							<strong>@Fede10zapper</strong>
							<p class="user-comentario">
								Sigan asi! Unos genios👏
							</p>
						</div>
		            </li>
		            <li>
		                <div class="caja_clientes">
							<div class="img-user">
								<img src="user.png">
							</div>
							<strong>@Jesica892</strong>
							<p class="user-comentario">
								Muy lindos productos y hermosa atencion del parte del personal 
							</p>
						</div>
		            </li>
		        </ul>
	    	</div>
		</div>
	</div>

	<?php
	
	include("footer.php");

	?>
	
</body>
</html>