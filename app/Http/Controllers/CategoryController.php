<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::where('parent_id', '=', 0)->get();

        $allCategories = Category::pluck('name','id')->all();
        return view('category.index', compact('categories','allCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoties = Category::all();
        return view('category.create',['categories'=>$categoties]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $parent_id =$request->parent_id;
        $category->name = $request->name;
        if (empty($parent_id)){
            $parent_id = 0;
        }
        $category->parent_id = $parent_id;
        $category->slug = $request->name;
        $category->save();
        Session::flash('message', 'Successfully create!');
        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $category = Category::find($id);


        return view('category.edit', ['categories'=> $categories, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::find($id);

        $category->name = $request->name;
        $parent_id = 0;
        if ($request->parent_id != ""){
            $parent_id = $request->parent_id;
        }
        $category->parent_id = $parent_id;

        $cat = Category::find($request->cat_id);

        $category->save();

        Session::flash('message', 'Successfully update!');
        return redirect('/category');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $category = Category::find($id);
            $category->tasks()->delete();

            $category->delete();
            //$categories = Category::all();
//            if ($category->parent_id !=0) {
//                foreach ($categories as $cat) {
//                    if ($cat->parent_id == $category->id) {
//                        //$cat->delete();
//                    }
//                }
//            }
            //$category->delete();
            Session::flash('message', 'Successfully delete!');
            return redirect('/category');

    }
}
