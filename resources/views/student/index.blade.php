<x-staff-layout>
    <x-slot name="header">
        {{ __('Students') }}
        <div>
            <a href="{{route('student.create')}}"><x-primary-button>+ Add new Student</x-primary-button></a>
        </div>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto">
                        <caption class="caption-top">
                            List of all students
                        </caption>
                        <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Degree</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($Students as $Student)
                                <tr>
                                    <td><a href="{{route('student.show', $Student->id)}}">{{strtoupper($Student->last_name)}}, {{$Student->first_name}}</a></td>
                                    <td><a href="{{route('degree.show', $Student->getDegree->id)}}">{{$Student->getDegree->friendly_name}}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-staff-layout>
