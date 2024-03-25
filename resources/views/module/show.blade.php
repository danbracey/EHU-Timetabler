<x-staff-layout>
    <x-slot name="header">
        {{ $Module->id }}: {{ $Module->friendly_name }}
        <div>
            <a href="{{route('module.edit', $Student->id)}}"><x-secondary-button>Edit Module</x-secondary-button></a>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-module-deletion')">
                {{ __('Delete Module') }}
            </x-danger-button>
        </div>
    </x-slot>


    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl">Degrees this Module is on:</h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Include degrees for Module -->
            </div>
        </div>
    </section>
</x-staff-layout>

<x-modal name="confirm-module-deletion" focusable>
    <form method="post" action="{{ route('module.destroy', $Module->id) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this module?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Module') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
