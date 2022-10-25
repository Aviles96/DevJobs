<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacante;
use Illuminate\Auth\Access\HandlesAuthorization;

class VacantePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     * viewAny determina que usuario puede ver un modelo
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //Si el usuario tiene el rol numero 2 puede ver la vista de reclutador
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Vacante $vacante)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     * Determina si un usuario puede crear modelos
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {      
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Vacante $vacante)
    {
        //Ejucutar los policys para que otro usuario no pueda modificar la informacion de vacantes
        //El usuario que esta autenticado es el mismo que esta viendo el formulario de editar
        //le vamos a permitir el acceso
        return $user->id === $vacante->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Vacante $vacante)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vacante $vacante)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vacante $vacante)
    {
        //
    }
}
