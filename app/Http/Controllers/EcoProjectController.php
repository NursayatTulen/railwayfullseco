<?php

namespace App\Http\Controllers;

use App\Models\EcoProject;
use Illuminate\Http\Request;

class EcoProjectController extends Controller
{
    public function index()
    {
        $projects = EcoProject::latest()->get();
        return view('eco-projects.index', compact('projects'));
    }

    public function create()
    {
        return view('eco-projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        EcoProject::create($request->only(['title', 'description']));

        return redirect()->route('eco-projects.index')
            ->with('success', 'Эко-жоба сәтті жасалды!');
    }

    public function edit($id)
    {
        $project = EcoProject::findOrFail($id);
        return view('eco-projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = EcoProject::findOrFail($id);
        $project->update($request->only(['title', 'description']));

        return redirect()->route('eco-projects.index')
            ->with('success', 'Эко-жоба сәтті жаңартылды!');
    }

    public function destroy($id)
    {
        $project = EcoProject::findOrFail($id);
        $project->delete();

        return redirect()->route('eco-projects.index')
            ->with('success', 'Эко-жоба сәтті жойылды!');
    }
}
