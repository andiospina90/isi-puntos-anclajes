<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\PuntoAnclaje;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
       $puntosAnclaje =  PuntoAnclaje::orderBy('fecha_instalacion','desc')->with('empresa')->get();
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
        $existe = true;
        while ($existe) {
            $serial = 'Isis-'.rand(0, 9999999);
            $serialExiste = PuntoAnclaje::where('serial',$serial)->first();
            $existe = false;
        }
        return view('registrarPuntoAnclaje',compact('empresas','serial'));
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
            'serial'=>$request->serial,
            'precinto'=>$request->precinto,
            'fecha_instalacion'=>$request->fecha_instalacion,
            'fecha_inspeccion'=>Carbon::parse($request->fecha_instalacion)->addYear(),
            'marca'=>$request->marca,
            'numero_usuarios'=>$request->numero_usuarios,
            'uso'=>$request->uso,
            'observaciones'=>$request->observaciones,
            'ubicacion'=>$request->ubicacion,
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
        $puntoAnclaje = PuntoAnclaje::where('precinto',$puntoAnclajeRequest)->first();

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
    public function destroy($id)
    {
        //
    }
}
