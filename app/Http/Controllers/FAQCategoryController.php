<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQCategory;
use Illuminate\Support\Facades\Auth;

class FAQCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = FAQCategory::orderBy('id', 'desc')->get();
        // $categories = FAQCategory::with('questions')->get();
        $categories = FAQCategory::all();
        // dd(FAQCategory::all);

        return view('FAQ.index', compact('categories'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
