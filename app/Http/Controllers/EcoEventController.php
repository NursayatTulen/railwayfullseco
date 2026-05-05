<?php

namespace App\Http\Controllers;

use App\Models\EcoEvent;
use Illuminate\Http\Request;

class EcoEventController extends Controller
{
    public function index()
    {
        $events = EcoEvent::orderBy('event_date', 'asc')->get();
        return view('eco-events.index', compact('events'));
    }

    public function create()
    {
        return view('eco-events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
        ]);

        EcoEvent::create($request->only(['title', 'description', 'event_date']));

        return redirect()->route('eco-events.index')
            ->with('success', 'Эко-іс-шара сәтті жасалды!');
    }

    public function edit($id)
    {
        $event = EcoEvent::findOrFail($id);
        return view('eco-events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
        ]);

        $event = EcoEvent::findOrFail($id);
        $event->update($request->only(['title', 'description', 'event_date']));

        return redirect()->route('eco-events.index')
            ->with('success', 'Эко-іс-шара сәтті жаңартылды!');
    }

    public function destroy($id)
    {
        $event = EcoEvent::findOrFail($id);
        $event->delete();

        return redirect()->route('eco-events.index')
            ->with('success', 'Эко-іс-шара сәтті жойылды!');
    }
}
