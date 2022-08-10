@extends('Admin.layout.main')
@section('content')
<div class="  my-3">
    <h3 class="lead">Employee Licence</h3>
</div>
<div class="row">
<div class="col-3  ">
    <div class="card">
        <div class="card-body">
             <h5>Upload</h5>
            <br>
            <form method="post" action="{{ url('add/licence') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Employee </label> 
                       
                        <select name="employee-id" class="form-control select employee-dropdown">
                        
                        </select> 
                    </div>
                    <div class="form-group">
                        <label for="">Attachment</label>
                        <input type="file" name="attachment" class="form-control"> 
                    </div>
                   
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check mr-1"></i>
                        Save
                        </button>
                    </div> 
            </form>
        </div>
    </div>
</div>

<div class="col-9 card bg-white">
    <div class="card-body">
        <table class="table table-sm border">
                <thead> 
                    <tr>
                        <td>Action</td>
                        <td>Employee</td>
                        <td>Licence</td>
                    </tr>
                </thead>
                <tbody>
                 @foreach($result as $values)
                <tr>
                   <td style="width: 2cm;">
                    <a href="javascript:void(0)" 
                    class="dropdown-item btn btn-outline-danger delete-emp-licence" 
                    code="{{$values->id}}">
                        <i class="fa fa-trash-o m-r-5"></i>
                        Delete
                    </a>
                        
                        <a  href="javascript:void(0)" code="{{$values->id}}" 
                            class="dropdown-item btn-outline-info view-emp-licence" 
                            data-toggle="modal" data-target="#view-modal" >
                            <i class="fa fa-eye m-r-5"></i> 
                            View
                        </a>
                         
                    </td>

                    <td>{{$values->first_name.' '.$values->last_name}}</td>
                    <td>
                        <img src="{{url('public/storage/licence').'/'.$values->emp_licence }}" 
                             width="100px" class='img'/>
                    </td>
                </tr>
                @endforeach
                </tbody>
        </table>
    </div>
</div> 
    

</div>

<div>
   
<!-- Modal -->
<div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title lead" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="view-body">
           
        </div>
        <div class="image" style="width : 3in; height: 3in;">
            
        </div>     
           
      <div class="text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
      </div>
      </div>
    
    </div>
  </div>
</div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table" id="data-table">
            <thead>
                <tr>
                    <td>
                        id
                    </td>
                    <td>
                        name
                    </td>
                    <td>
                        action
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    
    $('.table').DataTable();

  
    
    
    $.get("{{url('employee/list')}}", function(data ,status){
        $('.emp-list').empty();
          $.each(data, function(key ,value){ 
                $id = value.employee_id;
                $row = '<option value="'+$id+'">'+value.first_name+' '+value.last_name+'</option>';
                $('.employee-dropdown').append($row);
                
            }); 
    });
    

    $('.delete-emp-licence').click(function(){ 
        $id = $(this).attr('code');   
        $.ajax({
            type : "POST",
            url : "{{ url('delete/licence') }}",
            data : {id: $id},

            success: function(data){
                location.reload();
                toastr.error('Licence Deleted');
            }
        }); 
    });
    

    $('.view-emp-licence').click(function(){
        $id = $(this).attr('code');
        $('.view-body,.image').empty();
        $.ajax({
            type :"POST",
            url : '{{ url("licence/view")}}', 
            data: {id: $id},
            dataType: 'Json',

            success : function(data){
                $.each(data, function(key,value){
                     
                        $url = '{{url("public/storage/licence")}}'+'/'+value.emp_licence;   

                        $row = "<table class='table table-lg'>";
                        $row += "<tr><td>First Name</td><td>"+value.first_name+"</td></tr>";
                        $row += "<tr><td>Last Name</td><td>"+value.last_name+"</td></tr>";
                        $row += "<tr><td>Email</td><td>"+value.email+"</td></tr>";
                        $row += "<tr><td>Company</td><td>"+value.trading_name+"</td></tr>";
                        $row += "</table>";

                        $('.view-body').append($row);
                        $('.image').append('<img src='+$url+' width="100%" class="rounded"></img>');
                });
            }
        });
    });    
        

       
    
 
    
});
</script>
@endsection