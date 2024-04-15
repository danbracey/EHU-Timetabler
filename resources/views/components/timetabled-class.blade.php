@if($timeslot)
<div class="rounded-2xl bg-ehu-blue text-white mb-2">
    <h3 class="font-copse uppercase flex flex-row justify-center text-lg">CIS{{$timeslot->module_id}}: {{\App\Models\Module::where('id', '=', $timeslot->module_id)->first()->friendly_name}}</h3>
    <aside class="grid grid-cols-3 justify-items-center">
        <p>Starts at: {{date("g:i a", strtotime($timeslot->start_time))}}</p>
        <p>Ends at: {{date("g:i a", strtotime($timeslot->end_time))}}</p>
        <p>Room: {{$timeslot->room_id}}</p>
    </aside>
</div>
@else
No class scheduled
@endif
