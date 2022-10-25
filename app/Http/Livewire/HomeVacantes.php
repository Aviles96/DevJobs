<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    //Informacion que se va filtrar en la busqueda
    public $termino;
    public $categoria;
    public $salario;

    //Hacemos el llamado para generar la busqueda cuando el evento terminosBusquedas ocurra manda llamar buscar
    protected $listeners = ['terminosBusqueda' => 'buscar'];

    //Funcion para crear la busqueda se le indica que va tomar para la misma
    public function buscar($termino, $categoria, $salario)
    {
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;
    }

    public function render()
    {
        //Como obtener la vista de las vacantes de acuerdo a sus terminos de busqueda
        //El when se va ejucutar si los valores de busqueda tienen algo
        //Con el porcentaje le estamos diciendo que no importa donde se encuentra el termino de busqueda va filtrar por el

         $vacantes = Vacante::when($this->termino, function($query) {
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%");
         })
         
         ->when($this->termino, function($query) {
            $query->orWhere('empresa', 'LIKE', "%" . $this->termino . "%");
        })

         ->when($this->categoria, function($query) {
            $query->where('categoria_id', $this->categoria);
         })

         ->when($this->salario, function($query) {
            $query->where('salario_id', $this->salario);
         })

         ->paginate(20); //El paginate es para que se traiga los registros

        //Consultar la base de datos por la vacantes
        // $vacantes = Vacante::all();

        return view('livewire.home-vacantes', [
            'vacantes' => $vacantes,
        ]);
    }
}
