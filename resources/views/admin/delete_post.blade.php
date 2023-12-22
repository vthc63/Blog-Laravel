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
                    <h4 class="alert alert-danger" align= 'center'>Are you sure you want to delete this post?</h5>
                    <form method="post" action="{{ route('posts.destroy', $row->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('delete')

                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Post Title</label>
                            <div class="col-sm-10">
                                <input disabled value="{{$row->title}}" id="title" type="text" class="form-control" placeholder="Title" name="title" autofocus> <br>                            
                            </div>                        
                        </div>
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Featured Image</label>
                            <div class="col-sm-10"> 
                                <img src="{{url('uploads/'.$row->image)}}" style="width: 150px;">   
                            </div>
                        </div>
                        
                        <div class="col-sm-10"> 
                            <a href="{{url('admin/posts')}}">
                                <input class="btn btn-secondary" type="button" value="Back">                                                                                        
                            </a>      
                            <input class="btn btn-danger" type="submit" value="Delete">                                                        
                        </div>

                    </form>   
                @else
                    <h4 class="alert alert-danger" align= 'center'>Sorry, Could not find that Post.</h5>
                    <a href="{{url('admin/posts')}}">
                        <input class="btn btn-secondary" type="button" value="Back">                                                                                        
                    </a>
                @endif
                 <!-- /. ROW  -->           
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