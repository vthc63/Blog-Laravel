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
                    @if($row->id == 1)
                        <h4 class="alert alert-danger" align= 'center'>Access Denied!</h4>
                        <a href="{{url('admin/users')}}">
                            <input class="btn btn-secondary" type="button" value="Back">                                                                                        
                        </a>
                    @else
                        <h4 class="alert alert-danger" align= 'center'>Are you sure you want to delete this User?</h5>
                    
                        <form method="post">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">User name</label>
                                <div class="col-sm-10">
                                    <input disabled value="{{$row->name}}" id="name" type="text" class="form-control" name="name" autofocus> <br>                            
                                </div>                        
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input disabled value="{{$row->email}}" id="email" type="text" class="form-control" name="email" autofocus> <br>                            
                                </div>                        
                            </div>
                            
                            <div class="col-sm-10"> 
                                <a href="{{url('admin/users')}}">
                                    <input class="btn btn-secondary" type="button" value="Back">                                                                                        
                                </a>      
                                <input class="btn btn-danger" type="submit" value="Delete">                                                        
                            </div>
                        </form>   
                    @endif
                @else
                    <h4 class="alert alert-danger" align= 'center'>Sorry, Could not find that User.</h5>
                    <a href="{{url('admin/users')}}">
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
