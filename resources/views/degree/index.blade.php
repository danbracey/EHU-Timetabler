<x-staff-layout>
    <x-slot name="header">
        {{ __('Degrees') }}
    </x-slot>

    <div class="p-6 text-gray-900 grid grid-cols-6 gap-5">
        @foreach($Degrees as $Degree)
            <x-mini-card id="{{$Degree->id}}">{{$Degree->friendly_name}}</x-mini-card>
        @endforeach
    </div>
</x-staff-layout>

<x-modal name="confirm-degree-deletion" focusable>
    <form method="post" action="{{ route('degree.destroy', $Degree->id) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete ' . $Degree->friendly_name) }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once a degree is deleted, the timetable will be automatically be scheduled to regenerate.') }}
        </p>

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
