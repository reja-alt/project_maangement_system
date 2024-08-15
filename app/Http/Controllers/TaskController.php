<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{
    public function index($id)
    {
        $project = Project::where('id', $id)->first();
        return view('tasks.index', compact('project'));
    }

    public function getTasks($id)
    {
        $tasks = Task::where('project_id', $id)
            ->with('subtasks:id,task_id,name')
            ->select(['id', 'name', 'description']);
            
        return DataTables::of($tasks)
            ->addColumn('subtasks', function ($task) {
                return $task->subtasks->count();
            })
            ->addColumn('action', function ($task) use ($id) {
                return '<a href="' . route('projects.tasks.edit', [$id, $task->id]) . '" class="btn btn-primary btn-sm">Edit</a>
                        <a href="' . route('projects.tasks.subtasks.index', [$id, $task->id]) . '" class="btn btn-secondary btn-sm">Manage Subtasks</a>
                        <a href="javascript:void(0)" data-id="' . $task->id . '" class="btn btn-danger btn-sm deleteTask">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
       


    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $project->tasks()->create($request->all());

        $notification = array(
            'message' => 'Task Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('projects.tasks.index', $project)->with($notification);
    }

    public function show(Project $project, Task $task)
    {
        return view('tasks.show', compact('project', 'task'));
    }

    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $task->update($request->all());

        $notification = array(
            'message' => 'Task Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('projects.tasks.index', $project)->with($notification);
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.'
        ]);
    }
}
