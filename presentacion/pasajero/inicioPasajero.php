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
                            <input type="text" id="origen" class="form-control buscador-ciudad" placeholder="Ciudad Origen" autocomplete="off" data-target="res-origen">
                        </div>
                        <div id="res-origen" class="list-group position-absolute w-50 shadow-sm" style="z-index:1000;"></div>
                    </div>

                    <!-- Destino -->
                    <div class="col-md-3">
                        <label class="form-label mb-0">Destino</label>
                        <div class="input-group">
                            <i class="fa-solid fa-plane-arrival"></i>
                            <input type="text" id="destino" class="form-control buscador-ciudad" placeholder="Destino" autocomplete="off" data-target="res-destino">
                        </div>
                        <div id="res-destino" class="list-group position-absolute w-50 shadow-sm" style="z-index:1000;"></div>
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
            <div id="resultadosVuelos"></div>
            
        </div>
    </div>
</div>

<div class="container my-4">

    
    

</div>

<script>
$(document).ready(function(){

    let inputActual = null;
    $(".buscador-ciudad").keyup(function(){
        inputActual = $(this);
        let valor = $(this).val();
        let target = $(this).data("target");
        let contenedor = $("#" + target);

        if(valor.length >= 3){
            let ruta = "buscarCiudadAjax.php?busqueda=" + encodeURIComponent(valor);
            contenedor.load(ruta);
        } else {
            contenedor.empty();
        }
    });

    $(document).on("click", ".ciudad-item", function(){
        let seleccionado = $(this).data("nombre");

        if(inputActual){
            let target = inputActual.data("target");
            inputActual.val(seleccionado);
            $("#" + target).empty();
        }
    });

    $(document).click(function(e){
        if(!$(e.target).closest(".buscador-ciudad, .list-group").length){
            $(".list-group").empty();
        }
    });


    //
    $("button.btn").click(function(e){
        e.preventDefault();

        let origen = $("#origen").val().trim();
        let destino = $("#destino").val().trim();

        if(origen === "" || destino === ""){
            alert("Por favor selecciona origen y destino.");
            return;
        }

        $("#resultadosVuelos").html(
            "<div class='text-center my-3'><div class='spinner-border'></div></div>"
        );

        $.ajax({
            url: "resultadosVuelosAjax.php",
            method: "GET",
            data: {
                origen: origen,
                destino: destino
            },
            success: function(respuesta){
                $("#resultadosVuelos").html(respuesta);
            }
        });
    });
});
</script>