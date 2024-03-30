<x-staff-layout>
    <x-slot name="header">
        {{ $Building->friendly_name }}
        <div>
            <a href="{{route('room.create', $Building->id)}}"><x-secondary-button>Create Room</x-secondary-button></a>
            <a href="{{route('building.edit', $Building->id)}}"><x-secondary-button>Edit Building</x-secondary-button></a>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-building-deletion')">
                {{ __('Delete Building') }}
            </x-danger-button>
        </div>
    </x-slot>

    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl">Rooms in this Building</h2>
            <ul class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($Building->rooms as $Room)
                    <li><a href="{{route('module.show', $Room->id)}}">{{$Room->friendly_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </section>
</x-staff-layout>

<x-modal name="confirm-building-deletion" focusable>
    <form method="post" action="{{ route('building.destroy', $Building->id) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this building?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Building') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
