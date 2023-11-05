<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;

class MyJobController extends Controller
{

    public function index()
    {
        $this->authorize('viewAnyEmployer', Job::class);//especificar a que modelo pertenece la policy
        return view(
            'my_job.index', [
                'jobs' => auth()->user()->employer
                    ->jobs()
                    ->with(['employer', 'jobApplications', 'jobApplications.user'])
                    ->get()
            ]
        );
    }


    public function create()
    {
        $this->authorize('create', Job::class);
        return view('my_job.create');
    }


    public function store(JobRequest $request)
    {
        $this->authorize('create', Job::class);
        // $validatedData = $request->validate();
        //esto queda obsoleto ya que pasamos todas las validaciones al custom "JobRequest"

        //At this point we know that the user is authenticated and that is an employer
        //we take the user from the current request, and then we create a new Job thats gonna be asociated
        //to that user(employer) in particular 
        $request->user()->employer->jobs()->create($request->validated());

        //redirect to the index of the users created jobs
        return redirect()->route('my-jobs.index')
            ->with('success','Job created successfully');
    }

    public function edit(Job $myJob)//OJO con esto: el nombre de la variable deve ser el de la ruta sin la "_"
    {
        $this->authorize('update', $myJob);
        return view('my_job.edit', ['job' => $myJob]);
    }

    public function update(JobRequest $request, Job $myJob)
    {
        $this->authorize('update', $myJob);

        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index', $myJob)
            ->with('success', 'Job edited successfully');
    }

    public function destroy(string $id)
    {
        //
    }
}
