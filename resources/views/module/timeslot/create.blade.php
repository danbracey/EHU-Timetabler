<x-staff-layout>
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg my-10">
            <form method="POST" action="{{ route('module.timeslot.store', $Module->id) }}" class="p-10">
                @csrf

                @if($errors->get('clashes'))
                    <div role="alert" class="mb-5">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            Clashes Detected
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>The following clashes were detected:</p>
                                <ul>
                                    @foreach(collect($errors->get('clashes'))->flatten() as $clash)
                                        <li>Module {{$clash->module_id}} using Room {{$clash->room_id}} ({{$clash->start_time}} - {{$clash->end_time}})</li>
                                    @endforeach
                                </ul>
                        </div>
                    </div>
                @endif

                <!-- Module ID -->
                Creating a manual Timetable entry for:
                CIS{{$Module->id}}: {{$Module->friendly_name}}

                <!-- Room -->
                <div>
                    <x-input-label for="room_id" :value="__('Room')" />
                    <x-select name="room_id" class="w-full">
                        @foreach($Rooms as $Room)
                            <option value="{{$Room->id}}">{{$Room->id}}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
                </div>

                <!-- Day of Week -->
                <div>
                    <x-input-label for="day_of_week" :value="__('Day of Week')" />
                    <x-select name="day_of_week" class="w-full">
                        <option value=1 @selected(old('day_of_week') == 1)>Monday</option>
                        <option value=2 @selected(old('day_of_week') == 2)>Tuesday</option>
                        <option value=3 @selected(old('day_of_week') == 3)>Wednesday</option>
                        <option value=4 @selected(old('day_of_week') == 4)>Thursday</option>
                        <option value=5 @selected(old('day_of_week') == 5)>Friday</option>
                    </x-select>
                    <x-input-error :messages="$errors->get('day_of_week')" class="mt-2" />
                </div>

                <!-- Start Time -->
                <div>
                    <x-input-label for="start_time" :value="__('Start Time')" />
                    <x-text-input id="start_time" class="block mt-1 w-full" type="time" name="start_time" value="{{old('start_time')}}" placeholder="00:00" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                </div>

                <!-- End Time -->
                <div>
                    <x-input-label for="end_time" :value="__('End Time')" />
                    <x-text-input id="end_time" class="block mt-1 w-full" type="time" name="end_time" value="{{old('end_time')}}" placeholder="00:00" required autofocus autocomplete="off" />
                    <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                </div>

                <!-- Is lecture? -->
                <div>
                    <label> Is this a lecture?
                        <input type="checkbox" name="is_lecture" />
                    </label>
                    <x-input-error :messages="$errors->get('is_lecture')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </section>
    <!-- Session Status -->
</x-staff-layout>
