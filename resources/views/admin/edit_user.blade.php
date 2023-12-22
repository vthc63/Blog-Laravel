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
                    <form method="POST" action=" {{ route('users.update', $row->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">User name</label>
                            <div class="col-sm-10">
                                <input value="{{$row->name}}" id="name" type="text" class="form-control" name="name" placeholder="User name" autofocus> <br>
                                @error('name')
                                    <span class="alert alert-danger">{{$message}}</span>
                                @enderror
                            </div>                        
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input value="{{$row->email}}" id="email" type="text" class="form-control" name="email" placeholder="Email" autofocus> <br>
                                @error('email')
                                    <span class="alert alert-danger">{{$message}}</span>
                                @enderror
                            </div>                        
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input value="" id="password" type="text" class="form-control" name="password" placeholder="Password" autofocus> <br>
                            </div>                        
                        </div>
                        
                        <div class="col-sm-10"> 
                            <input class="btn btn-primary" type="submit" value="Save">                                                       
                            <a href="{{url('admin/users')}}">
                                <input class="btn btn-secondary" type="button" value="Back">                                                                                        
                            </a>                        
                        </div>
                    </form>    
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

