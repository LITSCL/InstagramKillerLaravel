<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;

class ComentarioController extends Controller
{	
    public function __construct()
    {
        $this->middleware("auth"); //Este middleware, verifica que exista una sesión activa, de lo contrario se redirije al HOME.
    }
    
    //Métodos Acción (Procesan datos desde formularios).
    public function save(Request $request)
    {
        $validacion = $this->validate($request, [
            "imagenId" => ["required", "int"],
            "contenido" => ["required", "String"],
        ]);
        
        $usuario = Auth::user();
        $imagenId = $request->input("imagenId");
        $contenido = $request->input("contenido");
        
        $comentario = new Comentario();
        $comentario->contenido = $contenido;
        $comentario->usuario_id = $usuario->id;
        $comentario->imagen_id = $imagenId;
        
        $comentario->save();
        
        return redirect()->route("imagen.vista.detalle", ["id" => $imagenId])->with("mensaje", "Comentario publicado correctamente"); //NOTA: El id es un parámetro enviado por GET, el mensaje es una variable enviada que solo puede ser procesada por blade.
    }
    
    public function delete($id) 
    {
        //Obtener el usuario identificado.
        $usuario = Auth::user();
        
        //Obtener el comentario.
        $comentario = Comentario::find($id);
        
        //Verificar si hay alguien logeado, si el comentario pertenece al logeado o si el logeado fue quien realizó la publicación.
        if ($usuario && $comentario->usuario_id == $usuario->id || $comentario->getImagen->usuario_id == $usuario->id) {
            $comentario->delete(); //Borrando el comentario de la BD.
            return redirect()->route("imagen.vista.detalle", ["id" => $comentario->getImagen->id])->with("mensaje", "Comentario eliminado correctamente"); //NOTA: El id es un parámetro enviado por GET, el mensaje es una variable enviada que solo puede ser procesada por blade.
        }
        else {
            return redirect()->route("imagen.vista.detalle", ["id" => $comentario->getImagen->id])->with("mensaje", "Error al eliminar el comentario"); //NOTA: El id es un parámetro enviado por GET, el mensaje es una variable enviada que solo puede ser procesada por blade.
        }
    }   
}
