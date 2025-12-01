<?php 
$correo = base64_decode($_GET["c"]);
$pasajero = new Pasajero();
$pasajero -> activar($correo);
?>
<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col">
				<div class='alert alert-success' role='alert'>
					Usuario activado
				</div>
			</div>
		</div>
	</div>
</body>
