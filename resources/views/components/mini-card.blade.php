<div class="flex flex-col border-solid border-4 border-ehu-blue max-w-fit items-center">
    <h3 class="bg-ehu-blue text-white px-10">{{$slot}}</h3>
    <span class="my-2">
        <a href="{{route('degree.show' , $id)}}"><x-primary-button>View</x-primary-button></a>
        <a href="{{route('degree.edit' , $id)}}"><x-secondary-button>Edit</x-secondary-button></a>
        <form action="{{route('degree.destroy' , $id)}}" method="POST">
            @method('DELETE') @csrf
            <x-danger-button>Delete</x-danger-button>
        </form>
        <!-- TODO: Enable confirmation modal before deleting a degree -->
{{--        <x-danger-button x-on:click.prevent="$dispatch('open-modal', 'confirm-degree-deletion'">--}}
{{--            {{ __('Delete') }}--}}
{{--        </x-danger-button>--}}
    </span>
</div>
