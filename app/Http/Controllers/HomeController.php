<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request) {
        //search for post title
        if($request->input('find')){

            $title = '%' . $request->input('find') . '%';

            $rows = DB::table('posts')
                        ->join('categories', 'posts.category_id', '=', 'categories.id')
                        ->select('posts.*', 'category')
                        ->where('title', 'like', $title)
                        // ->get();
                        ->paginate(16);

        }               
        else {
            //search for category
            if($request->input('cate')){

                $rows = DB::table('posts')
                            ->join('categories', 'posts.category_id', '=', 'categories.id')
                            ->select('posts.*', 'category')
                            ->where('category_id', '=', $request->input('cate'))
                            // ->get();
                            ->paginate(16);
            }               
            else{
                $rows = DB::table('posts')
                        ->join('categories', 'posts.category_id', '=', 'categories.id')
                        ->select('posts.*', 'category')
                        // ->get();
                        ->paginate(16);
            }
        }
        
        $image = new Image();
        
        foreach($rows as $key => $row){
            $rows[$key]->image = $image->get_thumb_post('uploads/'.$row->image);
        }

        $categories = Category::all();
                
        $data['rows'] = $rows;
        $data['page_title'] = 'Home';
        $data['categories'] = $categories;

        return view('index', $data);
    }

    // public function logout(){
    //     Auth::logout();
        //search for post title
        // if($request->input('find')){

        //     $title = '%' . $request->input('find') . '%';

        //     $rows = DB::table('posts')
        //                 ->join('categories', 'posts.category_id', '=', 'categories.id')
        //                 ->select('posts.*', 'category')
        //                 ->where('title', 'like', $title)
        //                 // ->get();
        //                 ->paginate(16);

        // }               
        // else {
        //     //search for category
        //     if($request->input('cate')){

            //     $rows = DB::table('posts')
            //                 ->join('categories', 'posts.category_id', '=', 'categories.id')
            //                 ->select('posts.*', 'category')
            //                 ->where('category_id', '=', $request->input('cate'))
            //                 // ->get();
            //                 ->paginate(16);
            // }               
            // else{
                // $rows = DB::table('posts')
                //         ->join('categories', 'posts.category_id', '=', 'categories.id')
                //         ->select('posts.*', 'category')
                //         // ->get();
                //         ->paginate(16);
            // }
        // }
        
    //     $image = new Image();
        
    //     foreach($rows as $key => $row){
    //         $rows[$key]->image = $image->get_thumb_post('uploads/'.$row->image);
    //     }

    //     $categories = Category::all();
                
    //     $data['rows'] = $rows;
    //     $data['page_title'] = 'Home';
    //     $data['categories'] = $categories;
    //     return view('auth.index', $data);
    // }
}
