$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "obtenerPuntosDeAnclaje",
        success: function (response) {
            $("#puntosAnclajeTabla").empty();
            if (response.lenght != 0) {
                let puntosAnclajeTabla = $("#puntosAnclajeTabla").DataTable({
                    responsive:true,
                    data: response,
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    columnDefs: [
                        {
                            title: "Sistema de protección",
                            data: null,
                            render: (data, type, row) => {
                                let sistemaProteccion = "";
                                switch (row.sistema_proteccion) {
                                    case 0:
                                        sistemaProteccion = "Punto de anclaje";
                                        break;
                                    case 1:
                                        sistemaProteccion = "línea de vida";
                                        break;

                                    default:
                                        break;
                                }
                                return sistemaProteccion;
                            },
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
                            title: "Fecha instalación",
                            data: "fecha_instalacion",
                            targets: 4,
                        },
                        {
                            title: "Fecha insepección",
                            data: "fecha_inspeccion",
                            targets: 5,
                        },
                        {
                            title: "Marca",
                            data: "marca",
                            targets: 6,
                        },
                        {
                            title: "Número de usuarios",
                            data: "numero_usuarios",
                            targets: 7,
                        },
                        {
                            title: "Uso",
                            data: null,
                            render: (data, type, row) => {
                                let uso = "";
                                switch (row.sistema_proteccion) {
                                    case 0:
                                        uso = "Restricción";
                                        break;
                                    case 1:
                                        uso = "Posicionamiento";
                                        break;
                                    case 2:
                                        uso = "Detención";
                                        break;

                                    default:
                                        break;
                                }
                                return uso;
                            },
                            targets: 8,
                        },
                        {
                            title: "Ubicación",
                            data: "ubicacion",
                            targets: 9,
                        },
                        {
                            title: "Observaciones",
                            data: "observaciones",
                            targets: 10,
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
