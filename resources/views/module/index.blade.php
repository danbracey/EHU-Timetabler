<x-staff-layout>
    <x-slot name="header">
        {{ __('Modules') }}
        <div>
            <a href="{{route('module.create')}}"><x-primary-button>+ Add new Module</x-primary-button></a>
        </div>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto">
                        <caption class="caption-top">
                            List of all modules
                        </caption>
                        <thead>
                        <tr>
                            <th>Module Name</th>
                            <th>Degrees</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($Modules as $Module)
                                <tr>
                                    <td><a href="{{route('module.show', $Module->id)}}">{{$Module->friendly_name}}</a></td>
                                    <td>{{$Module->degrees->pluck('friendly_name')->implode(', ') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-staff-layout>
