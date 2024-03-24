<main>
    {{-- The Master doesn't talk, he acts. --}}
    Hello! {{$student ?? '#'}}

    @if($student)
        Yo!
    @endif
</main>
