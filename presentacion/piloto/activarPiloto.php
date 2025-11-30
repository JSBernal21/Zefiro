<?php 
require_once ("logica/Persona.php");
require_once ("logica/Piloto.php");
$correo = base64_decode($_GET["c"]);
$clave = base64_decode($_GET["p"]);
$piloto = new Piloto();
$piloto -> activar($correo);
?>
<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col">
				<div class='alert alert-success' role='alert'>
					Piloto activado, ya puede iniciar sesion con las siguientes credenciales:<br>
                    Correo: <?php echo $correo; ?><br>
                    Contraseña: <?php echo $clave; ?>
				</div>
			</div>
		</div>
	</div>
</body>