<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Verifica la viewAny y vacante::class para que tenga acceso a toda la informacion de vacante
        $this->authorize('viewAny', Vacante::class);
        //vistas de vacantes
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Vacante::class);
        return view('vacantes.create');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //La vista para ver la oferta laboral
    public function show(Vacante $vacante)
    {
        return view('vacantes.show', [
            'vacante'=> $vacante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {   
        //Si el usuario es el mismo al que creo la vacante tiene la autorizacion de acceso
        $this->authorize('update', $vacante);
        //Llama la vista de vacantes edit y el arreglo tambien llamando la informacion del arreglo consultando la BD
        return view('vacantes.edit', [
            'vacante' => $vacante
        ]);
    }
}
