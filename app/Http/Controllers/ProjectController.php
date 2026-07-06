<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    //Display a listing of the resource.
    public function index()
    {
       
        $projects = auth()->user() //Get the logged-in user's projects
            ->projects() //Use the projects() relationship defined in the User model to get the projects associated with the authenticated user.
            ->latest() //Order newest first, using created_at
            ->get(); // Get the result from database

            // Return the view with the projects data
            return view('projects.projects_index', [
                // Pass the projects to the view
                // The view will be able to access the projects variable and display the list of projects for the authenticated user.
                // anothter way to pass the projects variable to the view is to use the compact() function, which creates an array containing variables and their values. e.g. return view('projects.index', compact('projects'));
                'projects' => $projects,
            ]);
    }


 
    // Show the form for creating a new resource.
    public function create()
    {
        return view ('projects.projects_create');
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        //gets and checks the input from the form.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' =>['nullable', 'string'],
        ]);

        //creates the project in the database and automatically fills the user_id.
        Auth::user()-> projects()->create($validated);

        //change URL and load the page named projects.index
        return redirect()->route('projects.index')
        //with() is used to flash a success message to the session, which can be displayed in the view.
            ->with('success', 'Project created successfully.');
    }
        

    // Display the specified resource.
    public function show(Project $project)
    {
        abort_if($project->user_id !== auth()->id(), 403);

        $project->load('tasks');

        return view('projects.projects_show', [
            'project' => $project,
        ]);
    }

    // Show the form for editing the specified resource.
    public function edit(Project $project)
    {
       abort_if($project->user_id !== auth()->id(), 403);

       return view('projects.projects_edit', [
        'project' => $project,
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        abort_if($project->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $project->update($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        abort_if($project->user_id !==auth()->id(), 403);

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

}

//Logic
//User fills form
// -> form sends request to store()
// -> controller validates input
// -> controller saves to database
// -> redirect back to list page