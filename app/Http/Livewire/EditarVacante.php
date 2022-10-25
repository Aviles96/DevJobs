<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{   
    //Hay que instanciar los atributos que son parte del formulario
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    //nuevo atributo para modificar la imagen
    public $imagen_nueva;

    use WithFileUploads;
    
    //Reglas de validacion que deben cumplir al llenar el formulario
    protected $rules =  [
    'titulo' => 'required|string',
    'salario' => 'required',
    'categoria' => 'required',
    'empresa' => 'required',
    'ultimo_dia' => 'required',
    'descripcion' => 'required',
    'imagen_nueva' => 'nullable|image|max:1024' //El nullable deja pasar si no agregan una imagen pero si hay una
    //tiene que cumplir con la validacion
    ];

    //Cargar los datos de vacante antes de editar se usa mount hay que indicar el modelo con la variable en los ()
    public function mount(Vacante $vacante)
    {   
        $this->vacante_id = $vacante->id; //ESTO NO VA FUNCIONAR hay que crear un link momentanio con php artisan storage:link
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        //Hay que editar la fecha con carbon para que cargue en editar
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }

    public function editarVacante()
    {
        //Mandar a llamar la validacion
        $datos = $this->validate();

        //Revisar si hay una nueva imagen
        if($this->imagen_nueva) {
            $imagen = $this->imagen_nueva->store('public/vacantes');
            $datos['imagen'] = str_replace('public/vacantes', '', $imagen);
        }

        //Encontrar la vacante a editar
        $vacante = Vacante::find($this->vacante_id);

        //Asignar los valores
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        //Reescribimos la imagen si no hay un nuevo valor asignale la imagen anterior
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

        //Guardar la vacante
        $vacante->save();

        //Redireccionar
        session()->flash('mensaje', 'La Vacante se actualizo Correctamente');

        return redirect()->route('vacantes.index');
    }
    
    public function render()
    {
        //Consultar la base de datos
        $salarios = Salario::all();
        $categorias = Categoria::all();
                
        return view('livewire.editar-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
