<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::where('position', '=', 0)->get();
        return view('backend.category.index',[
            'data'=>$data,
        ]);
    }

    public function auto_data_in_json()
    {
        $data = Category::where('position', '=', 0)->get();

        return $data;
        // return response()->json([
        //     'autodata'=>$data,
        // ]);
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
            'name'=>'required'
        ]);
        Category::insert([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'icon'=>$request->icon,
            'parent_id'=>0,
            'position'=>0,
            'priority'=>$request->priority,
            'created_at'=>Carbon::now(),
        ]);
        return back();
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
        $category = Category::where('parent_id', '=', 0)->get();
        $data = Category::where('parent_id', '!=', 0)->get();
        return view('backend.category-sub.edit',[
            'category'=>$category,
            'data'=>$data,
        ]);
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
        Category::findOrFail($id)->delete();
        return back();
    }

    public function home_status($id, $status)
    {
        Category::where('id', '=', $id)->update([
            'home_status'=>$status,
        ]);
        return back();
    }
}
