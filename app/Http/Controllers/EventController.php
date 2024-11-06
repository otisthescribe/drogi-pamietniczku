<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->orderBy('start_date')->get();
        return view('events.index', compact('events'));
    }

    public function list()
    {
        $events = Event::with('category')->orderBy('start_date')->get();
        return view('events.list', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image_path' => 'nullable|url',
        ]);

        Event::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->start_date,
            'image_path' => $request->image_path,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image_path' => 'nullable|url',
        ]);

        $event->update($request->only('title', 'description', 'start_date', 'end_date', 'image_path'));

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        // Find and delete category
        $event = Event::find($id);

        // Delete the category
        $event->delete();

        return redirect()->route('admin.events')->withSuccess("Wydarzenie '$event->title' zostało usunięte!");
    }
}
