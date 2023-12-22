@include('admin.header')

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
                    <form method="POST" action="{{ route('categories.update', $row->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category name</label>
                            <div class="col-sm-10">
                                <input value="{{$row->category}}" id="category" type="text" class="form-control" name="category" placeholder="Category name" autofocus> <br>
                                @error('category')
                                    <span class="alert alert-danger">{{$message}}</span>
                                @enderror
                            </div>                        
                        </div>
                        
                        <div class="col-sm-10"> 
                            <input class="btn btn-primary" type="submit" value="Save">                                                        
                            <a href="{{url('admin/categories')}}">
                                <input class="btn btn-secondary" type="button" value="Back">                                                                                        
                            </a>                        
                        </div>
                    </form>    
                @else
                    <h4 class="alert alert-danger" align= 'center'>Sorry, Could not find that category.</h5>
                    <a href="{{url('admin/categories')}}">
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

