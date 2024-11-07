<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->with('user')->orderBy('start_date')->get();
        return view('events.index', compact('events'));
    }

    public function list()
    {
        $events = Event::with('category')->with('user')->orderBy('start_date')->get();
        return view('events.list', compact('events'));
    }

    public function add()
    {
        $categories = Category::all();
        return view('events.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Handle the uploaded image
        $imagePath = null; // Initialize imagePath

        if ($request->hasFile('image_path')) {
            // Get the uploaded file
            $file = $request->file('image_path');

            // Define the path where the file will be stored
            $path = 'events/' . time() . '_' . $file->getClientOriginalName(); // Unique file name

            // Store the file content in the specified path
            Storage::disk('public')->put($path, file_get_contents($file));

            // Save the path to the database
            $imagePath = $path;
        }

        Event::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.events')->with('success', 'Event created successfully.');
    }

    public function edit($id)
    {
        // Retrieve the event by its ID
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, $id)
    {

        // Find event
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Handle the uploaded image
        if ($request->hasFile('image_path')) {
            // Delete the old image if it exists
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            
            // Store the new file
            $file = $request->file('image_path');

            // Define the path where the file will be stored
            $path = 'events/' . time() . '_' . $file->getClientOriginalName(); // Unique file name

            // Store the file content in the specified path
            Storage::disk('public')->put($path, file_get_contents($file));

            // Save the path to the database
            $event->image_path = $path;
        }

        // Update the event with the new data
        $event->update($request->only('title', 'description', 'start_date', 'end_date'));

        return redirect()->route('admin.events')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        // Find the event
        $event = Event::find($id);

        // Check if the event exists
        if (!$event) {
            return redirect()->route('events.index')->withErrors('Event not found.');
        }

        // Delete the image if it exists
        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }

        // Delete the event
        $event->delete();

        return redirect()->route('admin.events')->withSuccess("Wydarzenie '$event->title' zostało usunięte!");
    }
}
