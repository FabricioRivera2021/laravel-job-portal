<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Job::class);
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        );

        return view('job.index', [
            'jobs' => Job::with('employer')->latest()->filter($filters)->get()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $this->authorize('view', $job);
        return view('job.show', [
            //con employer.jobs tambien se cargan los jobs que hayan sido creados por ese employer
            'job' => $job->load('employer.jobs')
        ]);
    }

}
