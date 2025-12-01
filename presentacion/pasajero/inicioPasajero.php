<div class="container-fluid p-0">
    <div class="w-100" style="height: 70vh;">
        <img src="img/patoInicioCliente.png"
            class="w-100 h-100 object-fit-cover"
            alt="Bienvenida">
    </div>
</div>



<div class="container mx-2 mx-md-5 py-3">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-50 text-center">
            <h3 class="m-0">¿Todo listo para un viaje?</h3>
        </div>
        <div class="card-body text-center">
            <div class="container mt-4">
                <form class="row g-2 align-items-center p-3 bg-white rounded shadow-sm">

                    <!-- Origen -->
                    <div class="col-md-3">
                        <label class="form-label mb-0">Origen</label>
                        <div class="input-group">
                            <i class="fa-solid fa-plane-departure"></i>
                            <input type="text" id="busqueda" class="form-control" placeholder="Bogotá (BOG)" autocomplete="off">
                        </div>
                    </div>

                    <!-- Destino -->
                    <div class="col-md-3">
                        <label class="form-label mb-0">Destino</label>
                        <div class="input-group">
                            <i class="fa-solid fa-plane-arrival"></i>
                            <input type="text" class="form-control" placeholder="Destino">
                        </div>
                    </div>

                    <!-- Fecha ida -->
                    <div class="col-md-2">
                        <label class="form-label mb-0">Ida</label>
                        <div class="input-group">
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <!-- Fecha vuelta -->
                    <div class="col-md-2">
                        <label class="form-label mb-0">Vuelta</label>
                        <div class="input-group">
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label mb-0">N° usuarios</label>
                        <div class="input-group">
                            <i class="fa-solid fa-user-plus"></i>
                            <input type="text" class="form-control" placeholder="1">
                        </div>
                    </div>

                    <!-- Botón Buscar -->
                    <div class="col-md-1 d-grid">
                        <button class="btn text-white" style="background-color:#a078eb;">Buscar</button>
                    </div>

                </form>
            </div>
            <h4>Compra tus boletas</h4>
            <div id="resultado"></div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
	$("#busqueda").keyup(function(){
		if($("#busqueda").val().length >= 3){
			var ruta = "buscarCiudadAjax.php?busqueda=" + $("#busqueda").val().replaceAll(" ", "%20");
			console.log(ruta);
			$("#resultado").load(ruta);
		}
	});
});
</script>