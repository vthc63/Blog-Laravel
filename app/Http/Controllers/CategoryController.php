<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $rows = $category->paginate(10);
                $data['rows'] = $rows;
                $data['page_title'] = 'Categories';

                return view('admin.categories', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_category', ['page_title'=>'New Category']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category' => 'required|string',
        ]);

        $data['category'] = $request->input('category');
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        $category->insert($data);

        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Category::find($id);

        return view('admin.delete_category', [
            'page_title'=>'Delete Category',
            'row' => $row,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $row = Category::find($id);

                return view('admin.edit_category', [
                    'page_title'=>'Edit Category',
                    'row' => $row,
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'required',
        ]);

        $data['category'] = $request->category;
        $data['updated_at'] = Carbon::now();

        Category::where('id', $id)->update($data);  
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Category::find($id);
        $row->delete();
        return redirect('admin/categories');
    }
}
