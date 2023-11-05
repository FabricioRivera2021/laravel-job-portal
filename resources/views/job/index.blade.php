<x-layout>

    <x-breadcrumbs class="mb-4"
        :links="['Jobs' => route('jobs.index')]" 
    />

    <x-card class="mb-4 text-sm md:col-span-2 xl:col-span-3">
        <form id="filtering-form" action="{{ route('jobs.index') }}" method="GET">
            <div class="mb-4 grid xl:grid-cols-4 grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" value="{{request('search')}}" placeholder="Search for any text" 
                        form-id="filtering-form" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" value="{{request('min_salary')}}" placeholder="From" 
                            form-id="filtering-form"/>
                        <x-text-input name="max_salary" value="{{request('max_salary')}}" placeholder="To"
                            form-id="filtering-form"/>
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience</div>
                    {{-- para que la primera letra quede en uppercase ... --}}
                    <x-radio-group name="experience" :options="array_combine(array_map('ucfirst', \App\Models\Job::$experience), \App\Models\Job::$experience)" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-group name="category" :options="\App\Models\Job::$category" />
                </div>
            </div>

            <button class="w-full">Filter</button>
        </form>
    </x-card>

    @foreach ($jobs as $job)
        <x-job-card class="mb-4" :job="$job">
            {{-- Lista de jobs, osea job-card --}}
            <div class="flex flex-col justify-between items-start">
                <p class=" rounded-sm border border-slate-200 px-2 py-5 mb-6 text-sm text-slate-500">
                    {!! nl2br(e($job->description)) !!}
                </p>
                <x-link-button :href="route('jobs.show', $job)">
                    Show
                </x-link-button>
                @can('apply', $job)
                {{-- Los que todavia el usuario no aplico --}}
                @else
                {{-- Los que el usuario ya aplico --}}
                    {{-- compruebo que este logueado --}}
                    @auth
                        <div class="text-center text-sm font-semibold text-slate-700 underline">
                            Already apply for this job
                        </div>
                    @endauth
                @endcan
            </div>
        </x-job-card>
    @endforeach
</x-layout>
