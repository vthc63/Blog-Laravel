@include('admin.header')

@include('admin.sidebar')

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{$page_title}}</h2>   
                    <a href="{{url('register')}}">
                        <button style="float: right;" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add User
                        </button>    
                    </a>
                </div>
            </div>              
                 <!-- /. ROW  -->
                <hr />
            
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @if($rows)
                            @foreach($rows as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{date("jS M Y", strtotime($row->created_at))}}</td>
                                    <td>
                                        <a href="{{url('admin/users/'.$row->id.'/edit')}}">
                                            <button class="btn btn-success"><i class="fa fa-edit"></i> Edit</button> 
                                        </a>
                                        <form action="{{ route('users.destroy', $row->id) }}" method="GET">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-warning"><i class="fa fa-trash-o"></i> Delete</button>    
                                        </form>
                                        <!-- <a href="{{url('admin/users/'.$row->id)}}"> -->
                                        <!-- </a>                                      -->
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table> 
                <span align="center">{{$rows->links()}}</span> 
                 <!-- /. ROW  -->           
        </div>
             <!-- /. PAGE INNER  -->
    </div>
         <!-- /. PAGE WRAPPER  -->
</div>

@include('admin.footer')
