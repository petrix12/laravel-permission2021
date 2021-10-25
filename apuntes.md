# Sistema de Roles y Servicios
+ [Repositorio GitHub](https://github.com/petrix12/laravel-permission2021.git)

## Crear proyecto:
1. Crear proyecto **laravel-permission**:
    + $ laravel new laravel-permission --jet
    + Which Jetstream stack do you prefer?
        [0] livewire
        [1] inertia
    + Respuesta: **0**
    + Will your application use teams? (yes/no) [no]: **no**
    + Ingresar a la carpeta raíz del nuevo proyecto.
    + $ npm install
    + $ npm run dev
2. Cambiar el valor de las siguientes variables de entorno en .env:
    ```env
    APP_NAME="Sistema de Roles y Permisos"
    APP_URL=http://laravel-permission.test
    DB_DATABASE=laravel_permission
    ```
3. Crear base de datos **laravel_permission**.
    + **Nota**: escoger juego de caracteres: utf8_general_ci 
4. Ejecutar las migraciones:
    + $ php artisan migrate

## Crear repositorio en GitHub:
1. Crear proyecto en la página de [GitHub](https://github.com) con el nombre: **laravel-permission2021**.
    + **Description**: Plantilla para un sistema de roles y permisos con Laravel Permission.
    + **Public**.
2. En la ubicación raíz del proyecto en la terminal de la máquina local:
    + $ git init
    + $ git add .
    + $ git commit -m "Commit inicial"
    + $ git branch -M main
    + $ git remote add origin https://github.com/petrix12/laravel-permission2021.git
    + $ git push -u origin main

## Instalación de Laravel Permission
+ [Laravel Permission](https://spatie.be/docs/laravel-permission/v3/basic-usage/basic-usage)
1. Instalar Laravel Permission (sistema de roles y persmisos):
    + $ composer require spatie/laravel-permission
2. Publicar las vistas de Laravel Permission:
    + $ php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
3. Ejecutar las migraciones:
    + $ php artisan migrate
4. Implementar el trait **HasRoles** en el modelo **User**:
    ```php
    ≡
    use Spatie\Permission\Traits\HasRoles;

    class User extends Authenticatable
    {
        ≡
        use HasRoles;
        ≡
    }
    ```
5. Crear commit:
    + $ git add .
    + $ git commit -m "Instalación de Laravel Permission"
    + $ git push -u origin main

## Generaración de datos iniciales:
1. Creación de seeders:
    + $ php artisan make:seeder UserSeeder
    + $ php artisan make:seeder RoleSeeder
2. Programar método **run** del seeder **UserSeeder**:
    ```php
    public function run()
    {
        /*
            NOTA: En producción dejar solo los datos del adiministrador inicial (y establecer un password seguro
            desde la aplicación) y comentar la creación de los 99 usuarios de prueba.
        */
        $user = User::create([
            'name' => 'Pedro Jesús Bazó Canelón',
            'email' => 'bazo.pedro@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole('Admin');
        User::factory(99)->create();
    }
    ```
    + Importar la definición del modelo **User**:
    ```php
    use App\Models\User;
    ```
3. Programar método **run** del seeder **RoleSeeder**:
    ```php
    public function run()
    {
        /* Adaptar estas instucciones a los roles y permisos requerido por tu aplicación  */
        $rolAdmin = Role::create(['name' => 'Admin']);
        $rolRol1 = Role::create(['name' => 'Rol1']);
        $rolRol2 = Role::create(['name' => 'Rol2']);

        Permission::create(['name' => 'Admin'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Rol1'])->syncRoles($rolAdmin, $rolRol1);
        Permission::create(['name' => 'Rol2'])->syncRoles($rolAdmin, $rolRol2);

        Permission::create(['name' => 'crud.users.index'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.users.create'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.users.edit'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.users.destroy'])->syncRoles($rolAdmin);
        
        Permission::create(['name' => 'crud.roles.index'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.roles.create'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.roles.edit'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.roles.destroy'])->syncRoles($rolAdmin);
        
        Permission::create(['name' => 'crud.permissions.index'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.permissions.create'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.permissions.edit'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'crud.permissions.destroy'])->syncRoles($rolAdmin);

        Permission::create(['name' => 'crud.rol1.index'])->syncRoles($rolAdmin, $rolRol1);
        Permission::create(['name' => 'crud.rol1.create'])->syncRoles($rolAdmin, $rolRol1);
        Permission::create(['name' => 'crud.rol1.edit'])->syncRoles($rolAdmin, $rolRol1);
        Permission::create(['name' => 'crud.rol1.destroy'])->syncRoles($rolAdmin);

        Permission::create(['name' => 'crud.rol2.index'])->syncRoles($rolAdmin, $rolRol2);
        Permission::create(['name' => 'crud.rol2.create'])->syncRoles($rolAdmin, $rolRol2);
        Permission::create(['name' => 'crud.rol2.edit'])->syncRoles($rolAdmin, $rolRol2);
        Permission::create(['name' => 'crud.rol2.destroy'])->syncRoles($rolAdmin);
    }
    ```
    + Importar la definición de los modelos **Permissions** y **Role**:
    ```php
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;
    ```
4. Programar método **run** del seeder **DatabaseSeeder**:
    ```php
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
    ```
5. Restablecer la base de datos y ejecutar los seeders:
    + $ php artisan migrate:fresh --seed
6. Crear commit:
    + $ git add .
    + $ git commit -m "Generaración de datos iniciales"
    + $ git push -u origin main

## Integración de plantilla AdminLTE
+ [Laravel AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE)
+ [Plantilla AdminLTE](https://adminlte.io/themes/v3/index.html)
1. Instalar AdminLTE: 
	+ $ composer require jeroennoten/laravel-adminlte
    + $ php artisan adminlte:install
2. Crear archivo de rutas **routes\admin.php** para administrar privilegios de usuarios:
    ```php
    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\HomeController;

    Route::get('',[HomeController::class, 'index']);
    ``` 
3. Registrar el nuevo archivo de rutas en el provider **app\Providers\RouteServiceProvider.php** y establecer la ruta de inicio a la raíz:
    ```php
    ≡
    class RouteServiceProvider extends ServiceProvider
    {
        ≡
        public const HOME = '/';
        ≡
        public function boot()
        {
            ≡
            $this->routes(function () {
                ≡
                Route::middleware('web', 'auth')
                    ->prefix('admin')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/admin.php'));
            });
        }
        ≡
    }
    ≡
    ```
4. Crear contralador **HomeController** para administrar rutas de los administradores:
    + $ php artisan make:controller Admin\HomeController
5. Definir el método **index** en el controlador **HomeController**:
    ```php
    public function index(){
        return view('admin.index');
    }
    ```
6. Diseñar vista para pruebas **resources\views\admin\index.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Sistemas de roles y permisos | Soluciones++')

    @section('content_header')
        <h1>Sistemas de roles y permisos</h1>
    @stop

    @section('content')
        <p>Sistemas de roles y permisos</p>
    @stop

    @section('css')
        {{-- ARCHIVOS CSS REQUERIDOS POR LA APLICACIÓN --}}
    @stop

    @section('js')
        {{-- ARCHIVOS JS REQUERIDOS POR LA APLICACIÓN --}}
    @stop
    ```
7. Crear commit:
    + $ git add .
    + $ git commit -m "Integración de plantilla AdminLTE"
    + $ git push -u origin main

## Personalización inicial de la aplicación:
+ [Laravel Jetstream](https://jetstream.laravel.com/2.x/introduction.html)
1. Publicar componentes de Jetstream:
    + $ php artisan vendor:publish --tag=jetstream-views
    + **Importante**: todos los componentes de Jetstream se almacenarán en **resources\views\vendor\jetstream\components**
2. Asignarle el nombre **home** a la ruta raíz en **routes\web.php**:
    ```php
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    ```
3. Modificar plantilla **resources\views\layouts\app.blade.php**:
    ```php
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            ≡
            <title>{{ config('app.name', 'Sistema de roles y permisos') }}</title>
            ≡
        </head>
        <body class="font-sans antialiased">
            ≡
        </body>
    </html>
    ```
4. Modificar plantilla **resources\views\navigation-menu.blade.php**:
    ```php
    @php
    $nav_links = [
        [
            'name' => 'Principal',
            'route' => route('home'),
            'active' => request()->routeIs('home')
        ]
    ];
    @endphp

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    ≡

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        @foreach ($nav_links as $nav_link)
                            <x-jet-nav-link href="{{ $nav_link['route'] }}" :active="$nav_link['active']">
                                {{ $nav_link['name'] }}
                            </x-jet-nav-link>
                        @endforeach
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Teams Dropdown -->
                    ≡

                    <!-- Settings Dropdown -->
                    ≡
                </div>

                <!-- Hamburger -->
                ≡
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                @foreach ($nav_links as $nav_link)
                    <x-jet-responsive-nav-link href="{{ $nav_link['route'] }}" :active="$nav_link['active']">
                        {{ $nav_link['name'] }}
                    </x-jet-responsive-nav-link>
                @endforeach
            </div>

            <!-- Responsive Settings Options -->
            ≡
        </div>
    </nav>
    ```
5. Modificar vista **resources\views\welcome.blade.php**:
    ```php
    <x-app-layout>
    </x-app-layout>
    ```
6. Almacenar el logo corto y el logo completo de la organización respectivamente en:
    + public\assets\images\logo.png
    + public\assets\images\logo-completo.png
7. Modificar componente de Jetstream **resources\views\vendor\jetstream\components\application-logo.blade.php**:
    ```php
    <img src="{{ asset('assets/images/logo-completo.png') }}" alt="Logo Sefar Universal" width="120">
    ```
8. Modificar componente de Jetstream **resources\views\vendor\jetstream\components\application-mark.blade.php**:
    ```php
    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Sefar Universal" width="48">
    ```
9. Modificar componente de Jetstream **resources\views\vendor\jetstream\components\authentication-card-logo.blade.php**:
    ```php
    <a href="/">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Sefar Universal" width="100">
    </a>
    ```
10. Crear commit:
    + $ git add .
    + $ git commit -m "Personalización inicial de la aplicación"
    + $ git push -u origin main

## Diseño del Frontend de la aplicación:
+ [Documentación de Tailwind](https://tailwindcss.com/docs)
+ [Componentes de Tailwind](https://tailwindcomponents.com)
+ [Más componentes de Tailwind](https://v1.tailwindcss.com/components)
+ [Banco de imagenes Pixabay](https://pixabay.com/es)
+ [Banco de imagenes Pixel](https://www.pexels.com/es-es)
+ [Optimizador de imagen](https://tinypng.com)
1. Guardar imagenes de portada del proyecto en:
    + public\assets\images\home\img_portada.jpg
    + [Optimizador de imagen](https://tinypng.com)
2. Ubicar 4 imagenes (640 x 426) relacionadas con tu proyecto y guardarlas en **public\assets\images\home** con los nombres:
    + imagen_1.jpg
    + imagen_2.jpg
    + imagen_3.jpg
    + imagen_4.jpg
3. Rediseñar la vista **resources\views\welcome.blade.php**:
    ```php
    <x-app-layout>
        <section class="bg-cover" style="background-image: url({{ asset('assets/images/home/img_portada.jpg') }})">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
                <div class="w-full md:w-3/4 lg:w-1/2">
                    <h1 class="text-white font-bold text-4xl">Crea un sistema de roles y permisos con Larvel Permission</h1>
                    <p class="text-white text-lg mt-2 mb-4">Soluciones++, en donde un clic menos (-) importa!!!</p>
                </div>
            </div>
        </section>
        <section class="mt-24">
            <h1 class="text-gray-600 text-center text-3xl mb-6">CONTENIDO</h1>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
                <article>
                    <figure>
                        <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('assets/images/home/imagen_1.jpg') }}" alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700">Contenido 1</h1>
                    </header>
                    <p class="text-sm text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, possimus accusantium</p>
                </article>
                <article>
                    <figure>
                        <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('assets/images/home/imagen_2.jpg') }}" alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700">Contenido 2</h1>
                    </header>
                    <p class="text-sm text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, possimus accusantium</p>
                </article>
                <article>
                    <figure>
                        <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('assets/images/home/imagen_3.jpg') }}" alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700">Contenido 3</h1>
                    </header>
                    <p class="text-sm text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, possimus accusantium</p>
                </article>
                <article>
                    <figure>
                        <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('assets/images/home/imagen_4.jpg') }}" alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700">Contenido 4</h1>
                    </header>
                    <p class="text-sm text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, possimus accusantium</p>
                </article>
            </div>
        </section>
        <section class="mt-24 bg-gray-600 py-12">
            <h1 class="text-center text-white text-3xl">¿No sabes cómo implementer un sistema de roles y permisos?</h1>
            <p class="text-center text-white">En Soluciones++ te explicamos como</p>
            <div class="flex justify-center mt-4">
                <!-- https://v1.tailwindcss.com/components/buttons -->
                <a href="#" class="bg-blue-800 hover:bg-blue-100 text-white hover:text-black font-bold py-2 px-4 rounded">
                    Catálogo de cursos
                </a>
            </div>
        </section>
        <section class="my-24">
            <h1 class="text-center text-3xl text-gray-600">ROLES Y PERMISOS</h1>
            <p class="text-center text-gray-500 text-sm mb-6">Trabajamos duro para seguir encontrando soluciones</p>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
                {{-- CONTENIDO DE LA PÁGINA --}}
            </div>
        </section>
    </x-app-layout>
    ```
4. Importar los estilos propios y de **fontawesome-free** en **resources\views\layouts\app.blade.php**:
    ```php
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            ≡
            <!-- Styles -->
            ≡
            <link rel="stylesheet" href="{{ asset('css/sefar.css') }}">
            <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
            ≡
        </head>
        ≡­
    </html>
    ```
5. Crear archivo de **estilos resources\css\commom.css**:
    ```css
    .container{
        @apply max-w-7xl mx-auto px-4;
    }

    .card{
        @apply bg-white shadow-lg rounded overflow-hidden;
    }

    .card-body{
        @apply px-6 py-4;
    }

    .card-title{
        @apply text-xl text-gray-700 mb-2 leading-6;
    }

    .embed-responsive{
        position: relative;
        overflow: hidden;
        padding-top: 56.25%;
    }

    .embed-responsive iframe{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    @media(min-width:640px){
        .container{
            @apply px-6;
        }
    }

    @media(min-width:1024px){
        .container{
            @apply px-8;
        }
    }
    ```
    + [Documentación Tailwind Container](https://tailwindcss.com/docs/container)
6. Crear archivo de **resources\css\buttons.css**
    ```css
    .btn {
        @apply font-bold py-2 px-4 rounded;
    }

    .btn-block{
        @apply block text-center w-full;
    }

    .btn-primary {
        @apply bg-blue-500 text-white;
    }

    .btn-primary:hover {
        @apply bg-blue-700;
    }

    .btn-danger {
        @apply bg-red-500 text-white;
    }

    .btn-danger:hover {
        @apply bg-red-700;
    }
    ```
    + [Tailwind Buttons Component](https://v1.tailwindcss.com/components/buttons)
7. Importar **resources\css\commom.css** en **resources\css\app.css**:
    ```php
    ≡
    @import 'commom.css';
    @import 'buttons.css';
    ```
8. Compilar los nuevos estilos:
    + $ npm run watch
    + En caso de error:
        + $ npm uninstall cross-env (Luego borrar el directorio node_modules)
        + $ npm install --global cross-env
        + $ npm install --no-bin-links
        + $ npm audit fix --force
        + $ npm install
        + $ npm run watch
    + Otra posible solución:
        + Eliminar direcotorio node_modules
        + Eliminar package-lock.json
        + $ npm cache clear --force
        + $ npm install cross-env
        + $ npm install
        + $ npm run dev
9. Crear commit:
    + $ git add .
    + $ git commit -m "Diseño del Frontend de la aplicación"
    + $ git push -u origin main



## Control del avance del curso
1. Crear componente livewire para el status de cursos:
    + $ php artisan make:livewire CourseStatus
2. Redefinir la ruta **courses.status** en **routes\web.php**:
    ```php
    Route::get('course-status/{course}', CourseStatus::class)->name('courses.status')->middleware('auth');
    ```
    + Importar la definción del controlador del componente **CourseStatus**
    ```php
    use App\Http\Livewire\CourseStatus;
    ```
3. Diseñar vista **resources\views\livewire\course-status.blade.php**:
    ```php
    <div class="mt-8">
        <div class="container grid grid-cols-3 gap-8">
            <div class="col-span-2">
                <div class="embed-responsive">
                    {!! $current->iframe !!}
                </div>
                <h1 class="text-3xl text-gray-600 font-bold mt-4">
                {{ $current->name }} 
                </h1>
                @if ($current->description)
                    <div class="text-gray-600">
                        {{ $current->description->name }}
                    </div>
                @endif

                <div class="flex items-center mt-4 cursor-pointer">
                    <i class="fas fa-toggle-off text-2xl text-gray-600"></i>
                    <p class="text-sm ml-2">Marcar esta unidad como culminada</p>
                </div>

                <div class="card mt-2">
                    <div class="card-body flex text-gray-500 font-bold">
                        @if ($this->previous)
                            <a wire:click="changeLesson({{ $this->previous }})" class="cursor-pointer">Tema anterior</a>
                        @endif
                        @if ($this->next)
                            <a wire:click="changeLesson({{ $this->next }})" class="ml-auto cursor-pointer">Siguiente tema</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h1 class="text-2xl leading-8 text-center mb-4">{{ $course->title }}</h1>
                    <div class="flex items-center">
                        <figure>
                            <img class="h-12 w-12 object-cover rounded-full mr-4" src="{{ $course->teacher->profile_photo_url }}" alt="">
                        </figure>
                        <div>
                            <p>{{ $course->teacher->name }}</p>
                            <a class="text-blue-500 text-sm" href="">{{ '@' . Str::slug($course->teacher->name, '') }}</a>
                        </div>
                    </div>

                    <p class="text-gray-600 text-sm mt-2">20% completado</p>
                    <div class="relative pt-1">
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                            <div style="width:30%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                        </div>
                    </div>

                    <ul>
                        @foreach ($course->sections as $section)
                            <li class="text-gray-600 mb-4">
                                <a class="font-bold text-base inline-block mb-2">{{ $section->name }}</a>
                                <ul>
                                    @foreach ($section->lessons as $lesson)
                                        <li class="flex">
                                            <div>
                                                @if ($lesson->completed)
                                                    @if ($current->id == $lesson->id)
                                                        <span class="inline-block w-4 h-4 border-2 border-yellow-300 rounded-full mr-2 mt-1"></span>
                                                    @else
                                                        <span class="inline-block w-4 h-4 bg-yellow-300 rounded-full mr-2 mt-1"></span>
                                                    @endif
                                                @else
                                                    @if ($current->id == $lesson->id)
                                                        <span class="inline-block w-4 h-4 border-2 border-gray-500 rounded-full mr-2 mt-1"></span>
                                                    @else
                                                        <span class="inline-block w-4 h-4 bg-gray-500 rounded-full mr-2 mt-1"></span>
                                                    @endif
                                                @endif
                                            </div>
                                            <a class="cursor-pointer" wire:click="changeLesson({{ $lesson }})" >{{ $lesson->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    ```
    + La barra de progreso se tomó de:
        + https://www.creative-tim.com/learning-lab/tailwind-starter-kit/documentation/css/progressbars
4. Programar controlador del componente **CourseStatus** **app\Http\Livewire\CourseStatus.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use App\Models\Course;
    use App\Models\Lesson;
    use Livewire\Component;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    class CourseStatus extends Component
    {
        use AuthorizesRequests;
        public $course, $current;

        // atrapa el slug del curso en la url (el método debe llamarse mount)
        public function mount(Course $course){
            $this->course = $course;
            foreach($course->lessons as $lesson){
                if(!$lesson->completed){
                    $this->current = $lesson;
                    break;
                }
            }

            // En caso de que todas las lecciones esten completadas
            if(!$this->current){
                $this->current = $course->lessons->last();
            }

            // Verifica si el usuario tiene autorización para ingresar al curso
            $this->authorize('enrolled', $course);
        }

        public function render()
        {
            return view('livewire.course-status');
        }

        // MÉTODOS

        public function changeLesson(Lesson $lesson){
            $this->current = $lesson;
        }

        public function completed(){
            if($this->current->completed){
                // Eliminar registro
                $this->current->users()->detach(auth()->user()->id);
            }else{
                // Agregar registro
                $this->current->users()->attach(auth()->user()->id);
            }
            $this->current = Lesson::find($this->current->id);
            $this->course = Course::find($this->course->id);
        }

        // PROPIEDADES COMPUTADAS

        // Propiedad computada para index
        public function getIndexProperty(){
            return $this->course->lessons->pluck('id')->search($this->current->id);
        }

        // Propiedad computada para previous
        public function getPreviousProperty(){
            if($this->index == 0){
                return null;
            }else{
                return $this->course->lessons[$this->index - 1];
            }
        }

        // Propiedad computada para next
        public function getNextProperty(){
            if($this->index == $this->course->lessons->count() - 1){
                return null;
            }else{
                return $this->course->lessons[$this->index + 1];
            }
        }
        
        // Propiedad computada para advance
        public function getAdvanceProperty(){
            $i = 0;
            foreach ($this->course->lessons as $lesson) {
                if($lesson->completed){
                    $i++;
                }
            }
            $advance = ($i * 100)/($this->course->lessons->count());
            return round($advance, 2);
        }

        public function download(){
            return response()->download(storage_path('app/public/' . $this->current->resource->url));
        }
    }
    ```
5. Agregar atributo para comprobar si una lección esta completada en el controlador **app\Models\Lesson.php**:
    ```php
    ≡
    class Lesson extends Model
    {
        ≡
        protected $guarded = ['id'];

        // Esta función es un atributo: get[Completed]Attribute
        // Comprueba si una lección esta completada
        public function getCompletedAttribute(){
            // Para traernos el registro del usuario autentificado
            return $this->users->contains(auth()->user()->id);
        }
        ≡
    }
    ```
6. Crear método **published** en **app\Policies\CoursePolicy.php** para proteger rutas:
    ```php
    public function published(?User $user, Course $course){
        if($course->status == 3){
            return true;
        }else{
            return false;
        }
    }
    ```
7. Crear commit:
    + $ git add .
    + $ git commit -m "Control del avance del curso"
    + $ git push -u origin main

## Implementación de roles y permisos
+ https://hackerthemes.com/bootstrap-cheatsheet
+ https://github.com/jeroennoten/Laravel-AdminLTE/wiki
1. Crear controlador para administrar las rutas relacionadas con los cursos de los instructores:
    + $ php artisan make:controller Instructor\CourseController -r
2. Crear componentes para cursos de instructores:
    + $ php artisan make:livewire Instructor/CoursesIndex
3. Crear archivo de rutas **routes\instructor.php**:
    ```php
    <?php

    use App\Http\Controllers\Instructor\CourseController;
    use Illuminate\Support\Facades\Route;

    Route::redirect('', 'instructor/courses');

    Route::resource('courses', CourseController::class)->names('courses');
    ```
4. Registrar el nuevo archivo de rutas **instructor** y modificar **admin** en el método **boot** del provider **app\Providers\RouteServiceProvider.php**:
    ```php
    public function boot()
    {
        ≡
        $this->routes(function () {
            ≡
            Route::middleware('web', 'auth')
                ->name('admin.')
                ->prefix('admin')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

            Route::middleware('web', 'auth')
                ->name('instructor.')
                ->prefix('instructor')
                ->namespace($this->namespace)
                ->group(base_path('routes/instructor.php'));
        });
    }
    ```
5. Modificar plantilla **resources\views\navigation-menu.blade.php**:
    ```php
    ≡
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
        <!-- Primary Navigation Menu -->
        <div class="container">
            <div class="flex justify-between h-16">
                ≡
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    ≡
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        @auth
                            <x-jet-dropdown align="right" width="48">
                                ≡
                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-jet-dropdown-link>

                                    @can('Leer cursos')
                                        <x-jet-dropdown-link href="{{ route('instructor.courses.index') }}">
                                            Instructor
                                        </x-jet-dropdown-link>
                                    @endcan

                                    @can('Ver dashboard')
                                        <x-jet-dropdown-link href="{{ route('admin.home') }}">
                                            Administrador
                                        </x-jet-dropdown-link>
                                    @endcan
                                    ≡
                                </x-slot>
                            </x-jet-dropdown>
                        @else
                            ≡
                        @endauth
                    </div>
                </div>
                ≡
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            ≡
            <!-- Responsive Settings Options -->
            @auth
                <div class="pt-4 pb-1 border-t border-gray-200">
                    ≡
                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-jet-responsive-nav-link>

                        @can('Leer cursos')
                            <x-jet-responsive-nav-link href="{{ route('instructor.courses.index') }}" :active="request()->routeIs('instructor.courses.index')">
                                Instructor
                            </x-jet-responsive-nav-link>
                        @endcan
                
                        @can('Ver dashboard')
                            <x-jet-responsive-nav-link href="{{ route('admin.home') }}" :active="request()->routeIs('admin.home')">
                                Administrador
                            </x-jet-responsive-nav-link>
                        @endcan    
                        ≡
                    </div>
                </div>
            @else
                ≡
            @endauth
        </div>
    </nav>
    ```
6. Crear controlador para administrar roles:
    + $ php artisan make:controller Admin/RoleController -r
7. Definir los métodos del controlador **app\Http\Controllers\Admin\RoleController.php**:
    ```php
    ≡
    class RoleController extends Controller
    {
        ≡
        public function index()
        {
            $roles = Role::all();
            return view('admin.roles.index', compact('roles'));
        }

        ≡
        public function create()
        {
            $permissions = Permission::all();
            return view('admin.roles.create', compact('permissions'));
        }

        ≡
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'permissions' => 'required'
            ]);
            
            $role = Role::create([
                'name' => $request->name
            ]);

            $role->permissions()->attach($request->permissions);

            return redirect()->route('admin.roles.index')->with('info', 'El rol se creo satisfactoriamente');
        }

        ≡
        public function show(Role $role)
        {
            return view('admin.roles.show', compact('role'));
        }

        ≡
        public function edit(Role $role)
        {
            $permissions = Permission::all();
            return view('admin.roles.edit', compact('role', 'permissions'));
        }

        ≡
        public function update(Request $request, Role $role)
        {
            $request->validate([
                'name' => 'required',
                'permissions' => 'required'
            ]);

            $role->update([
                'name' => $request->name
            ]);

            $role->permissions()->sync($request->permissions);
            
            return redirect()->route('admin.roles.edit', $role);
        }

        ≡
        public function destroy(Role $role)
        {
            $role->delete();
            return redirect()->route('admin.roles.index')->with('info', 'El rol se eliminó con éxito');
        }
    }
    ```
    + Importar la definición de los modelos **Permission** y **Role**:
    ```php
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;
    ```
8. Publicar vista de AdminLTE:
    + $ php artisan adminlte:install --only=main_views
    + **Nota**: En **resources\views\vendor\adminlte\page.blade.php** es de donde se extienden las plantillas.
9. Instalar Laravel Collective para hacer formularios:
    + $ composer require laravelcollective/html
    + [Documentación Laravel Collective](https://laravelcollective.com/docs/6.x/html)
10. Crear vistas del CRUD Role **resources\views\admin\roles\index.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Roles | Sefar Univeral')

    @section('content_header')
        <h1>Lista de roles</h1>
    @stop

    @section('content')
        @if (session('info'))
            <div class="alert alert-primary" role="alert">
                <strong>¡Éxito!</strong> {{ session('info') }}
                important alert message.
            </div>
            
        @endif

        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.roles.create') }}">Crear rol</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td width="10px">
                                    <a class="btn btn-secondary" href="{{ route('admin.roles.edit', $role) }}">Editar</a>
                                </td>
                                <td width="10px">
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay ningún rol registrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
    ```
11. Crear vistas del CRUD Role **resources\views\admin\roles\create.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Crear rol | Sefar Universal')

    @section('content_header')
        <h1>Crear nuevo rol</h1>
    @stop

    @section('content')
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'admin.roles.store']) !!}
                    @include('admin.roles.partials.form')
                    {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
    ```
12. Crear vistas del CRUD Role **resources\views\admin\roles\show.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Sefar Universal')

    @section('content_header')
        <h1>Sefar Universal</h1>
    @stop

    @section('content')
        <p>Welcome to this beautiful admin panel.</p>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
    ```
13. Crear vistas del CRUD Role **resources\views\admin\roles\edit.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Editar rol | Sefar Universal')

    @section('content_header')
        <h1>Editar rol</h1>
    @stop

    @section('content')
        <div class="card">
            <div class="card-body">
                {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'put']) !!}
                    @include('admin.roles.partials.form')
                    {!! Form::submit('Actualizar Rol', ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
    ```
14. Crear formulario para el rol como **resources\views\admin\roles\partials\form.blade.php**:
    ```php
    <div class="form-group">
        {!! Form::label('name', 'Nombre: ') !!}
        {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' :  ''), 'placeholder' => 'Escriba un nombre']) !!}
        @error('name')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <strong>Permisos</strong>
    @error('permissions')
        <br>
        <small class="text-danger">
            <strong>{{ $message }}</strong>
        </small>
        <br>
    @enderror
    @foreach ($permissions as $permission)
        <div>
            <label>
                {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                {{ $permission->name }}
            </label>
        </div>
    @endforeach
    ```
15. Modificar el archivo de rutas **routes\admin.php**:
    ```php
    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\HomeController;
    use App\Http\Controllers\Admin\RoleController;
    use App\Http\Controllers\Admin\UserController;

    Route::get('', [HomeController::class, 'index'])->middleware('can:Ver dashboard')->name('home');

    Route::resource('roles', RoleController::class)->names('roles');

    Route::resource('users', UserController::class)->only(['index', 'edit', 'update'])->names('users');
    ```
16. Modificar el archivo de configuración **config\adminlte.php**:
    ```php
    <?php

    return [
        ≡
        'logo' => '<b>Sefar</b> Universal',
        'logo_img' => 'images/logo.png',
        ≡
        'logo_img_alt' => 'Logo Sefar',

        ≡
        'dashboard_url' => '/',
        ≡

        'menu' => [
            [
                'text'      => 'search',
                'search'    => true,
                'topnav'    => true,
            ],
            [
                'text' => 'blog',
                'url'  => 'admin/blog',
                'can'  => 'manage-blog',
            ],
            [
                'text'  => 'Dashboard',
                'route' => 'admin.home',
                'icon'  => 'fas fa-fw fa-tachometer-alt',
                'can'   => 'Ver dashboard'
            ],
            [
                'text'      => 'Lista de roles',
                'route'     => 'admin.roles.index',
                'icon'      => 'fas fa-fw fa-users-cog',
                'can'       => 'Listar role',
                'active'    => ['admin/roles*'],
            ],
            [
                'text'      => 'Usuarios',
                'route'     => 'admin.users.index',
                'icon'      => 'fas fa-fw fa-users',
                'can'       => 'Leer usuarios',
                'active'    => ['admin/users*'],
            ],
            ['header' => 'OPCIONES DE CURSO'],
            [
                'text' => 'Categoría',
                /* 'route'  => 'admin.categories.index', */
                'icon' => 'fas fa-fw fa-cogs',
            ],
            [
                'text' => 'Niveles',
                /* 'route'  => 'admin.levels.index', */
                'icon' => 'fas fa-fw fa-chart-line',
            ],
            [
                'text' => 'Precios',
                /* 'route'  => 'admin.prices.index', */
                'icon' => 'fab fa-fw fa-cc-visa',
            ],
            [
                'text' => 'Pendientes de aprobación',
                /* 'route'  => 'admin.courses.index', */
                'icon' => 'fas fa-fw fa-user',
            ],
        ],
        ≡
        'livewire' => true,
    ];
    ```
17. Crear controlador **User** para CRUD de usuarios:
    + $ php artisan make:controller Admin\UserController -r
18. Programar el controlador **app\Http\Controllers\Admin\UserController.php**:
    ```php
    <?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Spatie\Permission\Models\Role;

    class UserController extends Controller
    {
        /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function index()
        {
            return view('admin.users.index');
        }

        /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function edit(User $user)
        {
            $roles = Role::all();
            return view('admin.users.edit', compact('user', 'roles'));
        }

        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, User $user)
        {
            $user->roles()->sync($request->roles);
            return redirect()->route('admin.users.edit', $user);
        }
    }
    ```
19. Crear vistas del CRUD User **resources\views\admin\users\index.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'usuarios | Sefar Universal')

    @section('content_header')
        <h1>Lista de usuarios</h1>
    @stop

    @section('content')
        @livewire('admin.users-index')
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
    ```
20. Crear vistas del CRUD User **resources\views\admin\users\edit.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Editar usuario | Sefar Universal')

    @section('content_header')
        <h1>Editar usuario</h1>
    @stop

    @section('content')
        <div class="card">
            <div class="card-body">
                <h1 class="h5">Nombre:</h1>
                <p class="form-control">{{ $user->name }}</p>
                <h1 class="h5">Lista de roles</h1>
                {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
                    @foreach ($roles as $role)
                        <div>
                            <label>
                                {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                    {!! Form::submit('Asignar rol', ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
    ```
21. Crear componente de livewire para administrar usuarios:
    + $ php artisan make:livewire Admin/UsersIndex
22. Programar controlador del componente **app\Http\Livewire\Admin\UsersIndex.php**:
    ```php
    <?php

    namespace App\Http\Livewire\Admin;

    use App\Models\User;
    use Livewire\Component;
    use Livewire\WithPagination;

    class UsersIndex extends Component
    {
        use WithPagination;

        protected $paginationTheme = "bootstrap";

        public $search;

        public function render()
        {
            $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                        ->paginate(8);
            return view('livewire.admin.users-index', compact('users'));
        }

        public function limpiar_page(){
            $this->reset('page');
        }
    }
    ```
23. Diseñar vista del componente **resources\views\livewire\admin\users-index.blade.php**:
    ```php
    <div>
        <div class="card">
            <div class="card-header">
                <input wire:keydown="limpiar_page" wire:model="search" class="form-control w-100" placeholder="Escriba un nombre ...">
            </div>
            @if ($users->count())
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td width="10px">
                                        <a class="btn btn-primary" href="{{ route('admin.users.edit', $user) }}">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
            @else
                <div class="card-body">
                    <strong>No hay registros ...</strong>
                </div>
            @endif
        </div>
    </div>
    ```
24. Crear el método **__construct** en el controlador **app\Http\Controllers\Admin\RoleController.php** para proteger las rutas **roles**:
    ```php
    ≡
    class RoleController extends Controller
    {
        public function __construct(){
            $this->middleware('can:Listar role')->only('index');
            $this->middleware('can:Crear role')->only('create', 'store');
            $this->middleware('can:Editar role')->only('edit', 'update');
            $this->middleware('can:Eliminar role')->only('destroy');
        }
        ≡
    }
    ```
25. Crear el método **__construct** en el controlador **app\Http\Controllers\Admin\UserController.php** para proteger las rutas **users**:
    ```php
    ≡
    class UserController extends Controller
    {
        public function __construct(){
            $this->middleware('can:Leer usuarios')->only('index');
            $this->middleware('can:Editar usuarios')->only('edit', 'update');
        }
        ≡
    }
    ```
26. Modificar el controlador del componente **app\Http\Livewire\Instructor\CoursesIndex.php**:
    ```php
    <?php

    namespace App\Http\Livewire\Instructor;

    use App\Models\Course;
    use Livewire\Component;
    use Livewire\WithPagination;

    class CoursesIndex extends Component
    {
        use WithPagination;

        public $search;

        public function render()
        {
            $courses = Course::where('title', 'LIKE', '%' . $this->search . '%')
                                ->where('user_id', auth()->user()->id)
                                ->paginate(8);
            return view('livewire.instructor.courses-index', compact('courses'));
        }

        public function limpiar_page(){
            $this->reset('page');
        }
    }
    ```
27. Crear commit:
    + $ git add .
    + $ git commit -m "Implementación de roles y permisos"
    + $ git push -u origin main