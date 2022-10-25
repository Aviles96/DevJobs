<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;
    //Son los archivos que se van almacenar fillable significa rellenar
    protected $fillable = [
        'user_id',
        'vacante_id',
        'cv'
    ];
    //Permite relacionar el modelo de usuario en la vista de candidatos.index 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
