<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);
        $category = Category::create([
            'name' => $request['name']
        ]);
        return redirect()->back()->with('success', 'Вы успешно создали новую категорию');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = Category::findOrFail($request['id']);
        $problems = Problem::where('category_id', $id->id)->get();
        foreach ($problems as $problem) {
            if ($problem->imgBefore) {
                Storage::disk('public')->delete('problems/' . $problem->imgBefore);
            }
            if ($problem->imgAfter) {
                Storage::disk('public')->delete('problems/' . $problem->imgAfter);
            }
        }
        $id->delete();
        return redirect()->back()->with('success', 'Вы успешно удалили категорию');
    }
}
