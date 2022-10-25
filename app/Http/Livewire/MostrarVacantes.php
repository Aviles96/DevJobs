<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    //Se tiene que hacer el llamado del evento que esta ocurriendo
    protected $listeners = ['eliminarVacante'];
    //Funcion para eliminar vacante
    public function eliminarVacante(Vacante $vacante)
    {
        $vacante->delete();
    }

    public function render()
    {
        //Variable para mostrar las vacantes identificando al usuario las creadas por el mismo teniendo paginacion
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10);

        //Ahora le dicimos que pase esa variable a la vista 
        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
