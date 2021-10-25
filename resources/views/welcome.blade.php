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