<?php

namespace App\Livewire;

use App\Models\Student;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.student')]
class GetStudentDetails extends Component
{
    public int|string|null $student = null;

    public function mount(): void
    {
        if ($this->student !== null) {
            $this->student = Student::findOrFail($this->student);
        }
    }

    public function render(): View
    {
        return view('livewire.get-student-details')->with([
            'student' => $this->student
        ]);
    }
}
