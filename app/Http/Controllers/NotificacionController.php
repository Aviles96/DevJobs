<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //En el momento de hacer el controlador se pone --invokable para que solo me este metodo
    public function __invoke(Request $request)
    {
        //Vista de las notificaciones
        $notificaciones = auth()->user()->unreadNotifications; //Envia las notificaciones no vistas

        //Limpiar las notificaciones nuevas a la hora de recargar
        auth()->user()->unreadNotifications->markAsRead(); //markAsRead sirve para indicar notificaciones no leeidas

        return view('notificaciones.index', [
            'notificaciones' => $notificaciones
        ]);

    }
}
