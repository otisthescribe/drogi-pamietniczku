<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('categories.index', compact('categories'));
    }

    public function list()
    {
        $categories = Category::get();
        return view('categories.list', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string',
            'icon_path' => 'nullable|url',
        ]);

        Category::create([
            'name' => $request->name,
            'color' => $request->color,
            'icon_path' => $request->icon_path,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string',
            'icon_path' => 'nullable|url',
        ]);

        $category->update($request->only('name', 'color', 'icon_path'));

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
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
        
        // Delete the category
        $category->delete();

        return redirect()->route('admin.categories')->withSuccess("Kategoria '$category->name' została usunięta!");
    }
}
