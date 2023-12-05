<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagen;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //Este middleware, verifica que exista una sesión activa, de lo contrario se redirije al HOME.
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $imagenes = Imagen::orderBy("id", "desc")->paginate(5); //Se traen todas las imagenes en orden descendente (El método "paginate" recibe una cantidad por parámetro, la cual indica la cantidad de indices que se muestran por página al momento de recorrer el Array, cuando se supera la cantidad se crea una segunda pagina con el mismo máximo de indices "?page=2").
        return view('home', ["imagenes" => $imagenes]); //Se retorna la vista con las imagenes paginadas.
    }
}
