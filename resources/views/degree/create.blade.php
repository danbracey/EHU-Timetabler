<x-staff-layout>
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg my-10">
            <form method="POST" action="{{ route('degree.store') }}" class="p-10">
                @csrf

                <!-- ID -->
                <div>
                    <x-input-label for="id" :value="__('UCAS Code / ID')" />
                    <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" :value="old('id')" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />
                </div>

                <!-- Friendly Name -->
                <div>
                    <x-input-label for="name" :value="__('Friendly name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
