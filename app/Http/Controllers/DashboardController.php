<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $hour = now()->hour;
        $user =auth()->user();

        if ($hour >= 5 && $hour < 12){
            $greeting = 'Good morning';
        }
        elseif ($hour >= 12 && $hour <18) {
            $greeting ='Good afternoon' ;
        }
        elseif ($hour >= 18 && $hour <24){
            $greeting = 'Good evening';
        }
        else {
            $greeting = 'Good night';
        }

        $totalProjects = $user->projects()->count();

        $totalTasks= Task::whereHas('project', function($query) use ($user){
            $query->where('user_id', $user->id);
        })->count();

        $completedTasks = Task::whereHas('project', function ($query) use ($user){
            $query->where('user_id', $user->id);
        })
            ->where('status','completed')
            ->count();

        $pendingTasks = Task::whereHas('project', function ($query) use ($user){
            $query->where('user_id',$user->id);
        })
            ->where('status', '!=', 'completed')
            ->count();

        return view('dashboard',[
            'greeting' => $greeting,
            'totalProjects' => $totalProjects,
            'totalTasks' =>$totalTasks,
            'completedTasks' =>$completedTasks,
            'pendingTasks' => $pendingTasks,
        ]);
    }
}
