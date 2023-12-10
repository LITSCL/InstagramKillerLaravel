<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\Imagen;
use App\Models\Comentario;
use App\Models\Like;

class ImagenController extends Controller
{ 
    public function __construct()
    {
        $this->middleware("auth"); //Este middleware, verifica que exista una sesión activa, de lo contrario se redirije al HOME.
    }
    
    //Métodos Vista (Retornan vistas).
    public function subir() 
    {
        return view("models.imagen.subir"); //Retornando vista "models/imagen/subir.blade.php".
    }
    
    public function detalle($id)
    {
        $imagen = Imagen::find($id); //Obteniendo la imagen por su clave primaria.      
        return view("models.imagen.detalle", ["imagen" => $imagen]);
    }
    
    public function editar($id)
    {
    	$usuario = Auth::user();
    	$imagen = Imagen::find($id);
    	
    	if ($usuario && $imagen && $imagen->getUsuario->id == $usuario->id) {
    		return view("models.imagen.editar",["imagen" => $imagen]);
    	}
    	else {
    		return redirect()->route("home");
    	}
    }
    
    //Métodos Acción (Procesan datos desde formularios).
    public function save(Request $request) 
    {    
        //1. Obtener el usuario logeado.
        $usuario = Auth::user(); //Esto es un objeto.
        
        //2. validar los datos.
        $validacion = $this->validate($request, [
            "descripcion" => ["required", "string", "max:255"],
            "imagen" => ["required", "mimes:jpg,jpeg,png"], //La validación "mimes" permite validar los tipos de formatos permitidos del archivo.
        ]);
        
        //3. Almacenar los datos.
        $rutaImagen = $request->file("imagen"); //Los archivos se reciben con el método file.
        $descripcion = $request->input("descripcion");
        
        if ($rutaImagen) { //Se verifica que exista el archivo (Imagen).
            $nuevoNombreImagen = "img" . "-" . time() . "-" . $rutaImagen->getClientOriginalName(); //Se genera un nombre random (Para que no se repita en la carpeta donde se va a guardar).
            Storage::disk("imagen-imagenes")->put($nuevoNombreImagen, File::get($rutaImagen)); //Acá se almacena el archivo (Imagen) en su respectiva carpeta. El método "disk" permite seleccionar un disco Laravel (Una carpeta), el método "put" permite almacenar un archivo en la carpeta (Primer parámetro nombre nuevo del archivo, segundo parámetro ruta actual del archivo). El método estático "File::get", permite obtener un archivo almacenado en la carpeta de archivos temporales de Laravel.
        }
        
        //4. Setear los datos que se desean cambiar al objeto.
        $imagen = new Imagen();
        $imagen->imagen = $nuevoNombreImagen;
        $imagen->descripcion = $descripcion;
        $imagen->usuario_id = $usuario->id;
        
        //5. Guardar el registro en la base de datos.
        $imagen->save();
        
        return redirect()->route("home")->with("mensaje", "Imagen subida correctamente"); //Redireccionando a una vista y enviando un mensaje.
    }
    
    public function update(Request $request)
    {
    	//1. Validar datos
    	$validacion = $this->validate($request, [
    			"descripcion" => ["required", "string", "max:255"],
    			"imagen" => ["mimes:jpg,jpeg,png"],
    	]);
    	
    	//2. Almacenar los datos.
    	$idImagen = $request->input("idImagen");
    	$descripcion = $request->input("descripcion");
    	$rutaImagen = $request->file("imagen");
    	
    	if ($rutaImagen) {
    		$nuevoNombreImagen = "img" . "-" . time() . "-" . $rutaImagen->getClientOriginalName();
    		Storage::disk("imagen-imagenes")->put($nuevoNombreImagen, File::get($rutaImagen));
    	}
    	else {
    		$nuevoNombreImagen = false;
    	}

    	//3. Obtener objeto desde la BD.
		$imagen = Imagen::find($idImagen);

		//4. Setear los datos que se desean cambiar al objeto.	
		if ($nuevoNombreImagen) {
			$imagen->imagen = $nuevoNombreImagen;
		}
		$imagen->descripcion = $descripcion;

		//5. Actualizar el registro en la base de datos.
		$imagen->update();
		
		return redirect()->route("imagen.vista.detalle", ["id" => $idImagen])->with("mensaje", "Imagen actualizada correctamente");
    }
    
    public function delete($id)
    {
    	$usuario = Auth::user();
    	$imagen = Imagen::find($id);
    	$comentarios = Comentario::where("imagen_id", $id)->get();
    	$likes = Like::where("imagen_id", $id)->get();
    	
    	if ($usuario && $imagen && $imagen->getUsuario->id == $usuario->id) {
    		//1. Eliminar los comentarios.
    		if ($comentarios && count($comentarios) >= 1) {
    			foreach ($comentarios as $comentario) {
    				$comentario->delete();
    			}
    		}
    		
    		//2. Eliminar los likes.
    		if ($likes && count($likes) >= 1) {
    			foreach ($likes as $like) {
    				$like->delete();
    			}
    		}
    		
    		//3. Eliminar fichero de imagen.
    		Storage::disk("imagen-imagenes")->delete($imagen->imagen);
    		
    		//4. Eliminar la imagen.
    		$imagen->delete();
    		
    		$mensaje = array("mensaje" => "La imagen se ha borrado correctamente");
    	}
    	else {
    		$mensaje = array("mensaje" => "La imagen no se ha podido borrar");
    	}
    	return redirect()->route("home")->with($mensaje);
    }
    
    //Métodos Archivo (Retornan archivos).
    public function getImagen($nombreArchivo)
    {
        $archivo = Storage::disk("imagen-imagenes")->get($nombreArchivo); //Se accede al disco Laravel y se obtiene el archivo por su nombre.
        return new Response($archivo, 200); //Se retorna el archivo (Enviando código 200 "OK").
    }  
}
