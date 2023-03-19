<?php

namespace App\Http\Controllers\Admin;

use App\CustomClass\ImageUploadCustom;
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

        $id = Category::insertGetId([
            'name'=>Str::title($request->name),
            'slug'=>Str::slug($request->name),
            'parent_id'=>0,
            'position'=>0,
            'home_status'=>1,
            'priority'=>$request->priority,
            'created_at'=>Carbon::now(),
        ]);

        if ($request->picture != '') {
            $imgname = Str::slug($request->name).'-'.time().'.'.$request->picture->getClientOriginalExtension();
            ImageUploadCustom::upload('category', $imgname, $request->picture, 400);
            Category::where('id', '=', $id)->update([
                'picture'=>'category/'.$imgname,
            ]);
        }

        return response()->json([
            'success'=>'success',
        ]);
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
        $data = Category::where('id', '=', $id)->first();
        return view('backend.category.edit',[
            'data'=>$data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Category::where('id', '=', $request->id)->update([
            'name'=>Str::title($request->name),
            'slug'=>Str::slug($request->name),
            'priority'=>$request->priority,
        ]);

        if ($request->picture != '') {

            $category = Category::where('id', '=',$request->id)->first();
            if ($category->picture != '') {
                ImageUploadCustom::delete($category->picture);
            }

            $imgname = Str::slug($request->name).'-'.time().'.'.$request->picture->getClientOriginalExtension();
            ImageUploadCustom::upload('category', $imgname, $request->picture, 400);
            Category::where('id', '=', $request->id)->update([
                'picture'=>'category/'.$imgname,
            ]);
        }

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id', '=',$request->id)->first();
        if ($category->picture != '') {
            ImageUploadCustom::delete($category->picture);
        }
        $category->delete();
        return back();
    }

    public function home_status($id, $status)
    {
        Category::where('id', '=', $id)->update([
            'home_status'=>$status,
        ]);
        return back();
    }

    public function status_change(Request $request)
    {
        $category = Category::where('id', '=', $request->id)->first();

        if ($category->home_status == 0) {
            Category::where('id', '=', $request->id)->update([
                'home_status'=>1,
            ]);
        } else {
            Category::where('id', '=', $request->id)->update([
                'home_status'=>0,
            ]);
        }

        return response()->json([
            'success'=>'success',
        ]);
    }

}
