<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    //Display a listing of the resource.
    public function index(Request $request)
    {
       
        $projects = auth()->user() //Get the logged-in user's projects
            ->projects() //Use the projects() relationship defined in the User model to get the projects associated with the authenticated user.
            ->when($request->search, function ($query, $search){
                $words = preg_split('/\s/', trim($search));

                foreach ($words as $word) {
                    $query->where(function ($query) use ($word) {
                        $query->where('name', 'like', "%{$word}%")
                            ->orWhere('description', 'like', "%{$word}%");
                    });
                }
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })

            ->latest() //Order newest first, using created_at
            ->paginate(4)
            ->withQueryString();

            // Return the view with the projects data
            return view('projects.projects_index', [
                // Pass the projects to the view
                // The view will be able to access the projects variable and display the list of projects for the authenticated user.
                // anothter way to pass the projects variable to the view is to use the compact() function, which creates an array containing variables and their values. e.g. return view('projects.index', compact('projects'));
                'projects' => $projects,
                'search' => $request->search,
                'status' => $request->status,
                'statuses' => Project::STATUSES,
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
            'status' => ['required', Rule::in(array_keys(Project::STATUSES))],
        ]);

        //creates the project in the database and automatically fills the user_id.
        Auth::user()-> projects()->create($validated);

        //change URL and load the page named projects.index
        return redirect()->route('projects.index')
        //with() is used to flash a success message to the session, which can be displayed in the view.
            ->with('success', 'Project created successfully.');
    }
        

    // Display the specified resource.
    public function show(Project $project, Request $request)
    {
        abort_if($project->user_id !== auth()->id(), 403);

        $tasks = $project->tasks()
            ->when($request->search, function ($query, $search){
                $words = preg_split('/\s+/', trim($search));

                foreach ($words as $word) {
                    $query->where(function ($query) use ($word) {
                        $query->where('title', 'like', "%{$word}%")
                            ->orWhere('description', 'like', "%{$word}%")
                            ->orWhere('status', 'like', "%{$word}%")
                            ->orWhere('priority', 'like', "%{$word}%");
                    });
                }
            })
            ->when($request->status, function ($query, $status){
                $query->where('status',$status);
            })
            ->latest()
            ->paginate(4)
            ->withQueryString();

        return view('projects.projects_show', [
            'project' => $project,
            'tasks' =>$tasks,
            'search' => $request->search,
            'status' => $request->status,
            'statuses' =>Task::STATUSES,
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
            'status' => ['required', Rule::in(array_keys( Project::STATUSES))],
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