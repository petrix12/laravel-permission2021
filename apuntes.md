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
        Permission::create(['name' => 'Ver dashboard'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Listar role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Crear role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Editar role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Eliminar role'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Leer usuarios'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Editar usuarios'])->syncRoles($rolAdmin);
        Permission::create(['name' => 'Rol1'])->syncRoles($rolAdmin, $rolRol1);
        Permission::create(['name' => 'Rol2'])->syncRoles($rolAdmin, $rolRol2);
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

    Route::get('', [HomeController::class, 'index'])->middleware('can:Admin')->name('home');
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
                    ->name('admin.')
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
                'name' => 'Home',
                'route' => route('home'),
                'active' => request()->routeIs('home')
            ],
        ];
    @endphp

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
        <!-- Primary Navigation Menu -->
        <div class="container">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <x-jet-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>

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
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="ml-3 relative">
                            <x-jet-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                            {{ Auth::user()->currentTeam->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Team Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-jet-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                                {{ __('Create New Team') }}
                                            </x-jet-dropdown-link>
                                        @endcan

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-jet-switchable-team :team="$team" />
                                        @endforeach
                                    </div>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    @endif

                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        @auth
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ Auth::user()->name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-jet-dropdown-link>

                                    @can('Admin')
                                        <x-jet-dropdown-link href="{{ route('admin.home') }}">
                                            Administrador
                                        </x-jet-dropdown-link>
                                    @endcan

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-jet-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-jet-dropdown>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endauth
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
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
            @auth
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex-shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-jet-responsive-nav-link>
                
                        @can('Admin')
                            <x-jet-responsive-nav-link href="{{ route('admin.home') }}" :active="request()->routeIs('admin.home')">
                                Administrador
                            </x-jet-responsive-nav-link>
                        @endcan  

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                {{ __('API Tokens') }}
                            </x-jet-responsive-nav-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                {{ __('Team Settings') }}
                            </x-jet-responsive-nav-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                    {{ __('Create New Team') }}
                                </x-jet-responsive-nav-link>
                            @endcan

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                            @endforeach
                        @endif
                    </div>
                </div>
            @else
                <div class="py-1 border-t border-gray-200">
                    <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        Login
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        Register
                    </x-jet-responsive-nav-link>
                </div>
            @endauth
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
                    <strong class="text-gray-300">Soluciones++</strong>, en donde un clic menos (-) importa!!!</p>
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
            <h1 class="text-center text-3xl text-gray-600">En Soluciones++</h1>
            <p class="text-center text-gray-500 text-sm mb-6">
                Trabajamos duro para seguir encontrando soluciones a tus aplicaciones web y de escritorio
            </p>
            <div class="container">
                {{-- CONTENIDO DE LA PÁGINA --}}
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8 py-4">
                    
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At voluptate, veritatis quidem non deleniti quam sint cum sequi alias minima, ad dolorem earum enim blanditiis inventore nobis et, atque temporibus!</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto officia recusandae pariatur expedita, corrupti reprehenderit nihil, maiores perferendis debitis rem cumque? Rem consequatur voluptates dolores et accusamus quasi laborum reprehenderit?</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut nam odio ducimus nihil aperiam totam, eveniet architecto neque ipsam blanditiis, nulla dolorem laborum iusto est cumque, eius qui quam voluptas!</p>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus officiis corporis magni doloremque expedita, dignissimos omnis eius velit unde. Rerum dolorem, exercitationem animi earum odit in nulla repudiandae necessitatibus cumque!</p>
                </div>
                <hr>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <h2 class="text-gray-600 text-center text-xl mb-6">CONTENIDO DE LA PÁGINA</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At voluptate, veritatis quidem non deleniti quam sint cum sequi alias minima, ad dolorem earum enim blanditiis inventore nobis et, atque temporibus!</p>
                </div>
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

## Implementación de roles y permisos
+ https://hackerthemes.com/bootstrap-cheatsheet
+ https://github.com/jeroennoten/Laravel-AdminLTE/wiki
1. Crear controlador para administrar roles:
    + $ php artisan make:controller Admin/RoleController -r
2. Definir los métodos del controlador **app\Http\Controllers\Admin\RoleController.php**:
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
3. Publicar vista de AdminLTE:
    + $ php artisan adminlte:install --only=main_views
    + **Nota**: En **resources\views\vendor\adminlte\page.blade.php** es de donde se extienden las plantillas.
4. Instalar Laravel Collective para hacer formularios:
    + $ composer require laravelcollective/html
    + [Documentación Laravel Collective](https://laravelcollective.com/docs/6.x/html)
5. Crear vistas del CRUD Role **resources\views\admin\roles\index.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Roles | Solucioens++')

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
    @stop

    @section('js')
    @stop
    ```
6. Crear vistas del CRUD Role **resources\views\admin\roles\create.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Crear rol | Soluciones++')

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
    @stop

    @section('js')
    @stop
    ```
7. Crear vistas del CRUD Role **resources\views\admin\roles\show.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Editar rol | Soluciones++')

    @section('content_header')
        <h1>Mostrar rol</h1>
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
    @stop

    @section('js')
    @stop
    ```
8. Crear vistas del CRUD Role **resources\views\admin\roles\edit.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Editar rol | Soluciones++')

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
    @stop

    @section('js')
    @stop
    ```
9. Crear formulario para el rol como **resources\views\admin\roles\partials\form.blade.php**:
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
10. Modificar el archivo de rutas **routes\admin.php**:
    ```php
    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\HomeController;
    use App\Http\Controllers\Admin\RoleController;
    use App\Http\Controllers\Admin\UserController;

    Route::get('', [HomeController::class, 'index'])->middleware('can:Admin')->name('home');

    Route::resource('roles', RoleController::class)->names('roles');

    Route::resource('users', UserController::class)->only(['index', 'edit', 'update'])->names('users');
    ```
11. Modificar el archivo de configuración **config\adminlte.php**:
    ```php
    <?php

    return [
        ≡
        'logo' => '<b>Soluciones++</b>',
        'logo_img' => 'assets/images/logo.png',
        ≡
        'logo_img_alt' => 'Logo Soluciones++',

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
        ],
        ≡
        'livewire' => true,
    ];
    ```
12. Crear controlador **User** para CRUD de usuarios:
    + $ php artisan make:controller Admin\UserController -r
13. Programar el controlador **app\Http\Controllers\Admin\UserController.php**:
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
14. Crear vistas del CRUD User **resources\views\admin\users\index.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'usuarios | Soluciones++')

    @section('content_header')
        <h1>Lista de usuarios</h1>
    @stop

    @section('content')
        @livewire('admin.users-index')
    @stop

    @section('css')
    @stop

    @section('js')
    @stop
    ```
15. Crear vistas del CRUD User **resources\views\admin\users\edit.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Editar usuario | Soluciones++')

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
    @stop

    @section('js')
    @stop
    ```
16. Crear componente de livewire para administrar usuarios:
    + $ php artisan make:livewire Admin/UsersIndex
17. Programar controlador del componente **app\Http\Livewire\Admin\UsersIndex.php**:
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
18. Diseñar vista del componente **resources\views\livewire\admin\users-index.blade.php**:
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
19. Crear el método **__construct** en el controlador **app\Http\Controllers\Admin\RoleController.php** para proteger las rutas **roles**:
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
20. Crear el método **__construct** en el controlador **app\Http\Controllers\Admin\UserController.php** para proteger las rutas **users**:
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
21. Crear commit:
    + $ git add .
    + $ git commit -m "Implementación de roles y permisos"
    + $ git push -u origin main

## Ajustes finales
1. Reemplazar el favicon de la aplicación por el de tu organización en **public\favicon.ico** y agregar el siguiente código dentro de la etiqueta heat de la plantilla **resources\views\layouts\app.blade.php**:
    ```php
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    ```
2. Colocar una imagen para la portada de la vista **documentacion** en formato png en **public\assets\images\documentacion\documentos.png**.
3. Crear vista **resources\views\documentacion.blade.php**:
    ```php
    <x-app-layout>
        <section class="bg-cover" style="background-image: url({{ asset('assets/images/documentacion/documentos.png') }})">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
                <div class="w-full md:w-3/4 lg:w-1/2">
                    <h1 class="text-white font-bold text-4xl">Paso a paso para la construcción del proyecto</h1>
                    <p class="text-white text-lg mt-2 mb-4">
                        <strong class="text-gray-300">Soluciones++</strong>, en donde un clic menos (-) importa!!!</p>
                </div>
            </div>
        </section>
        <section class="mt-10">
            <h1 class="text-gray-600 text-center text-3xl mb-6">PASO A PASO</h1>
            <p class="text-gray-600 text-center text-xl mb-6">
                Aplicación base para desarrollar cualquier aplicación que requiera de un sistema
                completo de roles y permisos.
            </p>
        </section>
        <section class="my-10">
            <div class="container">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <iframe
                        title="Inline Frame Example"
                        width="100%"
                        height="800"
                        src="{{ asset('paso-paso.html') }}">
                    </iframe>
                </div>
            </div>
        </section>
        {{-- <section class="my-24">
            <h1 class="text-center text-3xl text-gray-600">En Soluciones++</h1>
            <p class="text-center text-gray-500 text-sm mb-6">
                Trabajamos duro para seguir encontrando soluciones a tus aplicaciones web y de escritorio
            </p>
        </section> --}}
    </x-app-layout>
    ```
4. Agregar la ruta **documentos** en **routes\web.php**:
    ```php
    Route::view('documentos', 'documentacion')->name('documentacion');
    ```
5. Agregar el menú para ver la documentación en **resources\views\navigation-menu.blade.php**:
    ```php
    @php
        $nav_links = [
            ≡
            [
                'name' => 'Documentacion',
                'route' => route('documentacion'),
                'active' => request()->routeIs('documentacion')
            ]
        ];
    @endphp
    ≡
    ```
7. Crear commit:
    + $ git add .
    + $ git commit -m "Ajustes finales"
    + $ git push -u origin main

## Deploy del proyecto en Heroku
1. Crear en la raíz del proyecto el archivo **Procfile** (sin extensión) para elegir un servidor apache en Heroku y también indicarle la ubicación del archivo incial index.php:
    ```
    web: vendor/bin/heroku-php-apache2 public/
    ```
2. Ingresar a [Heroku](https://dashboard.heroku.com/apps) e ir a **Dashboard**.
3. Crear un nuevo proyecto en **New > Create new app**
    + Nombre: **laravel-permission-2021**
4. Ir a Deploy y dar clic en GitHub.
5. Clic en el botón Connect to GitHub e ingresar las credenciales.
6. Seleccionar el repositorio **laravel-permission2021** y presionar el botón **Connect**.
7. Para tener siempre la ultima actualización de nuestro proyecto se recomienda presionar el botón **Enable Automatic Deploys**.
8. Presionar el botón Deploy Branch.
9. Descargar e instalar [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli).
10. En la terminal en la raíz del proyecto en local e iniciar sesión en Heroku:
    + $ heroku login
11. Víncular con la aplicación de Heroku **laravel-permission-2021**:
    + $ git remote add heroku git.heroku.com/laravel-permission-2021.git
        + (git remote set-url Origin git.heroku.com/laravel-permission-2021.git)
    + $ heroku git:remote -a laravel-permission-2021
12. Registrar variables de entorno de la aplicación desde la terminal:
    + $ heroku config:add APP_NAME="Sistema de Roles y Permisos"
    + $ heroku config:add APP_ENV=production
    + $ heroku config:add APP_KEY=base64:JeN4tGolfHwFl2gMIDXbWcfdmkLypUx0dlFAQl3XC8Y=
    + $ heroku config:add APP_DEBUG=false
    + $ heroku config:add APP_URL=https://laravel-permission-2021.herokuapp.com
13. Crear base de datos Postgre SQL desde la terminal:
    + $ heroku addons:create heroku-postgresql:hobby-dev
    + $ heroku pg:credentials:url
    + **Nota**: la salida de la última línea de comando nos servirá para configurar las variables de entorno de la base de datos:
    ```
    Connection information for default credential.
    Connection info string:
    "dbname=*** host=*** port=*** user=*** password=*** sslmode=require"
    Connection URL:
    postgres://mmtmzssdyxkfyt:9336263e704b06d0a1ba7c979c426e7d8eb77f3958e4114cea9a21973ba08d84@ec2-35-168-145-180.compute-1.amazonaws.com:5432/dbhkpp3vfen6vd
    ```
14. Registrar variables de entorno de la base de datos desde la terminal:
    + $ heroku config:add DB_CONNECTION=pgsql
    + $ heroku config:add DB_HOST=ec2-18-235-4-83.compute-1.amazonaws.com
    + $ heroku config:add DB_PORT=5432
    + $ heroku config:add DB_DATABASE=db6unq9m90dvkv
    + $ heroku config:add DB_USERNAME=vcsyvufmsdpbhn
    + $ heroku config:add DB_PASSWORD=******
15. Ejecutar migraciones:
    + $ heroku run bash
    + ~ $ php artisan migrate --seed
        + Do you really wish to run this command? (yes/no) [no]: **yes**
    + ~ $ exit
16. Salir de Heroku:
    + $ heroku logout
17. Desconectar con repositorio Heroku:
    + $ git remote rm heroku