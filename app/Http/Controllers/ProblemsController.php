<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProblemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexPage()
    {
        $problems = Problem::where('status', 'Решена')->orderBy('updated_at', 'desc')->take(4)->get();
        $count = Problem::where('status', 'Решена')->count();
        return view('/', compact('problems', 'count'));
    }

    public function profilePage(Request $request)
    {
        $categories = Category::all();
        $status = $request['status'];
        $query = Problem::query();
        if ($status) {
            $query->where('status', $status);
        }
        $query->orderBy('created_at', 'desc');
        if (auth()->user()->hasRole('Admin')){
            $problems = $query->get();
        } else {
            $problems = $query->where('user_id', auth()->id())->get();
        }
        return view('profile', compact('categories',  'problems'));
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|string',
            'reason' => 'nullable|string',
            'imgAfter' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $problem = Problem::findOrFail($request['id']);

        if ($request['status'] == 'Решена'){
            $imgAfter = $request->file('imgAfter');
            $name = pathinfo($imgAfter->getClientOriginalName(), PATHINFO_FILENAME);
            $imgName = $name . '_' . now()->format('YmdHis') . '.' . $imgAfter->getClientOriginalExtension();
            $imgAfter->storeAs('problems', $imgName, 'public');
            $problem->imgAfter = $imgName;
        } elseif ($request['status'] == 'Отклонена') {
            $problem->reason = $request['reason'];
        }
        $problem->status = $request['status'];
        $problem->updated_at = now();
        $problem->save();
        return redirect()->back()->with('success', 'Статус заявки успешно изменен');
    }

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
            'description' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'imgBefore' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $imgBefore = $request->file('imgBefore');
        $name = pathinfo($imgBefore->getClientOriginalName(), PATHINFO_FILENAME);
        $imgName = $name . '_' . now()->format('YmdHis') . '.' . $imgBefore->getClientOriginalExtension();

        $problem = Problem::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'imgBefore' => $imgName,
            'user_id' => auth()->id(),
        ]);
        $imgBefore->storeAs('problems', $imgName, 'public');

        return redirect()->back()->with('success', 'Вы успешно создали заявку');
    }

    /**
     * Display the specified resource.
     */
    public function show(Problem $problem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Problem $problem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Problem $problem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $problem = Problem::findOrFail($request['id']);

        Storage::disk('public')->delete('problems/' . $problem->imgBefore);
        $problem->delete();
        return redirect()->back()->with('success', 'Вы успешно удалили заявку');
    }
}
