<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\empleados;


class ListingController extends Controller
{
    public function index(Request $request)
    {
        $query = Listing::query()
            ->where('is_active', true)
            ->with('tags')
            ->latest();

        if ($request->has('s')) {
            $searchQuery = trim($request->get('s'));

            $query->where(function (Builder $builder) use ($searchQuery) {
                $builder
                    ->orWhere('title', 'like', "%{$searchQuery}%")
                    ->orWhere('company', 'like', "%{$searchQuery}%")
                    ->orWhere('location', 'like', "%{$searchQuery}%");
            });
        }

        if ($request->has('tag')) {
            $tag = $request->get('tag');
            $query->whereHas('tags', function (Builder $builder) use ($tag) {
                $builder->where('slug', $tag);
            });
        }

        $listings = $query->get();

        $tags = Tag::orderBy('name')
            ->get();

        return view('listings.index', compact('listings', 'tags'));
    }

    public function show(Listing $listing, Request $request)
    {
        return view('listings.show', compact('listing'));
    }

    public function apply(Listing $listing, Request $request)
    {
        $listing->clicks()
            ->create([
                'user_agent' => $request->userAgent(),
                'ip' => $request->ip()
            ]);

        return redirect()->to($listing->apply_link);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario de creación de listados
        $validationArray = [
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Logo opcional
            'content' => 'required',
            'payment_method_id' => 'required'
        ];
    
        // Si no hay un usuario autenticado, agregar validación adicional para la creación de usuario
        if (!Auth::check()) {
            $validationArray = array_merge($validationArray, [
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:5',
                'name' => 'required'
            ]);
        }
    
        $request->validate($validationArray);
    
        // Obtener el usuario autenticado o crear uno nuevo
        $user = Auth::user();
    
        if (!$user) {
            $user = new User;
               
            
                $user = new User;
                $user->name =  $request->name;
                $user->email = $request->email;
                $user->rol = '2'; // Asignación corregida
                $user->password = bcrypt($request->password);
                $user->save();
            Auth::login($user);
        }
    
        // Procesar el pago y crear el listado
        try {
            $amount = 9900; // $99.00 USD en centavos
    
            if ($request->filled('is_highlighted')) {
                $amount += 1900;
            }
    
            $user->charge($amount, $request->payment_method_id);
    
            $md = new \ParsedownExtra();

            $logoPath = null; // Establecer el valor inicial del logo como nulo

            if ($request->hasFile('logo')) {
                $logoPath = basename($request->file('logo')->store('public')); // Guardar el archivo del logo
            }


            $listing = $user->listings()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . rand(1111, 9999),
                'company' => $request->company,
                'logo' => $logoPath,
                'location' => $request->location,
                'content' => $md->text($request->input('content')),
                'is_highlighted' => $request->filled('is_highlighted'),
                'is_active' => true
            ]);
    
            // Asociar etiquetas al listado
            foreach(explode(',', $request->tags) as $requestTag) {
                $tag = Tag::firstOrCreate([
                    'slug' => Str::slug(trim($requestTag))
                ], [
                    'name' => ucwords(trim($requestTag))
                ]);
    
                $tag->listings()->attach($listing->id);
            }
    
            return redirect()->route('dashboard')->with('success', 'Listing created successfully');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

    public function createE()
    {
        return view('listings.createE');
    }

    public function job(Request $request)
    {
        // Validar los datos del formulario

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:',
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'foto_perfil' => 'required|image|max:2048',
            'direccion' => 'required',
            'ciudad' => 'required',
            'estado' => 'required',
            'codigo_postal' => 'required',
            'habilidades' => 'required',
            'experiencia_laboral' => 'required',
            'educacion' => 'required',
            'resumen' => 'required'
        ]);


        // $validator = array_merge($validator, [
        //     'email' => 'required|email',
        //     'nombre' => 'required',
        //     'apellido' => 'required',
        //     'telefono' => 'required',
        //     'foto_perfil' => 'required|image|max:2048',
        //     'direccion' => 'required',
        //     'ciudad' => 'required',
        //     'estado' => 'required',
        //     'codigo_postal' => 'required',
        //     'habilidades' => 'required',
        //     'experiencia_laboral' => 'required',
        //     'educacion' => 'required',
        //     'resumen' => 'required',
        // ]);

        // Si la validación falla, redirigir de vuelta con los errores
       
       
   

        $fotoPerfil = $request->file('foto_perfil');
        $fotoPerfilBytes = null;
        
        if ($fotoPerfil) {
            $fotoPerfilBytes = file_get_contents($fotoPerfil->getPathname());
        }
        
        
        // Crear un nuevo empleado
        $empleado = new empleados();
        $empleado->email = $request->input('email');
        $empleado->nombre = $request->input('nombre');
        $empleado->apellido = $request->input('apellido');
        $empleado->telefono = $request->input('telefono');
        $empleado->foto_perfil = $fotoPerfilBytes;
        $empleado->direccion = $request->input('direccion');
        $empleado->ciudad = $request->input('ciudad');
        $empleado->estado = $request->input('estado');
        $empleado->codigo_postal = $request->input('codigo_postal');
        $empleado->habilidades = $request->input('habilidades');
        $empleado->experiencia_laboral = $request->input('experiencia_laboral');
        $empleado->educacion = $request->input('educacion');
        $empleado->resumen = $request->input('resumen');

        // Guardar el empleado en la base de datos
        $empleado->save();

        $usuario = new User;
        $usuario->name = $request->input('nombre');
        $usuario->email = $request->input('email');
        $usuario->rol = 1;
        $usuario->password = bcrypt($request->input('clave'));

        $usuario->save();

        return redirect()->route('login')->with('success', 'Empleado guardado exitosamente');
    }
}