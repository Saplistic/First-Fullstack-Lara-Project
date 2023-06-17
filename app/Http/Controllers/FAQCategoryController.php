<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQCategory;
use Illuminate\Support\Facades\Auth;

class FAQCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FAQCategory::with('questions')->get();
        // $categories = FAQCategory::orderBy('id', 'desc')->get();
        // $categories = FAQCategory::all();
        // dd(FAQCategory::all);

        return view('FAQ.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|unique:f_a_q_categories,name'
        ]);


        $category = new FAQCategory;
        $category->name = $validated['name'];
        $category->save();
        return redirect()->route('FAQs')->with('status', 'Category succesfully created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|unique:f_a_q_categories,name'
        ]);
        $category = FAQCategory::findOrFail($id);
        $category->name = $validated['name'];
        $category->save();
        return redirect()->route('FAQs')->with('status', 'Category succesfully changed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = FAQCategory::findOrFail($id);
        $category->delete();

        return redirect('FAQ')->with('status', 'Category deleted');
    }
}