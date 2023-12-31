<x-layout>
    <x-breadcrumbs :links="['My jobs' => '#']" class="mb-4" />

    <div class="mb-8 text-right">
        <x-link-button href="{{ route('my-jobs.create') }}" >Create Job</x-link-button>
    </div>

    <x-card>
        @forelse ($jobs as $job)
            <x-job-card :job="$job">
                <div class="text-xs text-slate-500">
                    @forelse ($job->jobApplications as $jobApplication)
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <div>
                                    {{$jobApplication->user->name}}
                                </div>
                                <div>
                                    Applied {{$jobApplication->created_at->diffForHumans()}}
                                </div>
                                <div>
                                    Download CV
                                </div>
                            </div>
                            <div>
                                expected salary: ${{number_format($jobApplication->expected_salary)}}
                            </div>
                        </div>
                    @empty
                        <div>No aplications yet</div>
                    @endforelse
                    @if (!$job->deleted_at)
                        <div class="flex space-x-2 mt-4 items-center">
                            <x-link-button href="{{route('my-jobs.edit', $job)}}">Edit</x-link-button>
                            {{-- Form for deleting is necesary --}}
                            <form action="{{route('my-jobs.destroy', $job)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div>
                                    <x-button class="bg-red-400 text-slate-100 text-xs hover:bg-red-700">Delete</x-button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </x-job-card>
        @empty
            <div class="rounder-md border border-dashed border-slate-300 p-8">
                <div class="text-center font-bold text-slate-400">
                    No jobs available
                </div>
                <div class="text-center text-slate-400">
                    Post your first job 
                    <a 
                        class="hover:text-indigo-500 underline" 
                        href="{{route('my-jobs.create')}}"
                    >here!</a>
                </div>
            </div>
        @endforelse
    </x-card>
</x-layout>