<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    //Le cambiamos la cateristica de string a date al atributo de ultimo dia
    protected $dates = ['ultimo_dia'];
    use HasFactory;
    //Espacios que se van a llenar en la base de datos
    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //Salario y categoria pertenecen a otro modelo para mostrar el label en el enlace de la oferta
    // y llegue directamente a su columna
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }
    //Relacion donde una vacante tiene muchos candidatos eso significa hasMany
    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }

    //Relacion belongsto es de uno a uno donde una vacante pertenece a un usuario
    //Esta funcion va hacia el reclutador el cual creo la vacante
    public function reclutador()
    {
        return $this->belongsto(User::class, 'user_id');
    }
}
