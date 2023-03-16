<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::where('position', '=', 0)->get();
        $data = Category::where('position', '=', 1)->get();
        return view('backend.category-sub.index',[
            'category'=>$category,
            'data'=>$data,
        ]);
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
            'name'=>'required',
            'parent_id'=>'required',
        ]);
        Category::insert([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'picture'=>$request->picture,
            'parent_id'=>$request->parent_id,
            'position'=>1,
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
        $data = Category::where('id', '=', $id)->first();
        return view('backend.category-sub.edit',[
            'category'=>$category,
            'data'=>$data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'parent_id'=>'required',
        ]);
        Category::where('id','=', $request->id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'picture'=>$request->picture,
            'position'=>1,
            'parent_id'=>$request->parent_id,
            'priority'=>$request->priority,
        ]);
        return redirect()->route('admin.sub-category.index');
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
