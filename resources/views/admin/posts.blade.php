@include('admin.header')

@include('admin.sidebar')

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{$page_title}}</h2>   
                    <a href="{{url('admin/posts/create')}}">
                        <button style="float: right;" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add Post
                        </button>    
                    </a>
                </div>
            </div>              
                 <!-- /. ROW  -->
                <hr />
            
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Featured Image</th>
                        <th>Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @if($rows)
                            @foreach($rows as $row)
                                <tr>
                                    <td>{{$row->title}}</td>
                                    <td>{{$row->category}}</td>
                                    <td><img src="{{url($row->image)}}" alt="Image" style="width: 150px;"></td>
                                    <td>{{date("jS M Y", strtotime($row->created_at))}}</td>
                                    <td>
                                        <a href="{{url('admin/posts/'.$row->id.'/edit')}}">
                                            <button class="btn btn-success"><i class="fa fa-edit"></i> Edit</button> 
                                        </a>
                                        <a href="{{url('admin/posts/'.$row->id)}}">
                                            <button class="btn btn-warning"><i class="fa fa-trash-o"></i> Delete</button>    
                                        </a>                                     
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>  
                 <!-- /. ROW  -->  
                <span align="center">{{$rows->links()}}</span>         
        </div>
             <!-- /. PAGE INNER  -->
    </div>
         <!-- /. PAGE WRAPPER  -->
</div>

@include('admin.footer')

