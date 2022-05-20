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
                    rowReorder: {
                        selector: "td:nth-child(2)",
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
                                        sistemaProteccion = "Línea de vida";
                                        break;
                                    case 2:
                                        sistemaProteccion = "Línea de vida horizontal";
                                        break;
                                    case 3:
                                        sistemaProteccion = "Escalera";
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
                            title: "Persona calificada",
                            data: "instalador",
                            targets: 4,
                        },
                        {
                            title: "Fecha instalación",
                            data: "fecha_instalacion",
                            targets: 5,
                        },
                        {
                            title: "Fecha inspección",
                            data: "fecha_inspeccion",
                            targets: 6,
                        },
                        {
                            title: "Fecha próxima inspección",
                            data: "fecha_proxima_inspeccion",
                            targets: 7,
                        },
                        {
                            title: "Marca",
                            data: "marca",
                            targets: 8,
                        },
                        {
                            title: "Número de usuarios",
                            data: "numero_usuarios",
                            targets: 9,
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
                            targets: 10,
                        },
                        {
                            title: "Resistencia",
                            data: "resistencia",
                            targets: 11,
                        },
                        {
                            title: "Estado",
                            data: null,
                            render: (data, type, row) => {
                                let uso = "";
                                if(row.sistema_proteccion == 0){
                                    return `<button type="button" class="btn btn-danger btn-sm">No Aprobado</button>`
                                }
                                else{
                                    return `<button type="button" class="btn btn-success btn-sm">Aprobado</button>`
                                }
                            },
                            targets: 12,
                        },
                        {
                            title: "Ubicación",
                            data: "ubicacion",
                            targets: 13,
                        },
                        {
                            title: "Observaciones",
                            data: "observaciones",
                            targets: 14,
                        },
                        {
                            title: "Editar",
                            data: null,
                            render: (data, type, row) => {
                                return  `<a href="editarPuntoAnclaje/${row.id}" class="btn btn-success">editar</a>`
                            },
                            targets: 15,
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
