<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm xs:rounded-lg rounded-md">
                <div class="p-6 text-gray-900">
                    <p>Bienvenido a la página principal. Llistdado de 5 museos random. Los 2 primeros son siempre fijos.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid xs:grid-cols-1 xl:grid-cols-5 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($museums as $museum)
                <div class="bg-white overflow-hidden shadow-sm xs:rounded-lg rounded-md border">
                    <img class="w-full h-40 object-cover" src="{{ asset($museum->urlImg) }}"
                        alt="Foto museo {{ $museum->name }}">

                    <div class="p-4">
                        <div class="font-bold text-lg mb-2">
                            <a class="hover:underline" href="{{ route('museum.show', $museum->id) }}">
                                {{ $museum->name }}
                            </a>
                        </div>

                        <p class="text-gray-700 text-sm">
                            <strong>Ciudad:</strong> {{ $museum->city }}
                        </p>

                        <p class="text-gray-700 text-sm">
                            <strong>Precio:</strong> {{ number_format($museum->price, 2) }} €
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
