<x-staff-layout>
    <x-slot name="header">
        {{ $Student->id }}: {{ $Student->last_name }}, {{$Student->first_name}}
        <div>
            <a href="{{route('student.edit', $Student->id)}}"><x-secondary-button>Edit Student</x-secondary-button></a>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-student-deletion')">
                {{ __('Delete Student') }}
            </x-danger-button>
        </div>
    </x-slot>


    <section>
        <p class="max-w-7xl mx-auto sm:px-6 lg:px-8">{{$Student->first_name}} is on <a href="{{route('degree.show', $Student->degree->id)}}">{!! $Student->degree->friendly_name !!}</a></p>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl">Student's Modules:</h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Include modules for student -->
            </div>
        </div>
    </section>
</x-staff-layout>

<x-modal name="confirm-student-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('student.destroy', $Student->id) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this student?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Student') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
