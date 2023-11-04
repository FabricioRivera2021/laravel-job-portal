<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function create(Job $job)
    {
        $this->authorize("apply", $job); //custom "apply" autorization policy
        return view('job_application.create', ['job' => $job]);
    }

    public function store(Job $job, Request $request)
    {
        $this->authorize("apply", $job);

        //validate the DATA
        $validatedData = $request->validate([ 
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        //After data is validated, save the pdf in private disk
        $file = $request->file('cv');
        $path = $file->store('cvs', 'private');

        //then you can create all records in database with the path to the file (pdf) already been created
        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path
        ]);

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job application submitted');
    }

    public function destroy()
    {
        //
    }
}
