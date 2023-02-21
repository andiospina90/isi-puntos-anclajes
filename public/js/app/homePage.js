$(document).ready(function () {

    $('#puntosAnclajeTabla').DataTable({
        responsive: true,
        bProcessing: true,
        serverSide: true,
        ajax: {
            url: "obtenerPuntosDeAnclaje",
            dataSrc: "aaData",
        },
        rowReorder: {
            selector: "td:nth-child(2)",
        },
        order: [[17, 'desc']],
        aoColumnDefs: [
            {
                mData: 'sistema_proteccion',
                aTargets: [0],
            },
            {
                mData: null,
                mRender: function (data, type, row) {
                    return row.empresa;
                },
                aTargets: [1],
            },
            {
                mData: 'precinto',
                aTargets: [2],
            },
            {
                mData: 'serial',
                aTargets: [3],
            },
            {
                mData: 'instalador',
                aTargets: [4],
            },
            {
                mData: 'persona_calificada',
                aTargets: [5],
            },
            {
                mData: 'fecha_instalacion',
                aTargets: [6],
            },
            {
                mData: 'fecha_inspeccion',
                aTargets: [7],
            },
            {
                mData: 'fecha_proxima_inspeccion',
                aTargets: [8],
            },
            {
                mData: 'marca',
                aTargets: [9],
            },
            {
                mData: 'numero_usuarios',
                aTargets: [10],
            },
            {
                mData: 'uso',
                aTargets: [11],
            },
            {
                mData: 'resistencia',
                aTargets: [12],
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
                aTargets: [13],
            },
            {
                mData: 'ubicacion',
                aTargets: [14],
            },
            {
                mData: 'observaciones',
                aTargets: [15],
            },
            {
                mData: null,
                mRender: function (data, type, row) {
                    return  `<a href="editarPuntoAnclaje/${row.id}" class="btn btn-success">editar</a>`
                },
                aTargets: [16],
            },      
            {
                mData: 'id',
                aTargets: [17],
            }  
        ]

        
    });
 
    // $.ajax({
    //     type: "GET",
    //     url: "obtenerPuntosDeAnclaje",
    //     success: function (response) {
    //         $("#puntosAnclajeTabla").empty();
    //         if (response.lenght != 0) {
    //             let puntosAnclajeTabla = $("#puntosAnclajeTabla").DataTable({
    //                 responsive: true,
    //                 data: response,
    //                 order: [[6, 'desc']],
    //                 rowReorder: {
    //                     selector: "td:nth-child(2)",
    //                 },
    //                 columnDefs: [
    //                     {
    //                         title: "Sistema de protección",
    //                         data: 'sistema_proteccion',
    //                         targets: 0,
    //                     },
    //                     {
    //                         title: "Empresa",
    //                         data: null,
    //                         render: (data, type, row) => {
    //                             return row.empresa.nombre;
    //                         },
    //                         targets: 1,
    //                     },
    //                     {
    //                         title: "Precinto",
    //                         data: "precinto",
    //                         targets: 2,
    //                     },
    //                     {
    //                         title: "Serial",
    //                         data: "serial",
    //                         targets: 3,
    //                     },
    //                     {
    //                         title: "Instalador",
    //                         data: "instalador",
    //                         targets: 4,
    //                     },
    //                     {
    //                         title: "Persona calificada",
    //                         data: "persona_calificada",
    //                         targets: 5,
    //                     },
    //                     {
    //                         title: "Fecha instalación",
    //                         data: "fecha_instalacion",
    //                         targets: 6,
    //                     },
    //                     {
    //                         title: "Fecha inspección",
    //                         data: "fecha_inspeccion",
    //                         targets: 7,
    //                     },
    //                     {
    //                         title: "Fecha próxima inspección",
    //                         data: "fecha_proxima_inspeccion",
    //                         targets: 8,
    //                     },
    //                     {
    //                         title: "Marca",
    //                         data: "marca",
    //                         targets: 9,
    //                     },
    //                     {
    //                         title: "Número de usuarios",
    //                         data: "numero_usuarios",
    //                         targets: 10,
    //                     },
    //                     {
    //                         title: "Uso",
    //                         data: 'uso',
    //                         targets: 11,
    //                     },
    //                     {
    //                         title: "Resistencia",
    //                         data: "resistencia",
    //                         targets: 12,
    //                     },
    //                     {
    //                         title: "Estado",
    //                         data: null,
    //                         render: (data, type, row) => {
    //                             let uso = "";
    //                             if(row.estado == 'NO APROBADO'){
    //                                 return `<button type="button" class="btn btn-danger btn-sm">NO APROBADO</button>`
    //                             }
    //                             else{
    //                                 return `<button type="button" class="btn btn-success btn-sm">APROBADO</button>`
    //                             }
    //                         },
    //                         targets: 13,
    //                     },
    //                     {
    //                         title: "Ubicación",
    //                         data: "ubicacion",
    //                         targets: 14,
    //                     },
    //                     {
    //                         title: "Observaciones",
    //                         data: "observaciones",
    //                         targets: 15,
    //                     },
    //                     {
    //                         title: "Editar",
    //                         data: null,
    //                         render: (data, type, row) => {
    //                             return  `<a href="editarPuntoAnclaje/${row.id}" class="btn btn-success">editar</a>`
    //                         },
    //                         targets: 16,
    //                     },

    //                     // {
    //                     //     title: "Editar",
    //                     //     render: function(data, type, row) {
    //                     //         if (row.deleted_at == null) {
    //                     //             return `<a href="deleteEmployee/${row.id}" class="btn btn-danger"><span class="fa fa-trash-o"></a>`
    //                     //         } else {
    //                     //             return `<a href="deleteEmployee/${row.id}" class="btn btn-danger"><span class="fa fa-undo"></a>`
    //                     //         }

    //                     //     },
    //                     //     targets: 6
    //                     // },
    //                 ],
    //                 language: {
    //                     url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    //                 },
    //             });
    //         }

    //         console.log(response);
    //     },
    // });
});
