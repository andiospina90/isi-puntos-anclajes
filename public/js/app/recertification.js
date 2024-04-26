$(document).ready(function() {

    // $('#id_empresa').select2({ theme: 'bootstrap-5', focus: true });
    // $('#instalador').select2({ theme: 'bootstrap-5', focus: true });
    // $('#persona_calificada').select2({ theme: 'bootstrap-5', focus: true });
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

    $('#recertificacionesTable').DataTable({
        responsive: true,
        bProcessing: true,
        serverSide: true,
        ajax: {
            url: "recertificaciones",
            dataSrc: "aaData",
        },
        rowReorder: {
            selector: "td:nth-child(2)",
        },
        order: [[14, 'desc']],
        aoColumnDefs: [
            {
                mData: 'sistema_proteccion',
                aTargets: [0],
            },
            {
                mData: 'propuesta_principal',
                aTargets: [1],
            },
            {
                mData: 'propuesta_recertificacion',
                aTargets: [2],
            },
            {
                mData: 'precinto',
                aTargets: [3],
            },
            {
                mData: 'serial',
                aTargets: [4],
            },
            {
                mData: 'empresa',
                aTargets: [5],
            },
            {
                mData: 'fecha_recertificacion',
                aTargets: [6],
            },
            {
                mData: 'marca',
                aTargets: [7],
            },
            {
                mData: 'numero_usuarios',
                aTargets: [8],
            },
            {
                mData: 'uso',
                aTargets: [9],
            },
            {
                mData: null,
                mRender: function (data, type, row) {
                    let uso = "";
                    if (row.estado == 'NO APROBADO') {
                        return `<button type="button" class="btn btn-danger btn-sm">NO APROBADO</button>`
                    }
                    else {
                        return `<button type="button" class="btn btn-success btn-sm">APROBADO</button>`
                    }
                },
                aTargets: [10],
            },
            {
                mData: 'ubicacion',
                aTargets: [11],
            },
            {
                mData: 'observaciones',
                aTargets: [12],
            },
            {
                mData: null,
                mRender: function (data, type, row) {
                    return  `<a href="editarPuntoAnclaje/${row.id}" class="btn btn-success">editar</a>`
                },
                aTargets: [13],
            },
            {
                mData: 'id',
                aTargets: [14],
            }
        ]

        
    });
    
});
