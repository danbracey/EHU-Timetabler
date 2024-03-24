<x-student-layout>
    <form class="h-screen flex items-center justify-center mx-20" method="get">
        <x-text-input placeholder="Enter your student ID" class="w-full border-ehu-pink border-4" id="student_id" name="student_id"></x-text-input>
        <button type="submit" class="btn-primary block">Find my timetable</button>
        <x-input-error :messages="$errors->first()" class="mt-2" />
    </form>
</x-student-layout>
