$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "obtenerPuntosDeAnclaje",
        success: function (response) {
            $("#puntosAnclajeTabla").empty();
            if (response.lenght != 0) {
                let puntosAnclajeTabla = $("#puntosAnclajeTabla").DataTable({
                    responsive: true,
                    data: response,
                    order: [[6, 'desc']],
                    rowReorder: {
                        selector: "td:nth-child(2)",
                    },
                    columnDefs: [
                        {
                            title: "Sistema de protección",
                            data: 'sistema_proteccion',
                            targets: 0,
                        },
                        {
                            title: "Empresa",
                            data: null,
                            render: (data, type, row) => {
                                return row.empresa.nombre;
                            },
                            targets: 1,
                        },
                        {
                            title: "Precinto",
                            data: "precinto",
                            targets: 2,
                        },
                        {
                            title: "Serial",
                            data: "serial",
                            targets: 3,
                        },
                        {
                            title: "Instalador",
                            data: "instalador",
                            targets: 4,
                        },
                        {
                            title: "Persona calificada",
                            data: "persona_calificada",
                            targets: 5,
                        },
                        {
                            title: "Fecha instalación",
                            data: "fecha_instalacion",
                            targets: 6,
                        },
                        {
                            title: "Fecha inspección",
                            data: "fecha_inspeccion",
                            targets: 7,
                        },
                        {
                            title: "Fecha próxima inspección",
                            data: "fecha_proxima_inspeccion",
                            targets: 8,
                        },
                        {
                            title: "Marca",
                            data: "marca",
                            targets: 9,
                        },
                        {
                            title: "Número de usuarios",
                            data: "numero_usuarios",
                            targets: 10,
                        },
                        {
                            title: "Uso",
                            data: 'uso',
                            targets: 11,
                        },
                        {
                            title: "Resistencia",
                            data: "resistencia",
                            targets: 12,
                        },
                        {
                            title: "Estado",
                            data: null,
                            render: (data, type, row) => {
                                let uso = "";
                                if(row.estado == 'NO APROBADO'){
                                    return `<button type="button" class="btn btn-danger btn-sm">NO APROBADO</button>`
                                }
                                else{
                                    return `<button type="button" class="btn btn-success btn-sm">APROBADO</button>`
                                }
                            },
                            targets: 13,
                        },
                        {
                            title: "Ubicación",
                            data: "ubicacion",
                            targets: 14,
                        },
                        {
                            title: "Observaciones",
                            data: "observaciones",
                            targets: 15,
                        },
                        {
                            title: "Editar",
                            data: null,
                            render: (data, type, row) => {
                                return  `<a href="editarPuntoAnclaje/${row.id}" class="btn btn-success">editar</a>`
                            },
                            targets: 16,
                        },

                        // {
                        //     title: "Editar",
                        //     render: function(data, type, row) {
                        //         if (row.deleted_at == null) {
                        //             return `<a href="deleteEmployee/${row.id}" class="btn btn-danger"><span class="fa fa-trash-o"></a>`
                        //         } else {
                        //             return `<a href="deleteEmployee/${row.id}" class="btn btn-danger"><span class="fa fa-undo"></a>`
                        //         }

                        //     },
                        //     targets: 6
                        // },
                    ],
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                    },
                });
            }

            console.log(response);
        },
    });
});
