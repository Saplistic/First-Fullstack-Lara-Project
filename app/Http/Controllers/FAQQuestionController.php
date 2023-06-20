<?php

namespace App\Http\Controllers;

use App\Models\FAQQuestion;
use App\Models\FAQCategory;
use Illuminate\Http\Request;

class FAQQuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function create($category_id)
    {
        return view('FAQ.create', compact('category_id'));
    }

    public function store(Request $request, $category_id)
    {
        $validated = $request->validate([
            'title' => 'required|min:6',
            'answer' => 'required|min:10'
        ]);
        FAQCategory::findOrFail($category_id);

        $FAQQuestion = new FAQQuestion;
        $FAQQuestion->category_id = $category_id;
        $FAQQuestion->title = $validated['title'];
        $FAQQuestion->answer = $validated['answer'];
        $FAQQuestion->save();

        return redirect()->route('FAQs')->with('status', 'FAQ succesfully created');
    }

    public function edit($id)
    {
        $question = FAQQuestion::findOrFail($id);
        return view('FAQ.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = FAQQuestion::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|min:6',
            'answer' => 'required|min:10'
        ]);


        $question->title = $validated['title'];
        $question->answer = $validated['answer'];
        $question->save();
        return redirect()->route('FAQs')->with('status', 'FAQ succesfully updated');
    }

    public function destroy($id)
    {
        $category = FAQQuestion::findOrFail($id);
        $category->delete();

        return redirect()->route('FAQs')->with('status', 'FAQ deleted');
    }
}