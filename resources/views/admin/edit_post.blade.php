@include('admin.header')

<link href="{{url('summernote/summernote-lite.min.css')}}" rel="stylesheet" />

@include('admin.sidebar')

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{$page_title}}</h2>   
                </div>
            </div>              
                 <!-- /. ROW  -->
                <hr />
                @if($row)
                    <form method="post" action="{{ route('posts.update', $row->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Post Title</label>
                            <div class="col-sm-10">
                                <input value="{{$row->title}}" id="title" type="text" class="form-control" placeholder="Title" name="title" autofocus> <br>
                                @error('title')
                                    <span class="alert alert-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Featured Image</label>
                            <div class="col-sm-10">
                                <input id="file" type="file" class="form-control" name="file"> <br> 
                                <img src="{{url('uploads/'.$row->image)}}" style="width: 150px;">
                                @error('file')
                                    <span class="alert alert-danger">{{$message}}</span>
                                @enderror    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-2 col-form-label">Post category</label>
                            <div class="col-sm-10">
                                <select id="category_id" name="category_id" class="form-control">
                                    <option value="{{$category->id}}">{{$category->category}}</option>
                                    @foreach($categories as $cate)
                                        <option value="{{$cate->id}}">{{$cate->category}}</option>
                                    @endforeach
                                </select> <br>   
                                @error('category_id')
                                    <span class="alert alert-danger">{{$message}}</span>
                                @enderror         
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="summernote" class="col-sm-2 col-form-label">Post content</label>
                            <div class="col-sm-10">
                                <textarea id="summernote" name="content">{{$row->content}}</textarea>
                                <br>
                                @error('content')
                                    <span class="alert alert-danger">{{$message}}</span>
                                @enderror                      
                            </div>
                        </div>
                        <div class="col-sm-10"> 
                            <input class="btn btn-primary" type="submit" value="Save">                                                        
                            <a href="{{url('admin/posts')}}">
                                <input class="btn btn-secondary" type="button" value="Back">                                                                                        
                            </a>                        
                        </div>
                    </form>  
                @else
                    <h4 class="alert alert-danger" align= 'center'>Sorry, Could not find that Post.</h5>
                    <a href="{{url('admin/posts')}}">
                        <input class="btn btn-secondary" type="button" value="Back">                                                                                        
                    </a>
                @endif 
                 <!-- /. ROW             -->
        </div> 
             <!-- /. PAGE INNER  -->
    </div>
         <!-- /. PAGE WRAPPER  -->
</div>

@include('admin.footer')

<script src="{{url('summernote/summernote-lite.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({height:400});
    });
</script>