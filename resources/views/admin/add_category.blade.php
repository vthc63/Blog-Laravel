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
            
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label">Category name</label>
                        <div class="col-sm-10">
                            <input value="{{old('category')}}" id="category" type="text" class="form-control" placeholder="Category" name="category" autofocus> <br>
                            @error('category')
                                <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>                
                    </div>
                    
                    <div class="col-sm-10">                        
                        <button class="btn btn-secondary">
                            <a href="{{url('admin/categories')}}">Back</a>
                        </button>
                        <input class="btn btn-primary" type="submit" value="Add">                                                        
                    </div>

                </form>    
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