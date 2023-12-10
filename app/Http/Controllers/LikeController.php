<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth"); //Este middleware, verifica que exista una sesión activa, de lo contrario se redirije al HOME.
    }
    
    //Métodos Vista (Retornan vistas).
    public function favoritos()
    {
        $usuario = Auth::user();
        $likes = Like::where("usuario_id", $usuario->id)->orderBy("id", "desc")->paginate(5);
        
        return view("models.like.favoritos", ["likes" => $likes]);
    }
    
    //Métodos Acción (Procesan datos desde formularios).
    public function save($idImagen) 
    {
        $usuario = Auth::user();
        
        $existeLike = Like::where("usuario_id", $usuario->id)->where("imagen_id", $idImagen)->count();
        
        if ($existeLike == 0) {
            $like = new Like();
            $like->usuario_id = $usuario->id;
            $like->imagen_id = (int)$idImagen;
            
            $like->save();
            
            return response()->json([ //Retornando un JSON.
                "like" => $like
            ]);
        }
        else {
            return response()->json([ //Retornando un JSON.
                "mensaje" => "SERVIDOR: El like ya existe"
            ]);
        }  
    }
    
    public function delete($idImagen) 
    {
        $usuario = Auth::user();
        
        $like = Like::where("usuario_id", $usuario->id)->where("imagen_id", $idImagen)->first(); //Se obtiene el el objeto de tipo Like.
        
        if ($like) { //Se verifica se existe el like (Si se logró traer un objeto desde la BD).       
            $like->delete();
            
            return response()->json([ //Retornando un JSON.
                "mensaje" => "SERVIDOR: Has dado dislike correctamente"
            ]);
        }
        else {
            return response()->json([ //Retornando un JSON.
                "mensaje" => "SERVIDOR: El like no existe"
            ]);
        }  
    }
}
