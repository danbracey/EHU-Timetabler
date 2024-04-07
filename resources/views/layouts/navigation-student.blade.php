<nav x-data="{ open: false }" class="bg-ehu-blue text-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" class="text-white font-copse text-2xl">
                        EHU Timetabler
                    </a>
                </div>
            </div>

            <form class="flex my-2 text-black" method="get">
                <x-text-input placeholder="Enter your student ID" class="w-full border-ehu-pink border-4" id="student_id" name="student_id" value="{{app('request')->input('student_id')}}"></x-text-input>
            </form>

            <!-- Settings Dropdown -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    Staff Login
                </x-nav-link>
            </div>
        </div>
    </div>
</nav>
