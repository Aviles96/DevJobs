<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;

class FiltrarVacantes extends Component
{
    //Informacion que se va filtrar en la busqueda
    public $termino;
    public $categoria;
    public $salario;

    //Funcion para cuando demos buscar nos lleve a la informacion de DB
    public function leerDatosFormulario()
    {
        //Para comunicarnos al componente padre le pasamos los terminos de busqueda
        $this->emit('terminosBusqueda', $this->termino, $this->categoria, $this->salario);

    }

    public function render()
    {
        //Traer la siguiente informacion para realizar el buscador
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.filtrar-vacantes', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
