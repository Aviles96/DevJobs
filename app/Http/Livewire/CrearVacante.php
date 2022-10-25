<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpParser\Node\Expr\FuncCall;

class CrearVacante extends Component
{
    //Definir la propiedades
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    //Da permiso para subir imagenes en livewire
    use WithFileUploads;

    //Reglas de validacion que deben cumplir al llenar el formulario
    protected $rules =  [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024'
    ];

    //Function para enviar la informacion del formulario
    public function crearVacante()
    {
        $datos = $this->validate();
        //Almacenar la imagen
        $imagen =  $this->imagen->store('public/vacantes');
        //El str_replace es para remplazar la ubicacion de la imagen
        $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);

        // dd($nombre_imagen);

        //Crear la vacante
        //Estos son los datos que se estan enviando a la base de datos
        //El protected se encuentra en el model de vacante.php parte importante
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => auth()->user()->id,
        ]);

        //Crear un mensaje
        session()->flash('mensaje', 'La Vacante se publico correctamente');

        //Redireccionar al usuario
        return  redirect()->route('vacantes.index');
    }

    public function render()
    {
        //Consultar la base de datos
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
