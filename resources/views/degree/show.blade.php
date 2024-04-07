<x-staff-layout>
    <x-slot name="header">
        {{ $Degree->code }}: {{ $Degree->friendly_name }} ({{$Degree->graduation_year}})
        <div>
            <a href="{{route('degree.edit', $Degree->id)}}"><x-secondary-button>Edit Degree</x-secondary-button></a>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-degree-deletion')">
                {{ __('Delete Degree') }}
            </x-danger-button>
        </div>
    </x-slot>

    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl">Modules on this degree</h2>
            <a href="{{route('degree.edit', $Degree->id)}}"><x-secondary-button>Edit assigned Modules</x-secondary-button></a>
            <ul class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($Degree->modules as $Module)
                    <li><a href="{{route('module.show', $Module->id)}}">{{$Module->friendly_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </section>
</x-staff-layout>

<x-modal name="confirm-degree-deletion" focusable>
    <form method="post" action="{{ route('degree.destroy', $Degree->id) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this degree?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Degree') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
