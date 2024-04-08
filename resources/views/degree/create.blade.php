<x-staff-layout>
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg my-10">
            <form method="POST" action="{{ route('degree.store') }}" class="p-10">
                @csrf

                <!-- UCAS Code -->
                <div>
                    <x-input-label for="code" :value="__('UCAS Code')" />
                    <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                <!-- Friendly Name -->
                <div>
                    <x-input-label for="friendly_name" :value="__('Friendly name')" />
                    <x-text-input id="friendly_name" class="block mt-1 w-full" type="text" name="friendly_name" :value="old('friendly_name')" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('friendly_name')" class="mt-2" />
                </div>

                <!-- Graduation Year -->
                <div>
                    <x-input-label for="graduation_year" :value="__('Graduation year')" />
                    <x-text-input id="graduation_year" class="block mt-1 w-full" type="number" name="graduation_year" :value="old('graduation_year')" required autofocus autocomplete="off" placeholder="2027" />
                    <x-input-error :messages="$errors->get('graduation_year')" class="mt-2" />
                </div>

                <div class="mt-2">
                    <span>Modules this Degree is on:</span><br/>
                    @foreach($Modules as $Module)
                        <input type="checkbox" name="modules[]" id="{{$Module->id}}" value="{{$Module->id}}" />
                        <label for="{{$Module->id}}">CIS{{$Module->id}}: {{$Module->friendly_name}}</label><br/>
                    @endforeach
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
