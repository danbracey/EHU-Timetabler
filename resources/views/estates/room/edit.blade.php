<x-staff-layout>
    <x-slot name="header">
        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-room-deletion')">
            {{ __('Delete Room') }}
        </x-danger-button>
    </x-slot>

    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg my-10">
        <form method="POST" action="{{ route('room.update', [$Building, $Room]) }}" class="p-10">
            @csrf
            @method("PATCH")

            <!-- Building Name -->
            <x-input-label for="building" :value="__('Building Name')" id="building"/>
            <x-select class="w-full" name="building">
                <option value="{{$Building->id}}">{{$Building->friendly_name}}</option>
                @foreach($Buildings as $Building)
                    @if($Room->building !== $Building->id)
                    <option value="{{$Building->id}}">{{$Building->friendly_name}}</option>
                    @endif
                @endforeach
            </x-select>

            <!-- ID -->
            <div class="mt-5">
                <x-input-label for="id" :value="__('Room Name / Code')" />
                <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" :value="$Room->id" required autofocus autocomplete="off" />
                <x-input-error :messages="$errors->get('id')" class="mt-2" />
            </div>

            <!-- Number of seats -->
            <aside class="flex gap-2 flex-col md:flex-row">
                <div class="mt-5">
                    <x-input-label for="available_seats" :value="__('Available Seats')" />
                    <x-text-input id="available_seats" class="block mt-1" type="number" name="available_seats" :value="$Room->available_seats" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('available_seats')" class="mt-2" />
                </div>

                <!-- Available computers -->
                <div class="mt-5">
                    <x-input-label for="available_computers" :value="__('Available Computers')" />
                    <x-text-input id="available_computers" class="block mt-1" type="number" name="available_computers" :value="$Room->available_computers" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('available_computers')" class="mt-2" />
                </div>

                <!-- Is lecture hall? -->
                <div class="mt-5">
                    <label for="is_lecture_hall">Please check if this room is a Lecture Hall</label>
                    <input type="checkbox" class="block mt-1 rounded-full" id="is_lecture_hall" name="is_lecture_hall" @if($Room->is_lecture_hall) checked @endif autofocus autocomplete="off">
                    <x-input-error :messages="$errors->get('is_lecture_hall')" class="mt-2" />
                </div>
            </aside>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </form>
    </section>
    <!-- Session Status -->
</x-staff-layout>

<x-modal name="confirm-room-deletion" focusable>
    <form method="post" action="{{ route('room.destroy', [$Building->id, $Room->id]) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this room?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Room') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
