<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\Usuario;

class UsuarioController extends Controller
{    
    public function __construct()
    {
        $this->middleware("auth"); //Este middleware, verifica que exista una sesión activa, de lo contrario se redirije al HOME.
    }
    
    //Métodos Vista (Retornan vistas).
    public function configuracion() 
    {
        return view("models.usuario.configuracion"); //Retornando vista "models/usuario/configuracion.blade.php".
    }
    
    public function perfil($id)
    {
        $usuario = Usuario::find($id);
        
        return view("models.usuario.perfil", ["usuario" => $usuario]);
    }
    
    public function usuarios($buscar = null)
    {
    	if (!empty($buscar)) {
    		$usuarios = Usuario::where("alias", "LIKE", "%" . $buscar . "%")
    			->orWhere("nombre", "LIKE", "%" . $buscar . "%")
    			->orWhere("apellido", "LIKE", "%" . $buscar . "%")
    			->orderBy("id", "desc")->paginate(5); //Si el primer "where" no trae datos, se activa el "orWhere", si el "orWhere" no trae datos, se activa el otro "orWhere".
    	}
    	else {
    		$usuarios = Usuario::orderBy("id", "desc")->paginate(5);
    	}
    	return view("models.usuario.usuarios", ["usuarios" => $usuarios]);
    }
    
    //Métodos Acción (Procesan datos desde formularios).
    public function update(Request $request) 
    {  
        //1. Obtener el usuario logeado.
        $usuario = Auth::user(); //Esto es un objeto.
        
        $id = $usuario->id;
        
        //2. validar los datos.
        $validacion = $this->validate($request, [
            "nombre" => ["required", "string", "max:255"],
            "apellido" => ["required", "string", "max:255"],
            "alias" => ["required", "string", "max:255", "unique:usuario,alias,$id"], //Donde dice "unique:usuario", se verifica que el valor sea único en la columna de la tabla usuario. Donde dice "alias,$id", indica una excepción (Si el alias corresponde al registro cuyo id sea el entregado, entonces no se aplica la validación "En este caso es el mismo id del usuario a modificar").
            "correo" => ["required", "string", "email", "max:255", "unique:usuario,correo,$id"],
        ]);
        
        //3. Almacenar los datos.
        $nombre = $request->input("nombre");
        $apellido = $request->input("apellido");
        $alias = $request->input("alias");
        $correo = $request->input("correo");      
        $rutaImagen = $request->file("imagen"); //Los archivos se reciben con el método file.

        if ($rutaImagen) { //Se verifica que exista el archivo (Imagen).
            $nuevoNombreImagen = "img" . "-" . time() . "-" . $rutaImagen->getClientOriginalName(); //Se genera un nombre random (Para que no se repita en la carpeta donde se va a guardar).
            Storage::disk("usuario-imagenes")->put($nuevoNombreImagen, File::get($rutaImagen)); //Acá se almacena el archivo (Imagen) en su respectiva carpeta. El método "disk" permite seleccionar un disco Laravel (Una carpeta), el método "put" permite almacenar un archivo en la carpeta (Primer parámetro nombre nuevo del archivo, segundo parámetro ruta actual del archivo). El método estático "File::get", permite obtener un archivo almacenado en la carpeta de archivos temporales de Laravel.
        }
        else {
        	$nuevoNombreImagen = false;
        }
        
        //4. Setear los datos que se desean cambiar al objeto.
        $usuario->nombre = $nombre;
        $usuario->apellido = $apellido;
        $usuario->alias = $alias;
        $usuario->correo = $correo;
        if ($nuevoNombreImagen) {
        	$usuario->imagen = $nuevoNombreImagen;
        }
        
        //5. Actualizar el registro en la base de datos.
        $usuario->update();
        
        return redirect()->route("usuario.vista.configuracion")->with("mensaje", "Usuario actualizado correctamente"); //Redireccionando a una vista y enviando un mensaje.
    }

    //Métodos Archivo (Retornan archivos).
    public function getImagen($nombreArchivo) 
    {
        $archivo = Storage::disk("usuario-imagenes")->get($nombreArchivo); //Se accede al disco Laravel y se obtiene el archivo por su nombre.
        return new Response($archivo, 200); //Se retorna el archivo (Enviando código 200 "OK").
    }   
}
