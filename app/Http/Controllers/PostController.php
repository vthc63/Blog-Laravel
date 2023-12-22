<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = new Image();

                // $query = "select posts.*, categories.category from posts join categories on posts.category_id = categories.id";
                // $rows = DB::select($query);

                $rows = DB::table('posts')
                            ->join('categories', 'posts.category_id', '=', 'categories.id')
                            ->select('posts.*', 'category')
                            // ->get();
                            ->paginate(5);
                
                foreach($rows as $key => $row){
                    $rows[$key]->image = $image->get_thumb('uploads/'.$row->image);
                }
                
                $data['rows'] = $rows;
                $data['page_title'] = 'Posts';

                return view('admin.posts', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

                return view('admin.add_post', [
                    'page_title'=>'New Post',
                    'categories'=>$categories,
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $folder = 'uploads/';
        if(!file_exists($folder)){
            mkdir($folder, 0777, true);
        }
        
        $validated = $request->validate([
            'title' => 'required|string',
            'file' => 'required|image',
            'category_id' => 'required',
            'content' => 'required',
        ]);


        //remove images from content
        preg_match_all('/<img[^>]+>/', $request->input('content'), $matches);
        $new_content = $request->input('content');
        $image_class = new Image();

        if(is_array($matches) && count($matches) > 0){
            foreach($matches[0] as $match){
                preg_match('/src="[^"]+/', $match, $matches2);
                $parts = explode(',', $matches2[0]);
                $filename = $folder . "base_64_" . $image_class->generate_filename(50).".jpg"; //src="{{url('uploads/'.$row->image)}}"
                $new_content = str_replace($parts[0].",".$parts[1], 'src="'.$filename, $new_content);
                file_put_contents($filename, base64_decode($parts[1]));
                
            }                  
        }
        
        $path = $request->file('file')->store('/', ['disk'=>'my_disk']);

        $data['user_id'] = Auth::id();
        $data['title'] = $request->input('title');
        $data['category_id'] = $request->input('category_id');
        $data['image'] = $path;
        $data['content'] = $new_content;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        $data['slag'] = $post->str_to_url($data['title']);

        $post->insert($data);

        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = new Post();
        $row = $post->find($id);
                if($row){
                    $category = $row->category()->first();
                }
                else {
                    $category = '';
                }
                return view('admin.delete_post', [
                    'page_title'=>'Delete Post',
                    'row' => $row,
                    'category'=>$category,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = new Post();

        $row = $post->find($id);
                if($row){
                    $category = $row->category()->first();
                }
                else {
                    $category = '';
                }
                $categories = Category::where('id', '<>', $row->category_id)->get();

                return view('admin.edit_post', [
                    'page_title'=>'Edit Post',
                    'row' => $row,
                    'category'=>$category,
                    'categories'=>$categories,
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = new Post();
        
        $validated = $request->validate([
            'title' => 'required|string',
            'file' => 'image',
            'category_id' => 'required',
            'content' => 'required',
        ]);

        $folder = 'uploads/';
        if(!file_exists($folder)){
            mkdir($folder, 0777, true);
        }

        //remove images from content
        preg_match_all('/<img[^>]+>/', $request->input('content'), $matches);
        $new_content = $request->input('content');
        $image_class = new Image();

        if(is_array($matches) && count($matches) > 0){
            foreach($matches[0] as $match){
                preg_match('/src="[^"]+/', $match, $matches2);
                $parts = explode(',', $matches2[0]);
                $filename = $folder . "base_64_" . $image_class->generate_filename(50).".jpg"; //src="{{url('uploads/'.$row->image)}}"
                $new_content = str_replace($parts[0].",".$parts[1], 'src="'.$filename, $new_content);
                file_put_contents($filename, base64_decode($parts[1]));
                
            }                  
        }

        if($request->file('file')){
            $old_row = $post->find($id);
            if(file_exists('uploads/'.$old_row->image)){
                unlink('uploads/'.$old_row->image);
            }
            $path = $request->file('file')->store('/', ['disk'=>'my_disk']);
            $data['image'] = $path;
        }

        $data['title'] = $request->input('title');
        $data['category_id'] = $request->input('category_id');
        $data['content'] = $new_content;
        $data['updated_at'] = Carbon::now();

        $post->where('id', $id)->update($data);  
        return redirect('admin/posts'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = new Post();
        $row = $post->find($id);

        if(file_exists('uploads/'.$row->image)){
            unlink('uploads/'.$row->image);
        }    
        $row->delete();

        return redirect('admin/posts');
    }
}
