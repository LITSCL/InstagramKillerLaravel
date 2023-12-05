<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    
    //1. Indicando la tabla que representa este modelo.
    protected $table = "imagen"; //Las variables tienen que estar en inglés.
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $fillable = ["id", "descripcion", "usuario_id", "created_at", "updated_at"];
    
    //2. Creando las relaciones "One To Many" (Uno a muchos), esto permite que el ORM reconozca las relaciones entre las tablas de la base de datos.
    public function getAllComentario() 
    { 
        return $this->hasMany(Comentario::class)->orderBy("id", "desc"); //Este método permite obtener registros de la clave foránea (Todos los comentarios de esta imagen).
    }
    
    public function getAllLike() 
    {
        return $this->hasMany(Like::class); //Este método permite obtener registros de la clave foránea (Todos los likes de esta imagen).
    }
    
    //3. Creando las relaciones "Many To One" (Muchos a uno), esto permite que el ORM reconozca las relaciones entre las tablas de la base de datos.
    public function getUsuario()
    {
        return $this->belongsTo(Usuario::class, "usuario_id"); //Este método permite traer un registro único de la clave foránea (El usuario que subió la imagen), recibe 2 parámetros, el primero es el modelo que representa la clave foránea y el segundo el nombre de la clave foránea.
    }
}
