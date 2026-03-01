<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('developer.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('developer.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);
        $data['slug'] = Str::slug($data['name']);
        Category::create($data);
        return redirect()->route('developer.categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    public function edit(Category $category)
    {
        return view('developer.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
        ]);
        $data['slug'] = Str::slug($data['name']);
        $category->update($data);
        return redirect()->route('developer.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('developer.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
