<x-layout>

    <x-breadcrumbs class="mb-4"
        :links="[
            'Jobs' => route('jobs.index'), 
            $job->title => route('jobs.show', $job),
            'Apply' => '#'
        ]"/>

    @if (session('error'))
    <div role="alert" 
        class="mb-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
        <p class="font-bold">
            Success!!
        </p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <x-job-card :job="$job" />    

    <x-card>
        <h2 class="mb-4 text-lg font-medium">
            Your job application
        </h2>
        <form action="{{ route('job.application.store', $job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <x-label for="expected_salary" :required='true' >Expected Salary</x-label>
                <x-text-input type="number" name="expected_salary" />
            </div>

            <div class="mb-4">
                <x-label for="cv" :required='true' >Upload CV</x-label>
                <x-text-input type="file" name="cv" />
            </div>

            <x-button class="w-full">Apply</x-button>
        </form>
    </x-card>
</x-layout>