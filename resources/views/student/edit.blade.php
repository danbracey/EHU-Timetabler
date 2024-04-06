<x-staff-layout>
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg my-10">
        <form method="POST" action="{{ route('student.update', $Student->id) }}" class="p-10">
            @method('PATCH')
            @csrf

            <!-- ID -->
            <div>
                <x-input-label for="id" :value="__('Student ID')" />
                <x-text-input id="id" class="block mt-1 w-full" type="number" digits="8" name="id" value="{{old('id') ?? $Student->id}}" required autofocus autocomplete="off" />
                <x-input-error :messages="$errors->get('id')" class="mt-2" />
            </div>

            <!-- First name -->
            <div>
                <x-input-label for="first_name" :value="__('First name')" />
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{old('first_name') ?? $Student->first_name}}" required autofocus autocomplete="off" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <!-- Last name -->
            <div>
                <x-input-label for="last_name" :value="__('Last name')" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{old('last_name') ?? $Student->last_name}}" required autofocus autocomplete="off" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <!-- Degree -->
            <div>
                <x-input-label for="degree" :value="__('Degree')" />
                <x-select class="w-full">
                        <option value="{{$Student->degree->id}}">{{$Student->degree->id}} - {{$Student->degree->friendly_name}}</option>
                    @foreach($Degrees as $Degree)
                        @if($Degree->id !== $Student->degree->id) {{-- Show all degrees except the one the student is on --}}
                        <option value="{{$Degree->id}}">{{$Degree->id}} - {{$Degree->friendly_name}}</option>
                        @endif
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
