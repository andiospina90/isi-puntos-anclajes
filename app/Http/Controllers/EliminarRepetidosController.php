<?php

namespace App\Http\Controllers;

use App\Exports\NotDeletedRecordsExport;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EliminarRepetidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deletedRecordsPath = 'deleted_records.json';
        $notDeletedRecordsPath = 'not_deleted_records.json';

        // Leer los archivos JSON
        $deletedRecords = json_decode(Storage::get($deletedRecordsPath), true);
        $notDeletedRecords = json_decode(Storage::get($notDeletedRecordsPath), true);

        // Paginación para registros eliminados
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // Número de registros por página
        $currentPageRecords = array_slice($deletedRecords, ($currentPage - 1) * $perPage, $perPage);
        $deletedRecordsPaginator = new LengthAwarePaginator(
            $currentPageRecords,
            count($deletedRecords),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // Paginación para registros no eliminados
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // Número de registros por página
        $currentPageRecords = array_slice($notDeletedRecords, ($currentPage - 1) * $perPage, $perPage);
        $notDeletedRecordsPaginator = new LengthAwarePaginator(
            $currentPageRecords,
            count($notDeletedRecords),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );


        // Pasar los datos a la vista
        return view('registrosAEliminar', [
            'deletedRecords' => $deletedRecordsPaginator,
            'notDeletedRecords' => $notDeletedRecordsPaginator,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $duplicatedPrecintos = DB::table('isi_punto_anclaje_instalacion')
            ->select('precinto', DB::raw('COUNT(*) as total'))
            ->groupBy('precinto')
            ->having('total', '>', 1)
            ->pluck('precinto');

        // Listas para almacenar los registros eliminados y no eliminados
        $deletedRecords = [];
        $notDeletedRecords = [];

        // Campos a comparar
        $fieldsToCompare = [
            'sistema_proteccion',
            'id_empresa',
            'serial',
            'precinto',
            'fecha_instalacion',
            'fecha_inspeccion',
            'marca',
            'numero_usuarios',
            'uso',
            'observaciones',
            'ubicacion',
            'fecha_proxima_inspeccion',
            'instalador',
            'resistencia',
            'estado',
            'persona_calificada',
            'propuesta_instalacion'
        ];

        // Paso 2: Procesar los registros duplicados
        DB::transaction(function () use ($duplicatedPrecintos, $fieldsToCompare, &$deletedRecords, &$notDeletedRecords) {
            foreach ($duplicatedPrecintos as $precinto) {
                // Obtener todos los registros con el mismo `precinto`
                $records = DB::table('isi_punto_anclaje_instalacion')
                    ->leftJoin('isi_empresas', 'isi_punto_anclaje_instalacion.id_empresa', '=', 'isi_empresas.id')
                    ->where('isi_punto_anclaje_instalacion.precinto', $precinto)
                    ->orderBy('isi_punto_anclaje_instalacion.id')
                    ->select(
                        'isi_punto_anclaje_instalacion.*',
                        DB::raw('IFNULL(isi_empresas.nombre, "sin_empresa") as nombre_empresa')
                    )
                    ->get();
        
                if ($records->count() > 1) {
                    // Tomar el primer registro como referencia
                    $firstRecord = $records->first();
                    $canDelete = true;
        
                    foreach ($records as $record) {
                        $differences = [];
        
                        // Comparar cada campo del registro con el registro de referencia
                        foreach ($fieldsToCompare as $field) {
                            if ($record->$field !== $firstRecord->$field) {
                                $differences[$field] = [
                                    'primer_registro' => $firstRecord->$field,
                                    'segundo_registro' => $record->$field,
                                ];
                                $canDelete = false;
                            }
                        }
        
                        // Si hay diferencias, añadir a la lista de no eliminados con las diferencias
                        if (!empty($differences)) {
                            $notDeletedRecords[] = [
                                'id' => $record->id,
                                'precinto' => $record->precinto,
                                'diferencias' => $differences,
                                'primer_registro_id' => $firstRecord->id . ' - ' . $firstRecord->nombre_empresa,  // ID y nombre de la empresa del primer registro
                                'segundo_registro_id' => $record->id . ' - ' . $record->nombre_empresa  // ID y nombre de la empresa del registro actual
                            ];
                        }
                    }
        
                    // Si no hay diferencias, eliminar el primer registro
                    if ($canDelete) {
                        DB::table('isi_punto_anclaje_instalacion')
                            ->where('id', $firstRecord->id)
                            ->delete();
        
                        $deletedRecords[] = [
                            'id' => $firstRecord->id,
                            'precinto' => $firstRecord->precinto,
                        ];
                    }
                }
            }
        });

        // Paso 3: Guardar las listas en archivos JSON
        $deletedRecordsPath = 'deleted_records.json';
        $notDeletedRecordsPath = 'not_deleted_records.json';

        Storage::put($deletedRecordsPath, json_encode($deletedRecords, JSON_PRETTY_PRINT));
        Storage::put($notDeletedRecordsPath, json_encode($notDeletedRecords, JSON_PRETTY_PRINT));

        // Paso 4: Devolver la respuesta JSON con las rutas de los archivos
        return response()->json([
            'message' => 'Proceso completado',
            'deleted_records_file' => $deletedRecordsPath,
            'not_deleted_records_file' => $notDeletedRecordsPath,
        ]);
    }

    public function exportToExcel(Request $request)
    {
        // Leer el JSON con los registros no eliminados
        $notDeletedRecords = json_decode(file_get_contents(storage_path('app/not_deleted_records.json')), true);

        // Generar el archivo Excel
        return Excel::download(new NotDeletedRecordsExport($notDeletedRecords), 'not_deleted_records.xlsx');
    }
}
