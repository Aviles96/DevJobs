<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads; //Habilita la carga de archivos

    //Se conecta la vista con el controller le indica los atributos
    //necesaios y la reglas que debe cumplir y en la parte de la vista
    //con livewire muestra la alerta si no cumple con lo requerido
    public $cv;
    public $vacante;

    protected $rules =[
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        //Almacenar el curriculum
        $datos = $this->validate();
        //Almacenar la cv se le indica la ruta
        $cv =  $this->cv->store('public/cv');
        //El str_replace es para remplazar la ubicacion de la imagen
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        //Crear el candidato a la vacante toma la funcion de candidatos crea el usuario y el cv
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
        ]);
        

        //Crear la notificacion y enviar al email
        //En NuevoCandidato entre() especificar la informacion q queremos enviar creada en el contructor de nuevoCandidato
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo,
        auth()->user()->id ));


        //Mostrar al usuario un msj de que se envio correctamente
        session()->flash('mensaje', 'Se envio correctamente tu informacion, mucha suerte');

        return redirect()->back();

    }
    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
