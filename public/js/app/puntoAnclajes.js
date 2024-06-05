$(document).ready(function() {

    $('#id_empresa').select2({ theme: 'bootstrap-5', focus: true });
    $('#instalador').select2({ theme: 'bootstrap-5', focus: true });
    $('#persona_calificada').select2({ theme: 'bootstrap-5', focus: true });
    $('#sistema_proteccion').select2({ theme: 'bootstrap-5', focus: true });
    $('#uso').select2({ theme: 'bootstrap-5', focus: true });
    // $('').select2();
    // $('').select2();


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
    $("#precinto_final").on("change", function() {
        const precinto_inicial = parseInt($("#precinto_inicial").val());
        const precinto_final = parseInt($(this).val());
        const errorPrecintoFinal = $("#error_preciento_final");
        const guardarBtn = $("#guardar");
        console.log(precinto_inicial, precinto_final);
        if (precinto_final < precinto_inicial) {
            errorPrecintoFinal.css({"color": "red", "display": "block"});
            $(this).css("border", "1px solid red");
            guardarBtn.prop("disabled", true);
        } else {
            errorPrecintoFinal.hide();
            $(this).css("border", "1px solid #ced4da");
            guardarBtn.prop("disabled", false);
        }
    });

    document.getElementById("fecha_instalacion").valueAsDate = new Date();

    // let fechas = document.querySelectorAll('input[type="date"]');

    var today = new Date().toISOString().split("T")[0];

    // for (var i = 0; i < fechas.length; i++) {
    //     fechas[i].setAttribute("min", today);
    // }

    // let fecha_inspeccion = document.getElementById("fecha_inspeccion");
    // fecha_inspeccion.setAttribute("min", today);
    
});
