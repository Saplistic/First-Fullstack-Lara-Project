<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQCategory;
use App\Models\FAQQuestion;
use Illuminate\Support\Facades\Auth;

class FAQCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin', ['except' => ['index']]);
    }

    public function index()
    {
        $categories = FAQCategory::with('questions')->get();
        
        return view('FAQ.index', compact('categories'));
    }

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

    public function destroy($id)
    {
        $category = FAQCategory::findOrFail($id);
        FAQQuestion::where('category_id', '=', $category->id)->delete();
        $category->delete();

        return redirect('FAQ')->with('status', 'Category deleted');
    }
}