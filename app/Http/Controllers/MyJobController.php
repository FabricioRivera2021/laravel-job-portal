<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class MyJobController extends Controller
{

    public function index()
    {
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
        return view('my_job.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:5000',
            'description' => 'required|string',
            'experience' => 'required|in:' . implode(',', Job::$experience),//entry , intermediate, senior
            'category' => 'required|in:' . implode(',', Job::$category),//IT , Finance, Sales, Marqueting
        ]);

        //At this point we know that the user is authenticated and that is an employer
        //we take the user from the current request, and then we create a new Job thats gonna be asociated
        //to that user(employer) in particular 
        $request->user()->employer->jobs()->create($validatedData);

        //redirect to the index of the users created jobs
        return redirect()->route('my-jobs.index')
            ->with('success','Job created successfully');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
