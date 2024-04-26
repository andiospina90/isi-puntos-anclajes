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
 
});
