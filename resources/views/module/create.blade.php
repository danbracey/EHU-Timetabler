<x-staff-layout>
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg my-10">
            <form method="POST" action="{{ route('module.store') }}" class="p-10">
                @csrf

                <!-- ID -->
                <div>
                    <x-input-label for="id" :value="__('Module ID')" />
                    <p>Do not include CIS</p>
                    <x-text-input id="id" class="block mt-1 w-full" type="number" name="id" value="{{old('id')}}" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />
                </div>

                <!-- Friendly name -->
                <div>
                    <x-input-label for="friendly_name" :value="__('Friendly name')" />
                    <x-text-input id="friendly_name" class="block mt-1 w-full" type="text" name="friendly_name" value="{{old('friendly_name')}}" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('friendly_name')" class="mt-2" />
                </div>

                <div class="mt-2">
                    <span>Degrees this Module is on:</span><br/>
                    @foreach($Degrees as $Degree)
                        <input type="checkbox" name="degrees[]" id="{{$Degree->id}}" value="{{$Degree->id}}" />
                        <label for="{{$Degree->id}}">{{$Degree->friendly_name}}</label><br/>
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
