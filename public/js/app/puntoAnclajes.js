$(function() {
    $("#sistema_proteccion").on("change", function(e) {
        console.log(e.target.value);
        if (e.target.value == 0 || e.target.value == 3) {
            $("#numero_usuarios").val(1);
        } else {
            $("#numero_usuarios").val(2);
        }
    });

    $("#marca").on("change", function(e) {
        console.log(e.target.value);
        if (e.target.value == "OTRO") {
            $("#marca_otro").css({ display: "block" });
            $("#marca_otro_input").css({ display: "block" });
        } else {
            $("#marca_otro").css({ display: "none" });
            $("#marca_otro_input").css({ display: "none" });
        }
    });

    //onchange precinto_final can't be less than precinto_inicial
    $("#precinto_final").on("change", function(e) {
        const precinto_inicial = parseInt($("#precinto_inicial").val());
        const precinto_final = parseInt($("#precinto_final").val());
        if (precinto_final < precinto_inicial) {
            document.getElementById("error_preciento_final").style.color = "red";
            document.getElementById("error_preciento_final").style.display = "block";
            document.getElementById("precinto_final").style.border = "1px solid red";
            document.getElementById("guardar").disabled = true;
        } else {
            document.getElementById("error_preciento_final").style.display = "none";
            document.getElementById("precinto_final").style.border = "1px solid #ced4da";
            document.getElementById("guardar").disabled = false;
        }
    });

    document.getElementById("fecha_instalacion").valueAsDate = new Date();

    // let fechas = document.querySelectorAll('input[type="date"]');

    var today = new Date().toISOString().split("T")[0];

    // for (var i = 0; i < fechas.length; i++) {
    //     fechas[i].setAttribute("min", today);
    // }

    let fecha_inspeccion = document.getElementById("fecha_inspeccion");
    fecha_inspeccion.setAttribute("min", today);
    
});
