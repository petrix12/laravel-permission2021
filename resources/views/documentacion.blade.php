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