<?php

namespace App\Http\Controllers;

use App\Exports\PrecintosExport;
use App\Models\Empresa;
use App\Models\PuntoAnclaje;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
    public function index()
    {
       $puntosAnclaje =  PuntoAnclaje::orderByDesc('created_at')->with('empresa')->get();
        return response($puntosAnclaje);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::all();
        return view('registrarPuntoAnclaje',compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        PuntoAnclaje::create([
            'sistema_proteccion'=>$request->sistema_proteccion,
            'id_empresa'=>$request->id_empresa,
            'serial'=>date('m').''.date('y').''.$request->precinto,
            'precinto'=>$request->precinto,
            'fecha_instalacion'=>$request->fecha_instalacion,
            'fecha_inspeccion'=>$request->fecha_inspeccion,
            'fecha_proxima_inspeccion'=>Carbon::parse($request->fecha_instalacion)->addYear(),
            'marca'=>($request->marca != 'OTRO') ? $request->marca : $request->marca_otro,
            'numero_usuarios'=>$request->numero_usuarios,
            'uso'=>$request->uso,
            'observaciones'=>$request->observaciones  != null ? $request->observaciones : 'NO APLICA',
            'ubicacion'=>$request->ubicacion,
            'instalador'=>$request->instalador,
            'estado'=>$request->estado,
            'resistencia'=>$request->resistencia,
            'persona_calificada'=>$request->persona_calificada,
        ]);

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
        $puntoAnclaje = PuntoAnclaje::where('precinto',$puntoAnclajeRequest)->with('empresa')->first();

        if($puntoAnclajeRequest == null){
            $showAlert = false;
        }

        if ($puntoAnclaje == null) {
            $message = "El punto de anclaje <span style='font-weight: bold;'>".$puntoAnclajeRequest."</span> aún no se encuentra registrado, por favor inicie sesión para registrarlo o comuníquese con el administrador para su registro !";
        }

        return view('welcome',compact('puntoAnclaje','showAlert','message'));
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
        $puntoAnclaje = PuntoAnclaje::where('id',$id)->first();
        return view('editarPuntoAnclaje',compact('empresas','puntoAnclaje'));
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

        $puntoAnclaje = PuntoAnclaje::where('id',$id)->first();

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

    public function registerCompany()
    {
        return view('registrarEmpresa');
    }

    public function insertCompany(Request $request)
    {
        Empresa::create([
            'nombre'=>$request->empresa,
        ]);
        return redirect('/home');
    }

    public function export()
    {
        return Excel::download(new PrecintosExport, 'Precintos.xlsx');
    }
}
