<x-staff-layout>
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg my-10">
            <form method="POST" action="{{ route('student.store') }}" class="p-10">
                @csrf

                <!-- ID -->
                <div>
                    <x-input-label for="id" :value="__('Student ID')" />
                    <x-text-input id="id" class="block mt-1 w-full" type="number" digits="8" name="id" :value="old('id')" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />
                </div>

                <!-- First name -->
                <div>
                    <x-input-label for="first_name" :value="__('First name')" />
                    <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('friendly_name')" class="mt-2" />
                </div>

                <!-- Last name -->
                <div>
                    <x-input-label for="last_name" :value="__('Last name')" />
                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

                <!-- Degree -->
                <div>
                    <x-input-label for="degree" :value="__('Degree')" />
                    <x-select name="degree" class="w-full">
                        @foreach($Degrees as $Degree)
                            <option value="{{$Degree->id}}">{{$Degree->id}} - {{$Degree->friendly_name}}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
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
