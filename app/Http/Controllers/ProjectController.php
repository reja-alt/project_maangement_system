<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index');
    }

    public function getProjects()
    {
        $projects = Project::with('tasks')->select(['id', 'name', 'description']);
        
        return DataTables::of($projects)
            ->addColumn('tasks', function (Project $project) {
                return $project->tasks->count();
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . route('projects.edit', $row->id) . '" class="btn btn-primary btn-sm mb-1">Edit</a>
                        <a href="' . route('projects.tasks.index', $row->id) . ' " data-task_id="' . $row->id . '" class="btn btn-secondary btn-sm mb-1">Manage Tasks</a>
                        <a href="' . route('report.form', $row->id) . ' " class="btn btn-info btn-sm mb-1">Show</a>
                        <a href="' . route('report.generate', $row->id) . ' " class="btn btn-success btn-sm mb-1">Generate Report</a>
                        <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteProject mb-1">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        auth()->user()->projects()->create($request->all());

        $notification = array(
            'message' => 'Project Created Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('projects.index')->with($notification);
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $project->update($request->all());

        $notification = array(
            'message' => 'Project Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('projects.index')->with($notification);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully.'
        ]);
    }

    public function showReportForm($projectId)
    {
        $project = Project::with('tasks.subtasks')->findOrFail($projectId);
        return view('projects.show', ['project' => $project]);
    }

    public function generateAndDisplayReport($projectId)
    {
        $project = Project::with('tasks.subtasks')->findOrFail($projectId);
        $pdf = Pdf::loadView('projects.report', ['project' => $project]);

        // Return the PDF as a response
        return $pdf->download('project_report.pdf');
    }
}
