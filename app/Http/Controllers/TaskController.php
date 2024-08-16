<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function import(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('csv_file');
            $data = array_map('str_getcsv', file($file->getRealPath()));
            $header = array_shift($data); // Remove and store the header row

            if ($header !== ['name', 'description']) {
                return redirect()->back()->with('error', 'Invalid CSV format. Please ensure the header is "name,description".');
            }

            DB::beginTransaction();

            foreach ($data as $row) {
                $row = array_combine($header, $row);

                // Validate each row
                $taskValidator = Validator::make($row, [
                    'name' => 'required|string|max:255',
                    'description' => 'required|string|max:1000',
                ]);

                if ($taskValidator->fails()) {
                    DB::rollBack();
                    return redirect()->back()->withErrors($taskValidator)->withInput();
                }

                $project = Project::find($projectId); 

                if ($project) {
                    $project->tasks()->create([
                        'name' => $row['name'],
                        'description' => $row['description'],
                    ]);
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Project not found.');
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Tasks imported successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'There was an error processing the file: ' . $e->getMessage());
        }
    }
}
