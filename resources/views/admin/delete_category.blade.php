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
                <h4 class="alert alert-danger" align= 'center'>Are you sure you want to delete this category?</h5>
                
                    <form method="post" action="{{ route('categories.destroy', $row->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category name</label>
                            <div class="col-sm-10">
                                <input disabled value="{{$row->category}}" id="category" type="text" class="form-control" name="category" autofocus> <br>                            
                            </div>                        
                        </div>
                        
                        <div class="col-sm-10"> 
                            <a href="{{url('admin/categories')}}">
                                <input class="btn btn-secondary" type="button" value="Back">                                                                                        
                            </a>      
                            <input class="btn btn-danger" type="submit" value="Delete">                                                        
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
