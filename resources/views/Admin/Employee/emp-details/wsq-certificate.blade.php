@extends('Admin.layout.main')
@section('content')
<div class="  my-3">
    <h3 class="lead">Employee WSQ Certificate</h3>
</div>
<div class="row">
    <div class="col-3  ">
    <div class="card">
    <div class="card-body">
    <h4 class='lead'>
            Upload WSQ Certificate
    </h4>
    <br>
    <form method="post" action="{{ url('add/wsq') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Employee </label> 
                <input type="hidden" name="id" >
                <select name="employee"  class="form-control">
                @foreach($employees as $values)
                <option value="{{$values->employee_id}}">
                    {{$values->first_name.' '.$values->last_name}}
                </option>
                @endforeach
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
                <th>
                Action
                </th>
                <th>
                Employee
                </th> 
                <th>Certificate No</th>
                <th>
                Attachment
                </th>
            </thead>
            <tbody>
            @foreach($result as $values)
            <tr>
               <td style="width: 2cm;">
                    <a href="javascript:void(0)" 
                        val="{{$values->id}}" 
                        class="dropdown-item delete"  >
                    <i class="fa fa-trash-o m-r-5"></i>
                        Delete
                    </a>
                    <a  href="javascript:void(0)" 
                        val="{{$values->id}}" 
                        class="dropdown-item view-data" 
                        data-toggle="modal" 
                        data-target="#view-modal" 
                        
                        >
                        <i class="fa fa-eye m-r-5"></i> 
                        View
                    </a> 
                </td>

                <td>{{$values->employee_id}}</td>
                <td>{{$values->cft_number}}</td>
                <td>
                <img 
                    src=" {{ url('public/wsq') .'/'.$values->wsq_certificate }}" 
                    width="100px" class="img"/>
                </td>
            </tr>
            @endforeach
            </tbody>
    </table>
    </div>
    </div> 
</div>

<div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title lead" id="exampleModalLabel">Employee WSQ Certifate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body view-modal-box">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
    }); 
   
    $('.table').DataTable();
   
    $('.delete').click(function(){
        $id = $(this).attr('val');
        $cnf = confirm('Deleted can not be recovered');
        if(!$cnf){
            
        } else {
           
            $.ajax({
                url : "{{url('delete/wsq') }}",
                method: "POST",
                data : {id: $id},
                dataType: "Json",
                success: function(data){
                document.location.reload();
                }
            });
        }
    });
    
    //view
    $('.view-data').click(function(){
        var id = $(this).attr('val');
        $('.view-modal-box').empty();
     
        $.ajax({
            url: '{{url("view/wsq")}}',
            type: 'POST',
            data : {id: id},
            dataType: 'Json' ,
            success : function(data)
            {
                $.each(data, function(key,value){
                    
                    $path = "{{url('public/wsq')}}"+"/"+value.wsq_certificate; 
                    
                    $row = "<table class='table table-sm table-bordered'>"; 
                    $row += "<tr><td colspan='2' rowspan='5'><p>Certificate</p>\n\
                            <img src='"+$path+"' width='300px' height='250px' class='img img-thumb'></img></td>";
                    $row += "<td>Name</td><td>"+value.username+"</td></tr>";
                    
                    $row += "<tr><td>Email</td><td>"+value.email+"</td></tr>";
                    $row += "<tr><td>Contact</td><td>"+value.emp_contact+"</td></tr>";
                   
                    $row += "</table>";
                    
                    $('.view-modal-box').append($row);
                });
                
            }
        });
    });
});
</script>
@endsection