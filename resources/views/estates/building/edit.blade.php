<x-staff-layout>
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg my-10">
            <form method="POST" action="{{ route('building.update', $Building->id) }}" class="p-10">
                @method('PATCH')
                @csrf

                <!-- Friendly Name -->
                <div>
                    <x-input-label for="friendly_name" :value="__('Building Name')" />
                    <x-text-input id="friendly_name" class="block mt-1 w-full" type="text" name="friendly_name" value="{{$Building->friendly_name}}" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('friendly_name')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </section>
    <!-- Session Status -->
</x-staff-layout>
