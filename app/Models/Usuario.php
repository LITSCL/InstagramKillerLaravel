<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;
    
    //1. Indicando la tabla que representa este modelo.
    protected $table = "usuario"; //Las variables tienen que estar en inglés.
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $fillable = ["id", "rol", "nombre", "apellido", "alias", "correo", "clave", "imagen", "remember_token", "created_at", "updated_at"];
    
    public function getAuthPassword()
    {
        return $this->clave; //Indicando la columna que representa la contraseña al momento de logearse.
    }
   
    //2. Creando las relaciones "One To Many" (Uno a muchos), esto permite que el ORM reconozca las relaciones entre las tablas de la base de datos.
    public function getAllImagen()
    {
        return $this->hasMany(Imagen::class); //Este método permite obtener registros de la clave foránea (Todas las imagenes de este usuario).
    }
}
