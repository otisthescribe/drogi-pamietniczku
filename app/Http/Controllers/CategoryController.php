<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::get();
        return view('categories.list', compact('categories'));
    }

    public function add()
    {
        return view('categories.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Validate name
            'color' => 'required|string|size:7', // Validate color
            'icon_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Create a new category instance
        $category = new Category();
        $category->name = $request->name;
        $category->color = $request->color;

        // Handle the uploaded file
        if ($request->hasFile('icon_path')) {
            // Get the uploaded file
            $file = $request->file('icon_path');
            
            // Define the path for storage
            $path = 'icons/' . time() . '_' . $file->getClientOriginalName(); // Unique file name

            // Store the file content in the specified path
            Storage::disk('public')->put($path, file_get_contents($file));

            // Save the path to the database
            $category->icon_path = $path;
        }

        // Save the category to the database
        $category->save();

        return redirect()->route('admin.categories')->withSuccess("Kategoria '$request->name' została stworzona!");
    }

    public function edit($id)
    {
        // Retrieve the category by its ID
        $category = Category::findOrFail($id);
        
        // Pass the category to the edit view
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Find category
        $category = Category::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|size:7', // Validate color format (#RRGGBB)
            'icon_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);
    
        // Handle the uploaded file
        if ($request->hasFile('icon_path')) {
            // Delete the old icon if it exists
            if ($category->icon_path) {
                Storage::disk('public')->delete($category->icon_path);
            }
    
            // Get the uploaded file
            $file = $request->file('icon_path');

            // Define the path for storage
            $path = 'icons/' . time() . '_' . $file->getClientOriginalName(); // Unique file name

            // Store the file content in the specified path
            Storage::disk('public')->put($path, file_get_contents($file));

            // Save the new path to the database
            $category->icon_path = $path; 
        }
    
        // Update the category with the new data
        $category->update($request->only('name', 'color'));
    
        return redirect()->route('admin.categories')->withSuccess("Kategoria '$category->name' została zaktualizowana!");
    }

    public function destroy($id)
    {
        // Find and delete category
        $category = Category::find($id);

        // Check if there are any events associated with this category
        $hasEvents = Event::where('category_id', $id)->exists();

        if ($hasEvents) {
            return redirect()->route('admin.categories')->withErrors("Kategoria '$category->name' jest używana przez wydarzenia.");
        }

        // Delete the associated icon if it exists
        if ($category->icon_path) {
            // Use the Storage facade to delete the file
            Storage::disk('public')->delete($category->icon_path);
        }
        
        // Delete the category
        $category->delete();

        return redirect()->route('admin.categories')->withSuccess("Kategoria '$category->name' została usunięta!");
    }
}
