<?php

namespace App\Http\Controllers;

use App\Models\ProtectionSystem;
use App\Models\PuntoAnclaje;
use App\Models\Recertification;
use App\Models\SystemUse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($propouse)
    {

        $usos  = SystemUse::all();
        $sistemaProteccion = ProtectionSystem::all();

        return view('recertification.create', compact('propouse', 'usos', 'sistemaProteccion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $precientoInicial = ltrim($request->precinto_inicial, '0');
        $precientoFinal = ltrim($request->precinto_final, '0');

        $propuestaPrincipal = PuntoAnclaje::where('propuesta_instalacion', $request->id_propuesta)->first();

        for ($i = $precientoInicial; $i <= $precientoFinal; $i++) {

            Recertification::create([
                'sistema_proteccion' => $request->sistema_proteccion,
                'serial' => date('m') . '' . date('y') . '' . $request->precinto,
                'precinto' => sprintf("%06d", $i),
                'fecha_recertificacion' => $request->fecha_recertificacion,
                'marca' => ($request->marca != 'OTRO') ? $request->marca : $request->marca_otro,
                'numero_usuarios' => $request->numero_usuarios,
                'uso' => $request->uso,
                'observaciones' => $request->observaciones  != null ? $request->observaciones : 'NO APLICA',
                'ubicacion' => $request->ubicacion,
                'estado' => $request->estado,
                'propuesta_recertificacion' => $request->propuesta_recertificacion,
                'propuesta_principal' => $request->id_propuesta,
                'id_empresa' => $propuestaPrincipal->id_empresa
            ]);
        }

        return redirect('/lista/recertificacion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('recertification.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    public function destroy($id)
    {
        //
    }

    public function getRecertifications(Request $request)
    {

        try {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $rowperpage = $request->get("length");

            $columnIndex_arr = $request->get('order', []);
            $columnName_arr = $request->get('columns');
            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column'];
            $columnName = $columnName_arr[$columnIndex]['data'];
            $columnSortOrder = $order_arr[0]['dir'];
            $searchValue = $search_arr['value'];



            $totalRecords = Recertification::count();
            $totalRecordswithFilter = Recertification::where(function ($query) use ($searchValue) {
                $query->where('sistema_proteccion', 'like', '%' . $searchValue . '%')
                    ->orWhere('propuesta_principal', 'like', '%' . $searchValue . '%')
                    ->orWhere('propuesta_recertificacion', 'like', '%' . $searchValue . '%')
                    ->orWhere('precinto', 'like', '%' . $searchValue . '%')
                    ->orWhere('serial', 'like', '%' . $searchValue . '%')
                    ->orWhere('fecha_recertificacion', 'like', '%' . $searchValue . '%')
                    ->orWhere('marca', 'like', '%' . $searchValue . '%')
                    ->orWhere('numero_usuarios', 'like', '%' . $searchValue . '%')
                    ->orWhere('uso', 'like', '%' . $searchValue . '%')
                    ->orWhere('estado', 'like', '%' . $searchValue . '%')
                    ->orWhere('ubicacion', 'like', '%' . $searchValue . '%')
                    ->orWhere('observaciones', 'like', '%' . $searchValue . '%')
                    ->orWhere('id', 'like', '%' . $searchValue . '%');
            })
                ->orWhereHas('empresa', function ($query) use ($searchValue) {
                    $query->where('nombre', 'like', '%' . $searchValue . '%');
                })->count();


            $puntosAnclaje = Recertification::where(function ($query) use ($searchValue) {
                $query->where('sistema_proteccion', 'like', '%' . $searchValue . '%')
                    ->orWhere('propuesta_principal', 'like', '%' . $searchValue . '%')
                    ->orWhere('propuesta_recertificacion', 'like', '%' . $searchValue . '%')
                    ->orWhere('precinto', 'like', '%' . $searchValue . '%')
                    ->orWhere('serial', 'like', '%' . $searchValue . '%')
                    ->orWhere('fecha_recertificacion', 'like', '%' . $searchValue . '%')
                    ->orWhere('marca', 'like', '%' . $searchValue . '%')
                    ->orWhere('numero_usuarios', 'like', '%' . $searchValue . '%')
                    ->orWhere('uso', 'like', '%' . $searchValue . '%')
                    ->orWhere('estado', 'like', '%' . $searchValue . '%')
                    ->orWhere('ubicacion', 'like', '%' . $searchValue . '%')
                    ->orWhere('observaciones', 'like', '%' . $searchValue . '%')
                    ->orWhere('id', 'like', '%' . $searchValue . '%');
            })
                ->orWhereHas('empresa', function ($query) use ($searchValue) {
                    $query->where('nombre', 'like', '%' . $searchValue . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->with('empresa')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            $data_arr = array();

            foreach ($puntosAnclaje as $puntoAnclaje) {
                $data_arr[] = array(
                    "sistema_proteccion" => $puntoAnclaje->sistema_proteccion,
                    "propuesta_principal" => $puntoAnclaje->propuesta_principal,
                    "propuesta_recertificacion" => $puntoAnclaje->propuesta_recertificacion,
                    "precinto" => $puntoAnclaje->precinto,
                    "serial" => $puntoAnclaje->serial,
                    "empresa" => $puntoAnclaje->empresa->nombre,
                    "fecha_recertificacion" => $puntoAnclaje->fecha_recertificacion,
                    "marca" => $puntoAnclaje->marca,
                    "numero_usuarios" => $puntoAnclaje->numero_usuarios,
                    "uso" => $puntoAnclaje->uso,
                    "estado" => $puntoAnclaje->estado,
                    "ubicacion" => $puntoAnclaje->ubicacion,
                    "observaciones" => $puntoAnclaje->observaciones,
                    "id" => $puntoAnclaje->id,

                );
            }

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );

            return response($response);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
