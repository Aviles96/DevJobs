<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidatos Vacante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h1 class="text-4xl font-bold text-center my-10">
                        Candidatos Vacante: {{$vacante->titulo}}
                    </h1>
                    
                    <div class="md:flex md:justify-center p-5">
                        {{-- Mostrar los candidatos de las vacantes forma dinamica --}}
                        <ul class="divide-y divide-gray-200 p-5 w-full">
                            @forelse ($vacante->candidatos as $candidatos )
                                <li class="p-3 flex items-center">
                                    <div class="flex-1">
                                       <p class="text-xl font-medium text-gray-800">
                                            {{$candidatos->user->name}}
                                       </p>
                                       <p class="text-sm text-gray-800">
                                        {{$candidatos->user->email}}
                                       </p>
                                       <p class="text-sm font-medium text-gray-800">
                                        Dia que se postulo:
                                        <span class="font-normal">
                                            {{$candidatos->created_at->diffForhumans()}}
                                        </span>
                                       </p>
                                    </div>

                                    <div>
                                        {{-- Se usa asset por que es un archivo pdf --}}
                                        <a href="{{asset('storage/cv/' . $candidatos->cv)}}"
                                            class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300
                                            text-sm leading-5 font-medium rounded-full text-gray-700 bg-white
                                            hover:bg-gray-50"
                                            {{-- para seguridad --}}
                                            target="_blank"
                                            rel="noreferrer noopener"> 
                                            
                                            Ver CV
                                        </a>
                                    </div>
                                </li>
                            @empty
                                <p class="p-3 text-center text-sm text-gray-600">
                                    No hay candidatos aun
                                </p>
                            @endforelse
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>