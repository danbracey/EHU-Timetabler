<x-staff-layout>
    <x-slot name="header">
        {{ $Degree->id }}: {{ $Degree->friendly_name }}
    </x-slot>

    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl">Modules on this degree</h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Include modules on degree -->
            </div>
        </div>
    </section>
</x-staff-layout>
