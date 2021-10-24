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

## Generaración de datos de prueba:
1. Creación de factories:
    + $ php artisan make:factory CourseFactory
    + $ php artisan make:factory ImageFactory
    + $ php artisan make:factory RequerimentFactory
    + $ php artisan make:factory GoalFactory
    + $ php artisan make:factory AudienceFactory
    + $ php artisan make:factory SectionFactory
    + $ php artisan make:factory DescriptionFactory
    + $ php artisan make:factory LessonFactory
    + $ php artisan make:factory ReviewFactory
2. Programar el método **definition** del factory **CourseFactory**:
    ```php
    public function definition()
    {
        $title = $this->faker->sentence();

        return [
            'title' => $title,
            'subtitle' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement([Course::BORRADOR, Course::REVISION, Course::PUBLICADO]),
            'slug' => Str::slug($title),
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'level_id' => Level::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'price_id' => Price::all()->random()->id,
        ];
    }
    ```
    + Importar la definición de las clases:
    ```php
    use App\Models\Category;
    use App\Models\Course;
    use App\Models\Level;
    use App\Models\Price;
    use Illuminate\Support\Str;
    ```
3. Programar el método **definition** del factory **ImageFactory**:
    ```php
    public function definition()
    {
        return [
            'url' => 'courses/' . $this->faker->image('public/storage/courses', 640, 480, null, false)
        ];
    }
    ```
4. Programar el método **definition** del factory **RequerimentFactory**:
    ```php
    public function definition()
    {
        return [
            'name' => $this->faker->sentence()
        ];
    }
    ```
5. Programar el método **definition** del factory **GoalFactory**:
    ```php
    public function definition()
    {
        return [
            'name' => $this->faker->sentence()
        ];
    }
    ```
6. Programar el método **definition** del factory **AudienceFactory**:
    ```php
    public function definition()
    {
        return [
            'name' => $this->faker->sentence()
        ];
    }
    ```
7. Programar el método **definition** del factory **SectionFactory**:
    ```php
    public function definition()
    {
        return [
            'name' => $this->faker->sentence()
        ];
    }
    ```
8. Programar el método **definition** del factory **DescriptionFactory**:
    ```php
    public function definition()
    {
        return [
            'name' => $this->faker->paragraph()
        ];
    }
    ```
9. Programar el método **definition** del factory **LessonFactory**:
    ```php
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'url' => 'https://youtu.be/DgDxAzbkOSs',
            'iframe' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/DgDxAzbkOSs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            'platform_id' => 1
        ];
    }
    ```
10. Programar el método **definition** del factory **ReviewFactory**:
    ```php
    public function definition()
    {
        return [
            'comment' => $this->faker->text(),
            'rating' => $this->faker->randomElement([3, 4, 5]),
            'user_id' => User::all()->random()->id
        ];
    }
    ```
    + Importar la definición del modelo User:
    ```php
    use App\Models\User;
    ```
11. Creación de seeders:
    + $ php artisan make:seeder UserSeeder
    + $ php artisan make:seeder LevelSeeder
    + $ php artisan make:seeder CategorySeeder
    + $ php artisan make:seeder PriceSeeder
    + $ php artisan make:seeder CourseSeeder
    + $ php artisan make:seeder PlatformSeeder
    + $ php artisan make:seeder RoleSeeder
    + $ php artisan make:seeder PermissionSeeder
12. Programar método **run** del seeder **UserSeeder**:
    ```php
    public function run()
    {
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
13. Programar método **run** del seeder **LevelSeeder**:
    ```php
    public function run()
    {
        Level::create([
            'name' => 'Nivel básico'
        ]);

        Level::create([
            'name' => 'Nivel intermedio'
        ]);

        Level::create([
            'name' => 'Nivel avanzado'
        ]);
    }
    ```
    + Importar la definición del modelo **Level**:
    ```php
    use App\Models\Level;
    ```
14. Programar método **run** del seeder **CategorySeeder**:
    ```php
    public function run()
    {
        Category::create([
            'name' => 'Genealogía'
        ]);

        Category::create([
            'name' => 'Bibliotecología'
        ]);

        Category::create([
            'name' => 'Gerencial'
        ]);

        Category::create([
            'name' => 'Sistemas'
        ]);

        Category::create([
            'name' => 'Ventas'
        ]);

        Category::create([
            'name' => 'Atención al cliente'
        ]);

        Category::create([
            'name' => 'Herramienta informática'
        ]);
    }
    ```
    + Importar la definición del modelo **Category**:
    ```php
    use App\Models\Category;
    ```
15. Programar método **run** del seeder **PriceSeeder**:
    ```php
    public function run()
    {
        Price::create([
            'name' => 'Gratis',
            'value' => 0
        ]);

        Price::create([
            'name' => '19.99 US$ (nivel 1)',
            'value' => 19.99
        ]);

        Price::create([
            'name' => '49.99 US$ (nivel 2)',
            'value' => 49.99
        ]);

        Price::create([
            'name' => '99.99 US$ (nivel 2)',
            'value' => 99.99
        ]);
    }
    ```
    + Importar la definición del modelo **Price**:
    ```php
    use App\Models\Price;
    ```
16. Programar método **run** del seeder **CourseSeeder**:
    ```php
    public function run()
    {
        $courses = Course::factory(100)->create();

        foreach ($courses as $course) {
            Review::factory(5)->create([
                'course_id' => $course->id
            ]);
            Image::factory(1)->create([
                'imageable_id' => $course->id,
                'imageable_type' => 'App\Models\Course'
            ]);

            Requeriment::factory(4)->create([
                'course_id' => $course->id
            ]);

            Goal::factory(4)->create([
                'course_id' => $course->id
            ]);

            Audience::factory(4)->create([
                'course_id' => $course->id
            ]);

            $sections = Section::factory(4)->create(['course_id' => $course->id]);

            foreach ($sections as $section) {
                $lessons = Lesson::factory(4)->create(['section_id' => $section->id]);

                foreach ($lessons as $lesson) {
                    Description::factory(1)->create(['lesson_id' => $lesson->id]);
                }
            }
        }
    }
    ```
    + Importar las siguientes definiciones de clases:
    ```php
    use App\Models\Audience;
    use App\Models\Course;
    use App\Models\Description;
    use App\Models\Goal;
    use App\Models\Image;
    use App\Models\Lesson;
    use App\Models\Requeriment;
    use App\Models\Review;
    use App\Models\Section;
    ```
17. Programar método **run** del seeder **PlatformSeeder**:
    ```php
    public function run()
    {
        Platform::create([
            'name' => 'Youtube'
        ]);

        Platform::create([
            'name' => 'Vimeo'
        ]);
    }
    ```
    + Importar la definición del modelo **Platform**:
    ```php
    use App\Models\Platform;
    ```
18. Programar método **run** del seeder **RoleSeeder**:
    ```php
    public function run()
    {
        $role = Role::create(['name' => 'Admin']);
        $role->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);

        $role = Role::create(['name' => 'Instructor']);
        $role->syncPermissions(['Crear cursos', 'Leer cursos', 'Actualizar cursos', 'Eliminar cursos']);
    }
    ```
    + Importar la definición del modelo **Role**:
    ```php
    use Spatie\Permission\Models\Role;
    ```
19. Programar método **run** del seeder **PermissionSeeder**:
    ```php
    public function run()
    {
        Permission::create(['name' => 'Crear cursos']);
        Permission::create(['name' => 'Leer cursos']);
        Permission::create(['name' => 'Actualizar cursos']);
        Permission::create(['name' => 'Eliminar cursos']);
        Permission::create(['name' => 'Ver dashboard']);
        Permission::create(['name' => 'Crear role']);
        Permission::create(['name' => 'Listar role']);
        Permission::create(['name' => 'Editar role']);
        Permission::create(['name' => 'Eliminar role']);
        Permission::create(['name' => 'Leer usuarios']);
        Permission::create(['name' => 'Editar usuarios']);
    }
    ```
    + Importar la definición del modelo **Permission**:
    ```php
    use Spatie\Permission\Models\Permission;
    ```
20. Programar método **run** del seeder **DatabaseSeeder**:
    ```php
    public function run()
    {
        Storage::deleteDirectory('courses');
        Storage::makeDirectory('courses');
        
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PriceSeeder::class);
        $this->call(PlatformSeeder::class);
        $this->call(CourseSeeder::class);
    }
    ```
    + Importar la definición del facade **Storage**:
    ```php
    use Illuminate\Support\Facades\Storage;
    ```
21. Generar enlace a almacenamiento:
    + $ php artisan storage:link
22. Restablecer la base de datos y ejecutar los seeders:
    + $ php artisan migrate:fresh --seed
23. Crear commit:
    + $ git add .
    + $ git commit -m "Generaración de datos de prueba"
    + $ git push -u origin main

## Integración de plantilla AdminLTE
+ [Laravel AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE)
+ [Plantilla AdminLTE](https://adminlte.io/themes/v3/index.html)
1. Modificar el provider **app\Providers\RouteServiceProvider.php**:
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
2. Crear archivo de rutas **routes\admin.php**:
    ```php
    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\HomeController;

    Route::get('',[HomeController::class, 'index']);
    ```    
3. Crear contralador **HomeController** para administrador:
    + $ php artisan make:controller Admin\HomeController
4. Definir el método **index** en el controlador **HomeController**:
    ```php
    public function index(){
        return view('admin.index');
    }
    ```
5. Diseñar vista para pruebas **resources\views\admin\index.blade.php**:
    ```php
    @extends('adminlte::page')

    @section('title', 'Cursos Sefar Universal')

    @section('content_header')
        <h1>Cursos Sefar Universal</h1>
    @stop

    @section('content')
        <p>Cursos Sefar Universal</p>
    @stop

    @section('css')
        <link rel="stylesheet" href="#">
    @stop

    @section('js')

    @stop
    ```
6. Instalar AdminLTE: 
	+ $ composer require jeroennoten/laravel-adminlte
    + $ php artisan adminlte:install
7. Crear commit:
    + $ git add .
    + $ git commit -m "Integración de plantilla AdminLTE"
    + $ git push -u origin main

## Personalización inicial de la aplicación:
+ [Laravel Jetstream](https://jetstream.laravel.com/2.x/introduction.html)
1. Modificar plantilla **resources\views\layouts\app.blade.php**:
    ```php
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            ≡
            <title>{{ config('app.name', 'App Cursos Sefar') }}</title>
            ≡
        </head>
        <body class="font-sans antialiased">
            <x-jet-banner />

            <div class="min-h-screen bg-gray-100">
                @livewire('navigation-menu')

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>

            @stack('modals')

            @livewireScripts
        </body>
    </html>
    ```
2. Modificar plantilla **resources\views\navigation-menu.blade.php**:
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
3. Publicar componentes de Jetstream:
    + $ php artisan vendor:publish --tag=jetstream-views
    + **Importante**: todos los componentes de Jetstream se copiaran a **resources\views\vendor\jetstream\components**
4. Modificar archivo de rutas **routes\web.php**:
    ```php
    <?php

    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    ```
5. Modificar vista **resources\views\welcome.blade.php**:
    ```php
    <x-app-layout>
        
    </x-app-layout>
    ```
6. Almacenar el logo y el logo completo de la empresa respectivamente en:
    + public\images\logo.png
    + public\images\logo-completo.png
7. Modificar componente de Jetstream **resources\views\vendor\jetstream\components\application-logo.blade.php**:
    ```php
    <img src="{{ asset('images/logo-completo.png') }}" alt="Logo Sefar Universal" width="120">
    ```
8. Modificar componente de Jetstream **resources\views\vendor\jetstream\components\application-mark.blade.php**:
    ```php
    <img src="{{ asset('images/logo.png') }}" alt="Logo Sefar Universal" width="48">
    ```
9. Modificar componente de Jetstream **resources\views\vendor\jetstream\components\authentication-card-logo.blade.php**:
    ```php
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Sefar Universal" width="100">
    </a>
    ```
10. Modificar componente de Jetstream **resources\views\vendor\jetstream\components\button.blade.php**:
    ```php
    <style>
        button {
            background-color:rgb(121,22,15) !important;
        }
        button:hover {
            background-color:rgb(204, 98, 90) !important;
            color:rgb(0, 0, 0) !important;
        }
    </style>
    <button {{ $attributes->merge([
            'type' => 'submit', 
            'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition']) 
        }}" >
        {{ $slot }}
    </button>
    ```
11. Crear commit:
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
1. Crear contraolador **HomeController**:
    + $ php artisan make:controller HomeController
2. Definir método **__invoke** en el controlador **app\Http\Controllers\HomeController.php**:
    ```php
    public function __invoke()
    {
        $courses = Course::where('status','3')->latest()->get()->take(12);
        return view('welcome', compact('courses'));
    }
    ```
    + Importar la definción del modelo **Course**:
    ```php
    use App\Models\Course;
    ```
3. Redefinir ruta raíz y crear las ruta para obtener los cursos, para matricularse y control de avance del usuario en **routes\web.php**:
    ```php
    Route::get('/', HomeController::class)->name('home');

    Route::get('cursos', [CourseController::class, 'index'])->name('courses.index');
    Route::get('cursos/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::post('courses/{course}/enrolled', [CourseController::class, 'enrolled'])->middleware('auth')->name('courses.enrolled');
    
    Route::get('course-status/{course}', function ($course) {
        return "Aquí vas a poder llevar el control de tu avence";
    })->name('courses.status');
    ```
    + Importar la definción de los controladores **CourseController** y **HomeController**:
    ```php
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\HomeController; 
    ```
4. Crear controlador **CourseController**:
    + $ php artisan make:controller CourseController       
5. Programar el controlador **app\Http\Controllers\CourseController.php**:
    ```php
    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Course;

    class CourseController extends Controller
    {
        public function index(){
            return view('courses.index');
        }

        public function show(Course $course){
            $this->authorize('published', $course);

            $similares = Course::where('category_id', $course->category_id)
                            ->where('id','!=',$course->id)
                            ->where('status', 3)
                            ->latest('id')
                            ->take(5)
                            ->get();
            return view('courses.show',compact('course', 'similares'));
        }

        public function enrolled(Course $course){
            // Agrega un registro a la tabla intermedia course_user
            $course->students()->attach(auth()->user()->id);
            return redirect()->route('courses.status', $course);
        }
    }
    ```
6. Modificar modelo **Course**:
    ```php
    ≡
    class Course extends Model
    {
        ≡
        protected $guarded = ['id', 'status'];

        protected $withCount = ['students', 'reviews'];

        const BORRADOR = 1;
        const REVISION = 2;
        const PUBLICADO = 3;

        public function getRatingAttribute(){
            if($this->reviews_count){
                return round($this->reviews->avg('rating'), 1);
            }else{
                return 5;
            }
        }

        public function getRouteKeyName(){
            return "slug";
        }

        // Query scope Category
        public function scopeCategory($query, $category_id){
            if($category_id){
                return $query->where('category_id', $category_id);
            }
        }

        // Query scope Level
        public function scopeLevel($query, $level_id){
            if($level_id){
                return $query->where('level_id', $level_id);
            }
        }
        ≡
    }
    ```
7. Guardar imagenes de portada del proyecto en:
    + public\images\home\img_portada.jpg
    + public\images\cursos\img_cursos.jpg
    + [Optimizador de imagen](https://tinypng.com)
8. Ubicar 4 imagenes (640 x 426) relacionadas con los cursos de Sefar y guardarlas en **public\images\home** con los nombres:
    + imagen_1.png
    + imagen_2.png
    + imagen_3.png
    + imagen_4.png
9. Rediseñar la vista **resources\views\welcome.blade.php**:
    ```php
    <x-app-layout>
        <section class="bg-cover" style="background-image: url({{ asset('images/home/img_portada.jpg') }})">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
                <div class="w-full md:w-3/4 lg:w-1/2">
                    <h1 class="ctrSefar font-bold text-4xl">Domina la ciencia de los estudios genealógicos con Sefar Universal</h1>
                    <p class="ctvSefar text-lg mt-2 mb-4">En Sefar Universal encontrarás cursos, manuales y artículos que te ayudarán a convertirte en un profesional de la genealogía</p>
                    <!-- component extraido de https://tailwindcomponents.com/component/search-bar -->
                    @livewire('search')
                </div>
            </div>
        </section>
        <section class="mt-24">
            <h1 class="text-gray-600 text-center text-3xl mb-6">CONTENIDO</h1>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
                <article>
                    <figure>
                        <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('images/home/imagen_1.png') }}" alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700">Cursos y proyectos</h1>
                    </header>
                    <p class="text-sm text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, possimus accusantium</p>
                </article>
                <article>
                    <figure>
                        <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('images/home/imagen_2.png') }}" alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700">Biblioteca digital</h1>
                    </header>
                    <p class="text-sm text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, possimus accusantium</p>
                </article>
                <article>
                    <figure>
                        <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('images/home/imagen_3.png') }}" alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700">Blog</h1>
                    </header>
                    <p class="text-sm text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, possimus accusantium</p>
                </article>
                <article>
                    <figure>
                        <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('images/home/imagen_4.png') }}" alt="">
                    </figure>
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700">Desarrollo genealógico</h1>
                    </header>
                    <p class="text-sm text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, possimus accusantium</p>
                </article>
            </div>
        </section>
        <section class="mt-24 cfvSefar py-12">
            <h1 class="text-center text-white text-3xl">¿No sabes qué curso llevar?</h1>
            <p class="text-center text-white">Dirígete al catálogo de cursos y filtralos por categoría o nivel</p>
            <div class="flex justify-center mt-4">
                <!-- https://v1.tailwindcss.com/components/buttons -->
                <a href="{{ route('courses.index') }}" class="cfrSefar text-white font-bold py-2 px-4 rounded">
                    Catálogo de cursos
                </a>
            </div>
        </section>
        <section class="my-24">
            <h1 class="text-center text-3xl text-gray-600">ÚLTIMOS CURSOS</h1>
            <p class="text-center text-gray-500 text-sm mb-6">Trabajamos duro para seguir subiendo cursos</p>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($courses as $course)
                    <x-course-card :course="$course"/>
                @endforeach
            </div>
        </section>
    </x-app-layout>
    ```
10. Crear la vista **resources\views\courses\index.blade.php**:
    ```php
    <x-app-layout>
        <section class="bg-cover" style="background-image: url({{ asset('images/cursos/img_cursos.jpg') }})">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
                <div class="w-full md:w-3/4 lg:w-1/2">
                    <h1 class="ctvSefar font-bold text-4xl">Los mejores cursos de genealogía ¡A LOS MEJORES PRECIOS! y en español.</h1>
                    <p class="ctrSefar text-lg mt-2 mb-4">Si estás buscando potenciar tus conocimientos de genealogía, has llegado al lugar adecuado. Encuentra cursos y proyectos que te ayudarán en ese proceso</p>
                    <!-- component extraido de https://tailwindcomponents.com/component/search-bar -->
                    @livewire('search')
                </div>
            </div>
        </section>
        @livewire('courses-index')
    </x-app-layout>
    ```
11. Crear archivo de estilos **public\css\sefar.css**:
    ```css
    /* Color de fondo rojo Sefar */
    .cfrSefar{
        background-color:rgb(121,22,15) !important;
    }

    .cfrSefar:hover{
        background-color:rgb(204, 98, 90) !important;
        color:rgb(0, 0, 0) !important;
    }

    /* Color de fondo amarillo Sefar */
    .cfaSefar{
        background-color:rgb(247,176,52) !important;
    }

    /* Color de fondo verde Sefar */
    .cfvSefar{
        background-color:rgb(22,43,27) !important;
    }

    /* Color de fondo blanco */
    .cfBlanco{
        background-color:white !important;
    }

    /* Color de fondo gris Sefar */
    .cfgSefar{
        background-color:rgb(63,61,61) !important;
    }

    /* Color de texto rojo Sefar */
    .ctrSefar{
        color:rgb(121,22,15) !important;
    }

    /* Color de texto amarillo Sefar */
    .ctaSefar{
        color:rgb(247,176,52) !important;
    }

    /* Color de texto verde Sefar */
    .ctvSefar{
        color:rgb(22,43,27) !important;
    }

    /* Color de texto gris Sefar */
    .ctgSefar{
        color:rgb(63,61,61) !important;
    }

    /* Color de texto blanco */
    .ctBlanco{
        color:white !important;
    }
    ```
12. Importar los estilos propios y de **fontawesome-free** en **resources\views\layouts\app.blade.php**:
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
13. Crear componente livewire **Search**:
    + $ php artisan make:livewire Search
14. Diseñar vista del componente **Search** en **resources\views\livewire\search.blade.php**:
    ```php
    <form class="pt-2 relative mx-auto text-gray-600" autocomplete="off">
        <input wire:model="search" class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
        type="search" name="search" placeholder="Search">
        <!-- extraido de https://v1.tailwindcss.com/components/buttons -->
        <button type="submit" class="cfrSefar text-white font-bold py-2 px-4 rounded absolute right-0 top-0 mt-2">
            Buscar
        </button>
        <ul class="absolute z-50 left-0 w-full bg-white mt-1 rounded-lg overflow-hidden">
            @if ($search)
                @forelse ($this->results as $result)
                    <li class="leading-10 px-5 text-sm cursor-pointer hover:bg-gray-300">
                        <a href="{{ route('courses.show', $result) }}">{{ $result->title }}</a>
                    </li>
                @empty
                    <li class="leading-10 px-5 text-sm cursor-pointer hover:bg-gray-300">
                        No hay ninguna coincidencia :(
                    </li>
                @endforelse
            @endif
        </ul>
    </form>
    ```
15. Programar el controlador del componente **Search** en **app\Http\Livewire\Search.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use App\Models\Course;
    use Livewire\Component;

    class Search extends Component
    {
        public $search;

        public function render()
        {
            return view('livewire.search');
        }

        // Esta función es una propiedad computada: get[Results]Property
        // Se le invoca desde la vista como $this->results
        public function getResultsProperty(){
            return Course::where('title', 'LIKE', '%' . $this->search . '%')
                    ->where('status',3)
                    ->take(8)
                    ->get();
        }
    }
    ```
16. Crear componente de Blade **resources\views\components\course-card.blade.php** para los cursos:
    ```php
    @props(['course'])

    <article class="card flex flex-col">
        <img class="h-36 w-full object-cover" src="{{ Storage::url($course->image->url) }}" alt="">
        <div class="card-body flex-1 flex flex-col">
            <h1 class="card-title">{{ Str::limit($course->title, 40) }}</h1>
            <p class="text-gray-500 text-sm mb-2 mt-auto">Prof. {{ $course->teacher->name }}</p>
            <div class="flex">
                <ul class="flex text-sm">
                    <li class="mr-1">
                        <i class="fas fa-star text-{{ $course->rating >= 1 ? 'yellow' : 'gray' }}-400"></i>
                    </li>
                    <li class="mr-1">
                        <i class="fas fa-star text-{{ $course->rating >= 2 ? 'yellow' : 'gray' }}-400"></i>
                    </li>
                    <li class="mr-1">
                        <i class="fas fa-star text-{{ $course->rating >= 3 ? 'yellow' : 'gray' }}-400"></i>
                    </li>
                    <li class="mr-1">
                        <i class="fas fa-star text-{{ $course->rating >= 4 ? 'yellow' : 'gray' }}-400"></i>
                    </li>
                    <li class="mr-1">
                        <i class="fas fa-star text-{{ $course->rating == 5 ? 'yellow' : 'gray' }}-400"></i>
                    </li>
                </ul>
                <p class="text-sm text-gray-500 ml-auto">
                    <i class="fas fa-users"></i>
                    ({{ $course->students_count }})
                </p>
            </div>
            @if ($course->price->value == 0)
                <p class="my-2 text-green-700 font-bold">GRATIS</p>
            @else
                <p class="my-2 text-gray-500 font-bold">US$ {{ $course->price->value }}</p>
            @endif
            <a href="{{ route('courses.show', $course) }}" class="btn btn-primary btn-block">
                Mas información
            </a>
        </div>
    </article>
    ```
17. Crear componente de livewire para mostrar reseñas:
    + $ php artisan make:livewire CoursesReviews
18. Crear vista **resources\views\courses\show.blade.php**:
    ```php
    <x-app-layout>
        <section class="cfvSefar py-12 mb-12">
            <div class="container grid grid-cols-1 lg:grid-cols-2 gap-6">
                <figure>
                    <img class="h-60 w-full object-cover" src="{{ Storage::url($course->image->url )}}" alt="">
                </figure>
                <div class="text-white">
                    <h1 class="text-4xl">{{ $course->title }}</h1>
                    <h2 class="text-xl mb-3">{{ $course->subtitle }}</h2>
                    <p class="mb-2"><i class="fas fa-chart-line"></i> Nivel: {{ $course->level->name }}</p>
                    <p class="mb-2"><i class="fas fa-globe"></i> Categoría: {{ $course->category->name }}</p>
                    <p class="mb-2"><i class="fas fa-users"></i> Matriculados: {{ $course->students_count }}</p>
                    <p><i class="far fa-star"></i> Calificación: {{ $course->rating }}</p>
                </div>
            </div>
        </section>

        <div class="container grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="order-2 lg:col-span-2 lg:order-1">
                <section class="card mb-12">
                    <div class="card-body">
                        <h1 class="font-bold text-2xl mb-2">Lo que aprenderás</h1>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                            @foreach ($course->goals as $goal)
                                <li class="text-gray-700 text-base"><i class="fas fa-check text-gray-600 mr-2"></i> {{ $goal->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <section class="mb-12">
                    <h1 class="font-bold text-3xl mb-2">Temario</h1>
                    @foreach ($course->sections as $section)
                        <article class="mb-4 shadow" 
                        @if ($loop->first)
                        x-data="{ open: true }"
                        @else
                        x-data="{ open: false }"    
                        @endif>
                            <header class="border border-gray-200 px-4 py-2 cursor-pointer bg-gray-200" x-on:click="open = !open">
                                <h1 class="font-bold text-lg text-gray-600">{{ $section->name }}</h1>
                            </header>
                            <div class="bg-white py-2 px-4" x-show="open">
                                <ul class="grid grid-cols-1 gap-2">
                                    @foreach ($section->lessons as $lesson)
                                        <li class="text-gray-700 text-base"><i class="fas fa-play-circle mr-2 text-gray-600"></i> {{ $lesson->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                    @endforeach
                </section>
                <section>
                    <h1 class="font-bold text-3xl text-gray-800">Requisitos</h1>
                    <ul class="list-disc list-inside">
                        @foreach ($course->requirements as $requirement)
                            <li class="text-gray-700">{{ $requirement->name }}</li>
                        @endforeach
                    </ul>
                </section>
                <section>
                    <h1 class="font-bold text-3xl text-gray-800">Descripción</h1>
                    <div class="text-gray-700 text-base">
                        {!! $course->description !!}
                    </div>
                </section>
                @livewire('courses-reviews', ['course' => $course])
            </div>
            <div class="order-1 lg:order-2">
                <section class="card mb-4">
                    <div class="card-body">
                        <div class="flex items-center">
                            <img class="h-12 w-12 object-cover rounded-full shadow-lg" src="{{ $course->teacher->profile_photo_url }}" alt="{{ $course->teacher->name }}">
                            <div class="ml-4">
                                <h1 class="font-bold text-gray-500 text-lg">Prof. {{ $course->teacher->name }}</h1>
                                <a class="text-blue-400 text-sm font-bold" href="">{{ '@' . Str::slug($course->teacher->name, '') }}</a>
                            </div>
                        </div>
                        @can('enrolled', $course)
                            <a class="btn btn-danger btn-block mt-4" href="{{ route('courses.status', $course) }}">Continuar con curso</a>
                        @else
                            @if ($course->price->value == 0)
                                <p class="text-2xl font-bold text-gray-500 mt-3 mb-2">GRATIS</p>
                                <form action="{{ route('courses.enrolled', $course) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-block" type="submit">Llevar este curso</button>
                                </form>
                            @else
                                <p class="text-2xl font-bold text-gray-500 mt-3 mb-2">US$ {{ $course->price->value }}</p>
                                <a href="#" class="btn btn-danger btn-block">Comprar este curso</a>
                            @endif
                        @endcan
                    </div>
                </section>
                <aside class="hidden lg:block">
                    @foreach ($similares as $similar)
                        <article class="flex mb-6">
                            <img class="h-32 w-40 object-cover" src="{{ Storage::url($similar->image->url) }}" alt="">
                            <div class="ml-3">
                                <h1>
                                    <a class="font-bold text-gray-500 mb-3" href="{{ route('courses.show', $similar) }}">{{ Str::limit($similar->title, 40) }}</a>
                                </h1>
                                <div class="flex items-center mb-2">
                                    <img class="h-8 w-8 object-cover rounded-full shadow-lg" src="{{ $similar->teacher->profile_photo_url }}" alt="">
                                    <p class="text-gray-700 text-sm ml-2">{{ $similar->teacher->name  }}</p>
                                </div>
                                <p class="text-sm"><i class="fas fa-star mr-2 text-yellow-400"></i>{{ $similar->rating }}</p>
                            </div>
                        </article>
                    @endforeach
                </aside>
            </div>
        </div>
    </x-app-layout>
    ```
19. Modificar la plantilla **resources\views\navigation-menu.blade.php**:
    ```php
    @php
        $nav_links = [
            [
                'name' => 'Home',
                'route' => route('home'),
                'active' => request()->routeIs('home')
            ],
            [
                'name' => 'Cursos',
                'route' => route('courses.index'),
                'active' => request()->routeIs('courses.*')
            ],
        ];
    @endphp
    ≡
    ```
20. Crear componente de livewire **CoursesIndex**:
    + $ php artisan make:livewire CoursesIndex
21. Modificar componente livewire **resources\views\livewire\courses-index.blade.php**:
    ```php
    <div>
        <div class="bg-gray-200 mb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex">
                <button class="focus:outline-none bg-white shadow h-12 px-4 rounded-lg text-gray-700 mr-4" wire:click="resetFilters">
                    <i class="fas fa-archway text-xs mr-2"></i>
                    Todos los cursos
                </button>
                
                <!-- Dropdown Categoria -->
                <div class="relative mr-4" x-data="{ open: false }">
                    <button class="px-4 text-gray-700 block h-12 rounded-lg overflow-hidden focus:outline-none bg-white shadow" x-on:click="open = true">
                        <i class="fas fa-tags text-sm mr-2"></i>
                        Categoria
                        <i class="fas fa-angle-down text-sm ml-2"></i>
                    </button>
                    <div class="absolute right-0 w-40 mt-2 py-2 bg-white border rounded shadow-xl" x-show="open" x-on:click.away="open = false">
                        @foreach ($categories as $category)
                        <a class="cursor-pointer transition-colors duration-200 block px-4 py-2 text-normal text-gray-900 rounded hover:bg-blue-500 hover:text-white" wire:click="$set('category_id',{{ $category->id }})" x-on:click="open = false">{{ $category->name }}</a>
                        @endforeach
                    </div> 
                </div>
                
                <!-- Dropdown Niveles -->
                <div class="relative" x-data="{ open: false }">
                    <button class="px-4 text-gray-700 block h-12 rounded-lg overflow-hidden focus:outline-none bg-white shadow" x-on:click="open = true">
                        <i class="fas fa-layer-group text-sm mr-2"></i>
                        Niveles
                        <i class="fas fa-angle-down text-sm ml-2"></i>
                    </button>
                    <div class="absolute right-0 w-40 mt-2 py-2 bg-white border rounded shadow-xl" x-show="open" x-on:click.away="open = false">
                        @foreach ($levels as $level)
                        <a class="cursor-pointer transition-colors duration-200 block px-4 py-2 text-normal text-gray-900 rounded hover:bg-blue-500 hover:text-white" wire:click="$set('level_id',{{ $level->id }})" x-on:click="open = false">{{ $level->name }}</a>
                        @endforeach
                    </div> 
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
            @foreach ($courses as $course)
                <x-course-card :course="$course"/>
            @endforeach
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 mb-8">
            {{ $courses->links() }}
        </div>
    </div>
    ```
22. Modificar el controlador **app\Http\Livewire\CoursesIndex.php**:
    ```php
    <?php

    namespace App\Http\Livewire;

    use App\Models\Category;
    use App\Models\Course;
    use App\Models\Level;
    use Livewire\Component;
    use Livewire\WithPagination;

    class CoursesIndex extends Component
    {
        use WithPagination;
        
        public $category_id;
        public $level_id;

        public function render()
        {
            $categories = Category::all();
            $levels = Level::all();
            $courses = Course::where('status', 3)
                ->category($this->category_id)
                ->level($this->level_id)
                ->latest('id')
                ->paginate(8);
            return view('livewire.courses-index', compact('courses', 'categories', 'levels'));
        }

        public function resetFilters(){
            $this->reset(['category_id','level_id']);
        }
    }
    ```
23. Deshabilitar la clase container de tailwind en **tailwind.config.js**:
    ```js
    module.exports = {
        ≡
        corePlugins: {
            // ...
        container: false,
        },

        plugins: [require('@tailwindcss/ui')],
    };
    ```      
24. Crear archivo de **estilos resources\css\commom.css**:
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
25. Crear archivo de **resources\css\buttons.css**
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
27. Importar **resources\css\commom.css** en **resources\css\app.css**:
    ```php
    ≡
    @import 'commom.css';
    @import 'buttons.css';
    ```
28. Compilar los nuevos estilos:
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
29. En la plantilla **resources\views\navigation-menu.blade.php**:
    Cambiars:
    ```php
    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
    ```
    Por:
    ```php
    class="container"
    ```
30. Crear políticas de acceso a llevar curso o continuar curso:
    + $ php artisan make:policy CoursePolicy
31. Crear método **enrolled** a la política **app\Policies\CoursePolicy.php**:
    ```php
    public function enrolled(User $user, Course $course){
        return $course->students->contains($user->id);
    }
    ```
    + Importar la definición del modelo **Course**:
    ```php
    use App\Models\Course;
    ```
32. Crear commit:
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