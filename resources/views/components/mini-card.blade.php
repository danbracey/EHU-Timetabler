<div class="flex flex-col border-solid border-4 border-ehu-blue max-w-fit items-center">
    <h3 class="bg-ehu-blue text-white px-10">{{$slot}}</h3>
    <span class="my-2">
        <a href="{{route($route . '.show' , $id)}}"><x-primary-button>View</x-primary-button></a>
        <a href="{{route($route . '.edit' , $id)}}"><x-secondary-button>Edit</x-secondary-button></a>
    </span>
</div>
