<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    
    //1. Indicando la tabla que representa este modelo.
    protected $table = "comentario"; //Las variables tienen que estar en inglés.
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $fillable = ["id", "usuario_id", "imagen_id", "created_at", "updated_at"];
    
    //2. Creando las relaciones "Many To One" (Muchos a uno), esto permite que el ORM reconozca las relaciones entre las tablas de la base de datos.
    public function getUsuario()
    {
        return $this->belongsTo(Usuario::class, "usuario_id"); //Este método permite traer un registro �nico de la clave foránea (El usuario que escribió el comentario), recibe 2 par�metros, el primero es el modelo que representa la clave foránea y el segundo el nombre de la clave foránea.
    }
    
    public function getImagen()
    {
        return $this->belongsTo(Imagen::class, "imagen_id"); //Este método permite traer un registro �nico de la clave for�nea (La imagen que fue comentada), recibe 2 parámetros, el primero es el modelo que representa la clave foránea y el segundo el nombre de la clave foránea.
    }
}
