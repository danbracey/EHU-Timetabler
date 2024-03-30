<div class="flex flex-col border-solid border-4 border-ehu-blue max-w-fit items-center">
    <h3 class="bg-ehu-blue text-white px-10">{{$slot}}</h3>
    <span class="my-2">
        <a href="{{route($route . '.show' , $id)}}"><x-primary-button>View</x-primary-button></a>
        <a href="{{route($route . '.edit' , $id)}}"><x-secondary-button>Edit</x-secondary-button></a>
        <x-danger-button x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion'">
            {{ __('Delete') }}
        </x-danger-button>
    </span>

    <x-modal name="confirm-deletion" focusable>
        <form method="post" action="{{ route($route . '.destroy', $id) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this record?') }}
            </h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>
