<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\Subtask;
use Yajra\DataTables\DataTables;


class SubtaskController extends Controller
{
    public function index($id, $task_id)
    {
        $task = Task::where('id', $task_id)->first();
        return view('subtasks.index', compact('task'));
    }

    public function getSubtasks($id, $task_id)
    {
        $subtasks = Subtask::where('task_id', $task_id)
            ->select(['id', 'name', 'description', 'task_id']);
            
        return DataTables::of($subtasks)
 
            ->addColumn('action', function ($subtask) use ($id) {
                return '<a href="' . route('projects.tasks.subtasks.edit', [ $id , $subtask->task_id, $subtask->id]) . '" class="btn btn-primary btn-sm">Edit</a>
                        <a href="javascript:void(0)" data-id="' . $subtask->id . '" class="btn btn-danger btn-sm deleteSubtask">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create(Project $project, Task $task)
    {
        return view('subtasks.create', compact('project', 'task'));
    }

    public function store(Request $request, Project $project, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->subtasks()->create($validated);

        $notification = array(
            'message' => 'Subtask Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('projects.tasks.subtasks.index', [$project, $task])->with($notification);
    }

    public function edit(Project $project, Task $task, Subtask $subtask)
    {
        return view('subtasks.edit', compact('project', 'task', 'subtask'));
    }

    public function update(Request $request, Project $project, Task $task, Subtask $subtask)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subtask->update($validated);

        $notification = array(
            'message' => 'Subtask Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('projects.tasks.subtasks.index', [$project, $task])->with($notification);
    }

    public function destroy(Project $project, Task $task, Subtask $subtask)
    {
        $subtask->delete();

        return response()->json([
            'success' => true,
            'message' => 'SubTask deleted successfully.'
        ]);
    }
}
