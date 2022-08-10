@extends('Admin.layout.main')
@section('content')
<div class="  my-3">
    <h3 class="lead">Employee Joining Bonus</h3>
</div>
<div class="row">
    <div class="col-3  ">
    <div class="card">
    <div class="card-body">
    <h4 class='lead'>
            Upload 
    </h4>
    <br>
    <form method="post" action="{{ url('add/bonus') }}" >
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
                <label for="">Joining Bonus</label>
                <input type="text" name="joining-bonus" class="form-control" placeholder="Joining Bonus"> 
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
                <th>
                Bonus
                </th>
            </thead>
            <tbody>
            @foreach($licence as $values)
            <tr>
               <td style="width: 2cm;">
                    <a href="javascript:void(0)" 
                        val="{{$values->id}}" 
                        class="dropdown-item delete"  >
                    <i class="fa fa-trash-o m-r-5"></i>
                        Delete
                    </a>
                    <a  href="javascript:void(0)" class="dropdown-item view-bonus" 
                        data-toggle="modal" data-target="#view-modal" code="{{$values->id}}">
                        <i class="fa fa-eye m-r-5"></i> 
                        View
                    </a>
                     
                </td>

                <td>{{$values->employee_id}}</td>
                <td>
                    {{$values->joining_bonus}}
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
        <h5 class="modal-title lead" id="exampleModalLabel">Employee Joining Bonus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body view-modal-box view-box">
     
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
   
     $('.table').DataTable().rows().data();
     
   
    $('.delete').click(function(){
        $id = $(this).attr('val');
        $cnf = confirm('Deleted can not be recovered');
        if(!$cnf)
        {
            
        } 
        else 
        { 
            $.ajax({
                url : "{{url('delete/bonus') }}",
                method: "POST",
                data : {id: $id},
                dataType: "Json",
                success: function(data){
                    toastr.error('Row Deleted');
                    location.reload();
                }
            });
        }
    });
    
    //view
    $('.view-bonus').click(function(e){
        e.preventDefault();
        $id = $(this).attr('code');
       

        $.ajax({
            url : "{{url('view/bonus') }}",
            method: "POST",
            data : {id: $id},
            dataType: "Json",
            success: function(data){ 

                $.each(data, function(key,value){
                    $row = "<table class='table table-lg'>";
                    $row += "<tr><td>Employee Name : </td><td>"+value.first_name+" "+value.last_name+"</td></tr>";
                    $row += "<tr><td>Employee Bonus : </td><td>"+value.joining_bonus+"</td></tr>";
                   
                    $row += "</table>";
                   
                    $('.view-box').append($row);
                });
            }
         });

    });
});
</script>
@endsection