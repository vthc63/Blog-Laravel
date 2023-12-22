<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    public function index(Request $request, $slag = ''){
        $image = new Image();

        $row = Post::where('slag', $slag)->first();

        if($row){
            $category = Category::where('id', $row->category_id)->first();
            $row->image = $image->get_thumb_cover('uploads/'.$row->image);

            $data['category'] = $category;
            $data['row'] = $row;
        }

        $categories = Category::all();

        $data['categories'] = $categories;

        return view('single', $data);
    }
}
