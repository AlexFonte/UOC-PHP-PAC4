<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Museo') }}
        </h2>
    </x-slot>
    <div class="max-w-xl mx-auto px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-sm xs:rounded-lg rounded-md border">

            <img class="w-full h-64 object-cover" src="{{ asset($museum->urlImg) }}" alt="Foto museo {{ $museum->name }}">

            <div class="px-6 py-4">
                <h3 class="font-bold text-3xl mb-2">{{ $museum->name }}</h3>

                <p class="text-gray-700 text"><strong>Ciudad:</strong> {{ $museum->city }}</p>
                <p class="text-gray-700 text"><strong>Fechas y horarios:</strong> {{ $museum->schedule }}</p>
                <p class="text-gray-700 text"><strong>Visitas guiadas:</strong> {{ $museum->visitguided }}</p>
                <p class="text-gray-700 text"><strong>Precio:</strong> {{ number_format($museum->price, 2) }} €</p>

                <p class="text-gray-700 text-sm pt-2"><strong>Temáticas:</strong></p>
                <div class="px-6 pt-2 pb-2">
                    @foreach ($museum->topics as $topic)
                        <span
                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 hover:bg-gray-300">
                            #{{ $topic->name }}
                        </span>
                    @endforeach
                </div>

                <div class="mt-2">

                    <a class="hover:underline text-sm" href="{{ url('/') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-2 inline w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>Volver a Home</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
