<?php

namespace App\Http\Controllers;

use App\Exports\PrecintosExport;
use App\Models\Empresa;
use App\Models\PuntoAnclaje;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PuntosAnclajeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->get('start');
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
       
        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $searchValue = $search_arr['value'];

        $totalRecords = PuntoAnclaje::count();
        $totalRecordswithFilter = PuntoAnclaje::where('precinto', 'like', '%' . $searchValue . '%')->count();

        
        $puntosAnclaje = PuntoAnclaje::where('precinto', 'like', '%' . $searchValue . '%')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();
        
        $data_arr = array();

        foreach ($puntosAnclaje as $puntoAnclaje) {
            $data_arr[] = array(
                "id" => $puntoAnclaje->id,
                "precinto" => $puntoAnclaje->precinto,
                "serial" => $puntoAnclaje->serial,
                "marca" => $puntoAnclaje->marca,
                "fecha_instalacion" => $puntoAnclaje->fecha_instalacion,
                "fecha_inspeccion" => $puntoAnclaje->fecha_inspeccion,
                "fecha_proxima_inspeccion" => $puntoAnclaje->fecha_proxima_inspeccion,
                "numero_usuarios" => $puntoAnclaje->numero_usuarios,
                "uso" => $puntoAnclaje->uso,
                "observaciones" => $puntoAnclaje->observaciones,
                "ubicacion" => $puntoAnclaje->ubicacion,
                "instalador" => $puntoAnclaje->instalador,
                "estado" => $puntoAnclaje->estado,
                "resistencia" => $puntoAnclaje->resistencia,
                "persona_calificada" => $puntoAnclaje->persona_calificada,
                "empresa" => $puntoAnclaje->empresa->nombre,
                "sistema_proteccion" => $puntoAnclaje->sistema_proteccion,
                "created_at" => $puntoAnclaje->created_at,
                "updated_at" => $puntoAnclaje->updated_at,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response($response);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::all();
        return view('registrarPuntoAnclaje', compact('empresas'));
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

        for ($i = $precientoInicial; $i <= $precientoFinal; $i++) {

            PuntoAnclaje::create([
                'sistema_proteccion' => $request->sistema_proteccion,
                'id_empresa' => $request->id_empresa,
                'serial' => date('m') . '' . date('y') . '' . $request->precinto,
                'precinto' => sprintf("%06d", $i),
                'fecha_instalacion' => $request->fecha_instalacion,
                'fecha_inspeccion' => $request->fecha_inspeccion,
                'fecha_proxima_inspeccion' => Carbon::parse($request->fecha_inspeccion)->addYear(),
                'marca' => ($request->marca != 'OTRO') ? $request->marca : $request->marca_otro,
                'numero_usuarios' => $request->numero_usuarios,
                'uso' => $request->uso,
                'observaciones' => $request->observaciones  != null ? $request->observaciones : 'NO APLICA',
                'ubicacion' => $request->ubicacion,
                'instalador' => $request->instalador,
                'estado' => $request->estado,
                'resistencia' => $request->resistencia,
                'persona_calificada' => $request->persona_calificada,
            ]);
        }

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByReference(Request $request)
    {
        $message = "";
        $puntoAnclajeRequest = $request->puntoAnclaje;
        $showAlert = true;
        $puntoAnclaje = PuntoAnclaje::where('precinto', $puntoAnclajeRequest)->with('empresa')->first();

        if ($puntoAnclajeRequest == null) {
            $showAlert = false;
        }

        if ($puntoAnclaje == null) {
            $message = "El punto de anclaje <span style='font-weight: bold;'>" . $puntoAnclajeRequest . "</span> aún no se encuentra registrado, por favor inicie sesión para registrarlo o comuníquese con el administrador para su registro !";
        }

        return view('welcome', compact('puntoAnclaje', 'showAlert', 'message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresas = Empresa::all();
        $puntoAnclaje = PuntoAnclaje::where('id', $id)->first();
        return view('editarPuntoAnclaje', compact('empresas', 'puntoAnclaje'));
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

        $puntoAnclaje = PuntoAnclaje::where('id', $id)->first();

        $puntoAnclaje->sistema_proteccion = $request->sistema_proteccion;
        $puntoAnclaje->id_empresa = $request->id_empresa;
        $puntoAnclaje->precinto = $request->precinto;
        $puntoAnclaje->fecha_instalacion = $request->fecha_instalacion;
        $puntoAnclaje->fecha_inspeccion = $request->fecha_inspeccion;
        $puntoAnclaje->marca = ($request->marca != 'OTRO') ? $request->marca : $request->marca_otro;
        $puntoAnclaje->numero_usuarios = $request->numero_usuarios;
        $puntoAnclaje->uso = $request->uso;
        $puntoAnclaje->observaciones = $request->observaciones != null ? $request->observaciones : 'NO APLICA';
        $puntoAnclaje->ubicacion = $request->ubicacion;
        $puntoAnclaje->instalador = $request->instalador;
        $puntoAnclaje->estado = $request->estado;
        $puntoAnclaje->resistencia = $request->resistencia;
        $puntoAnclaje->persona_calificada = $request->persona_calificada;
        $puntoAnclaje->save();

        return redirect('/home');
    }

    public function delete()
    {
        return view('eliminarPuntoAnclaje');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'precinto_inicial' => 'required',
            'precinto_final' => '',
        ]);

        $precintoInicial = (int) $request->input('precinto_inicial');
        $precintoFinal = $request->input('precinto_final') ? (int) $request->input('precinto_final') : $precintoInicial;
       
        if ($precintoInicial > $precintoFinal) {
            $validator->errors()->add('precinto_final', 'El número de precinto inicial no puede ser mayor que el número de precinto final.');
        }
       
        if ($validator->errors()->isNotEmpty()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
      
        $i = $precintoInicial;

        do {
            $precintoFormatted = str_pad($i, 6, '0', STR_PAD_LEFT);
            PuntoAnclaje::where('precinto', $precintoFormatted)->delete();
            $i++;
            
        } while ($i <= $precintoFinal);
    
        session()->flash('success', 'Registro eliminados correctamente.');
        return redirect()->back();

    }

    public function registerCompany()
    {
        return view('registrarEmpresa');
    }

    public function insertCompany(Request $request)
    {
        Empresa::create([
            'nombre' => $request->empresa,
        ]);
        return redirect('/home');
    }

    public function export()
    {
        return Excel::download(new PrecintosExport, 'Precintos.xlsx');
    }
}
