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
        if (e.target.value == 'OTRO') {
            $("#marca_otro").css({ display: "block" });
            $("#marca_otro_input").css({ display: "block" });
        } else {
            $("#marca_otro").css({ display: "none" });
            $("#marca_otro_input").css({ display: "none" });
        }
    });

    document.getElementById("fecha_instalacion").valueAsDate = new Date();

    let fechas = document.querySelectorAll('input[type="date"]');

    var today = new Date().toISOString().split("T")[0];

    for (var i = 0; i < fechas.length; i++) {
        fechas[i].setAttribute("min", today);
    }


});