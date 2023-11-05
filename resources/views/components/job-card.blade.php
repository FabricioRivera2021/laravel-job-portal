<x-card class="mb-4 min-w-[350px]">
    @if ($job->deleted_at)
        <span class="text-sm font-semibold text-red-600 bg-slate-200 p-2 w-full mb-2 block">Deleted at - {{$job->deleted_at}}</span>
    @endif
    <div class="mb-4 flex justify-between">
        <h2 class="text-lg font-medium">{{ $job->title }}</h2>
        <div class="text-slate-500"> $ {{ number_format($job->salary) }}</div>
    </div>
    <div class="mb-4 flex justify-between text-sm text-slate-500 items-center">
        <div class="flex space-x-4 items-center">
            <div>{{ $job->employer->company_name }}</div>
            <div>{{ $job->location }}</div>
        </div>
        <div class="flex space-x-1 text-xs">
            <x-tag>
                <a href="{{route('jobs.index', ['experience' => $job->experience])}}">
                    {{ Str::ucfirst($job->experience) }}
                </a>
            </x-tag>
            <x-tag>
                <a href="{{route('jobs.index', ['category' => $job->category])}}">
                    {{ $job->category }}
                </a>
            </x-tag>
        </div>
    </div>

    {{ $slot }}
</x-card>