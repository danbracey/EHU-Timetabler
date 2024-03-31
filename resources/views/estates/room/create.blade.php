<x-staff-layout>
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg my-10">
            <form method="POST" action="{{ route('room.store', $Building) }}" class="p-10">
                @csrf

                <!-- Building Name -->
                <div>
                    <x-input-label for="friendly_name" :value="__('Building Name')" />
                    <x-text-input id="friendly_name" class="block mt-1 w-full bg-gray-200" type="text" name="friendly_name" value="{{$Building->friendly_name}}" disabled autofocus autocomplete="off" />
                </div>

                <!-- ID -->
                <div class="mt-5">
                    <x-input-label for="id" :value="__('Room Name / Code')" />
                    <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" :value="old('id')" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />
                </div>

                <!-- Number of seats -->
                <aside class="flex gap-2 flex-col md:flex-row">
                    <div class="mt-5">
                        <x-input-label for="available_seats" :value="__('Available Seats')" />
                        <x-text-input id="available_seats" class="block mt-1" type="number" name="available_seats" :value="old('available_seats')" required autofocus autocomplete="off" />
                        <x-input-error :messages="$errors->get('available_seats')" class="mt-2" />
                    </div>

                    <!-- Available computers -->
                    <div class="mt-5">
                        <x-input-label for="available_computers" :value="__('Available Computers')" />
                        <x-text-input id="available_computers" class="block mt-1" type="number" name="available_computers" :value="old('available_computers')" required autofocus autocomplete="off" />
                        <x-input-error :messages="$errors->get('available_computers')" class="mt-2" />
                    </div>

                    <!-- Is lecture hall? -->
                    <div class="mt-5">
                        <x-input-label for="is_lecture_hall" :value="__('Please check if this room is a Lecture Hall')" />
                        <x-text-input id="is_lecture_hall" class="block mt-1" type="checkbox" name="is_lecture_hall" :value="old('available_computers')" autofocus autocomplete="off" />
                        <x-input-error :messages="$errors->get('available_computers')" class="mt-2" />
                    </div>
                </aside>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </section>
    <!-- Session Status -->
</x-staff-layout>
