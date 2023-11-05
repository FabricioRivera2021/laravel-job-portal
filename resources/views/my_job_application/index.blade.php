<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Job applications' => '#']" />

    @forelse ($applications as $application)
        <x-job-card :job="$application->job" >
            <div class="flex items-center justify-between text-xs text-slate-500">
                <div>
                    <div>
                        Applied - {{ $application->created_at->diffForHumans() }}
                    </div>
                    <div>
                        Other {{ Str::plural('applicant', $application->job->job_applications_count - 1) }} {{ $application->job->job_applications_count - 1 }}
                    </div>
                    <div>
                        Your asking salary: ${{number_format($application->expected_salary)}}
                    </div>
                    <div>
                        Average asking salary: ${{number_format($application->job->job_applications_avg_expected_salary)}}
                    </div>
                </div>
                <div class="text-right">
                    <div>
                        <form action="{{route('my-job-applications.destroy', $application)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            @if (!$application->job->deleted_at)
                                <x-button class="mt-4 hover:bg-red-400 hover:text-white text-slate-600">Cancel application</x-button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">
                No job applications yet!
            </div>
            <div class="text-center">
                Go find some job <a class="text-indigo-500 hover:underline" href="{{route('jobs.index')}}">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>