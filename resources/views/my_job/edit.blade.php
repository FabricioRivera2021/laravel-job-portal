<x-layout>
    <x-breadcrumbs 
    :links="['My jobs' => route('my-jobs.index'), 'Edit job' => '#']"
    class="mb-4" />

    <x-card class="mb-8">
        <form action="{{route('my-jobs.update', $job)}}" method="POST">
            @csrf
            @method('PUT'){{--para actualizar el registro usamos PUT  --}}

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for='title' :required='true'>Job Title</x-label>
                    <x-text-input name='title' :value='$job->title' />
                </div>
                <div>
                    <x-label for='location' :required='true'>Location</x-label>
                    <x-text-input name='location' :value='$job->location' />
                </div>
                <div class="col-span-2">
                    <x-label for='salary' :required='true'>Salary</x-label>
                    <x-text-input name='salary' type='number' :value='$job->salary' />
                </div>
                <div class="col-span-2">
                    <x-label for='description' :required='true'>Description</x-label>
                    <x-text-input name='description' type='textarea' :value="trim($job->description)"  />
                </div>

                <div>
                    <x-label for='experience' :required='true'>Experience</x-label>
                    <x-radio-group 
                        name='experience' 
                        :allOptions='false'
                        :options="array_combine(
                            array_map('ucfirst', \App\Models\Job::$experience), \App\Models\Job::$experience
                        )"
                        :value='$job->experience'
                    />
                </div>

                <div>
                    <x-label for='category' :required='true'>Category</x-label>
                    <x-radio-group 
                        name="category" 
                        :allOptions='false' 
                        :options="\App\Models\Job::$category"
                        :value='$job->category'
                         />
                </div>

                <div class="col-span-2">
                    <x-button class="w-full mt-4">Edit job</x-button>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>