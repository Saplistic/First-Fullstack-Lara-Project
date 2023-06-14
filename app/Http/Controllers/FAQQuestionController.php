<?php

namespace App\Http\Controllers;

use App\Models\FAQQuestion;
use App\Models\FAQCategory;
use Illuminate\Http\Request;

class FAQQuestionController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create($category_id)
    {
        return view('FAQ.create', compact('category_id'));
    }

    /**
     * Store a newly created resource in storage.
     */

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $question = FAQQuestion::findOrFail($id);
        return view('FAQ.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = FAQQuestion::findOrFail($id);
        $category->delete();
        // FAQQuestion::where('id', '=', $category->id)->delete();

        return redirect('FAQ')->with('status', 'Question deleted');
    }
}
