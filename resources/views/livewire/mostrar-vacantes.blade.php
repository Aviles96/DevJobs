<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    {{-- Con el foreach intera o hace el llamado de la variable de vacantes para que se muestre su informacion--}}
        @forelse ( $vacantes as $vacante )
        <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
            <div class="space-y-3">
                <a href="{{route('vacantes.show', $vacante->id)}}" class="text-xl font-bold">
                {{-- Solo se muestra el titulo de la vacante o lo que queramos llamar haciendolo  --}}
                    {{$vacante->titulo}}
                </a>
                <p class="text-sm text-gray-600 font-bold">{{$vacante->empresa}}</p>
                <p class="text-sm text-gray-500">Ultimo dia: {{$vacante->ultimo_dia->format('d/m/Y')}}</p>
            </div>

            <div class="flex flex-col md:flex-row items-stech gap-3 mt-5 md:mt-0">

                <a  class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    href="{{route('candidatos.index', $vacante)}}"
                    >
                    {{-- Para que muestre la cantidad en el button  --}}
                    {{$vacante->candidatos->count()}}
                    Candidatos</a>

                <a  class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    href="{{route('vacantes.edit', $vacante->id )}}"
                    >Editar</a>

                <button  class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    {{-- emite un evento donde muestra la alerta y donde variable de vacante con ese id va eliminar --}}
                    wire:click="$emit('mostrarAlerta', {{$vacante->id}})"
                    >Eliminar</button>
            </div>
        </div>

            @empty
                <p class="p-3 text-center text-sm text-gray-600">No hay vacantes que mostrar</p>
            @endforelse
    </div>

    <div class="mt-10">
        {{$vacantes->links()}}
    </div>
</div>

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Hacer llamado del evento en livewire
        Livewire.on('mostrarAlerta', vacanteId => {
        // Se usa scripts porque estamos usando codigo de javascripts
        // El siguiente código es el Alert utilizado
        Swal.fire({
            title: 'Eliminar Vacante?',
            text: "Una vacante eliminada no se puede recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                    //Eliminar la vacante mandar el evento con livewire
                    Livewire.emit('eliminarVacante', vacanteId)
                Swal.fire(
                'Se elimino la Vacante!',
                'Eliminado correctamente',
                'success'
                )
            }
        })
    })
    </script>
@endpush