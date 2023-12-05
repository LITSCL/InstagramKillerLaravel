<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) //Permite validar los inputs de la vista de registro.
    {
        return Validator::make($data, [
            "nombre" => ["required", "string", "max:255"],
            "apellido" => ["required", "string", "max:255"],
            "alias" => ["required", "string", "max:255"],
            "correo" => ["required", "string", "email", 'max:255', 'unique:usuario'], //Donde dice "unique:usuario", se valida que el valor sea único en la columna de la tabla usuario.
            "clave" => ["required", "string", "min:3"],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Usuario
     */
    protected function create(array $data) //Crea un usuario tomando los datos de la vista de registro.
    {
        return Usuario::create([
            'rol' => "Usuario",
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'alias' => $data['alias'],
            'correo' => $data['correo'],
            'clave' => Hash::make($data['clave']),
        ]);
    }
}
