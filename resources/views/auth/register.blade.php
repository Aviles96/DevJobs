<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

                        <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Que tipo de cuenta deseas en DevJobs?')" />

                <select
                    id="rol"
                    name="rol"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300
                    focus:ring focus:ring-indigo-200 focus:ring-opacity-5 w-full"
                >
                    <option value="">--Selecciona un rol--</option>
                    <option value="1">Developer - Obtener un Empleo</option>
                    <option value="2">Recruiter - Publicar Empleos</option>
                
                </select>


            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Repetir Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                    <div class="flex justify-between my-5">
                        <x-link 
                            :href="route('login')">
                            Iniciar Sesion
                        </x-link>
        
                        <x-link
                            :href="route('password.request')">
                            Olvidaste tu Password
                        </x-link>
        
                    </div>
            
                    <x-primary-button class="w-full justify-center">
                        {{ __('Crear Cuenta') }}
                    </x-primary-button>
        </form>
    </x-auth-card>
</x-guest-layout>
