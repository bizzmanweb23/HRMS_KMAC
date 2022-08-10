@extends("Admin.layout.main")
@section("content")
<div class="row">
    <div class="col-sm-4 col-3">
            <h4 class="page-title">Employee Leave</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="javascript:void(0)" class="btn btn btn-primary float-right" id="add">
        <i class="fa fa-plus mr-1"></i> Add New</a>
 
    </div>
</div>
<div class="card add-new ">
    <div class="card-body row">
    <div class="col-8 offset-2">
    <form id='add-emp-leave' method="post" action="{{ url('add/leave') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">

        <div class="col">
            <div class="form-group">
                <label>
                    Company
                </label>
                <select name="company-id" class="form form-control select"> 
                @foreach($company as $data)
                    <option value="{{$data->company_id}}">{{$data->trading_name}}</option>
                @endforeach
                </select>
            </div>
        </div> 

        <div class="col">
            <div class="form-group">
                <label>
                    Employee
                </label>
                <select name="employee-id" class="employee-field form select"> 
                @foreach($employee as $data)
                <option value="{{$data->employee_id}}">{{$data->first_name .' '.$data->last_name }}</option>
                @endforeach
                </select>
            </div>
        </div>

        
    </div>

    <div class="row">
        <div class="col">
                <label>
                    From Date
                </label> 
            <div class="form-group cal-icon"> 
                <input type="text" class="form-control datetimepicker" placeholder="From Date" name="from-date"/>
            </div>
        </div>

        <div class="col">
            <label>
                    To Date
                </label>
            <div class="form-group cal-icon">  
                <input type="text" class="form-control datetimepicker" placeholder="To Date" name="to-date"/>
            </div>
        </div> 
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>
                    Leave Type
                </label>
                <select name="leave-type" class="form form-control select"> 
                @foreach($leavetype as $data)
                <option value="{{$data->leave_type_id}}">{{$data->type_name}}</option>
                @endforeach
                </select>
            </div>
        </div>  
    </div>
    <div class="row">
        <div class="col">
        <div class="form-group">
            <label>Attachment</label>
            <div class="profile-upload">    
                <div class="upload-input">
                    <input type="file" class="form-control image" name="certificate" onchange="PreviewImage(this)">
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
    <div class="col">
        <div class="form-group">
            <img alt="" class="preview rounded" width="180" height="175" src="{{ url('public/assets/img/user.jpg')}}">
        </div>
    </div>
    </div>
    <div class="form-group">
     
    <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="half-day" id="product_active" value="7" >
            <label class="form-check-label" for="product_active">
            Half Day
            </label>
    </div> 
    </div>

    <div class="row">
        <div class="col">
        <div class="form-group">
            <label class="display-block">Description</label>
          <textarea class="form-control" name="description">
            
          </textarea>
        </div>
        </div>
    </div>
    <div class="m-t-20 text-right">
        <button type="submit" class="btn btn-primary  ">
            <i class="fa fa-check-square mr-1"></i>
         Save</button>
    </div>
    </form>
    </div>
</div>
</div>
<div class="card">
    <div class="card-body">
    <table class="table table-sm table-bordered display compact" id="example">
<thead>
 
<th>Action</th>
<th>Document</th>
<th>Leave Type</th> 
<th>Employee</th>
<th><i class="fa fa-calendar"></i> Request Duration</th> 
<th><i class="fa fa-calendar"></i> Applied On</th>
<th>Status</th>
<th>Change Status</th> 
</thead>
<tbody>
@foreach($fields as $key => $value)
<tr>
<td>
    <a class="dropdown-item " href="{{route('delete.leave',$value->leave_id)}}" val="{{$value->leave_id}}">
    <i class="fa fa-trash mr-1"></i>    
    Delete</a>    
    <!-- <a class="dropdown-item  " href="#" val="{{$value->leave_id}}">
    <i class="fa fa-edit mr-1"></i>    
    Edit</a> -->
    <a class="dropdown-item get-emp" data-toggle="modal" data-target="#view-modal" href="javascript:void(0)" val="{{$value->leave_id}}">
    <i class="fa fa-eye mr-1"></i>    
    View</a>
    
</td>
<td>
<img src="{{ url('/public/leave').'/'.$value->leave_attachment}}" width="100" class='rounded'>
</td>   
<td>{{$value->type_name}}</td>
<td>{{$value->first_name.' '.$value->last_name}}</td>
<td>{{ $value->period }}</td>
<td>{{$value->applied_on}}</td>
<td> 
@if($value->status_id == 1)  
<a class="custom-badge status-green " href="#">
  {{$value->status_name}}
</a> 
@endif
@if($value->status_id == 2)  
<a class="custom-badge status-blue  " href="#" >
    {{$value->status_name}}
</a> 
@endif
@if($value->status_id == 3)  
<a class="custom-badge status-red " href="#">
     {{$value->status_name}}
</a> 
@endif  
</td>
<td>
<div class="dropdown ">
<a class="custom-badge status-blue dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
    Choose Action
</a>

<div class="dropdown-menu dropdown-menu-right"> 
    <a class="dropdown-item pending" href="javascript:void(0)" val="{{$value->leave_id}}" code="1" >Aproove</a>
    <a class="dropdown-item pending" href="javascript:void(0)" val="{{$value->leave_id}}" code="2" >Pending</a>
    <a class="dropdown-item pending" href="javascript:void(0)" val="{{$value->leave_id}}" code="3" >Declined</a>
</div>
</div>
</td>
</tr>
@endforeach         

</tbody>
</table>
</div>
</div> 

<!-- Modal -->
<div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Leave Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<p>
    {{Session::get('message')}}
</p>
<p>
    {{Session::get('error')}}
</p>
 
<script>
toastr.success('{{ Session::get('message') }}'); 
</script>        
 

 
<script>
toastr.danger('{{ Session::get('error') }}'); 
</script>        
 


@endsection
@section("javascript")
<script>
    function PreviewImage(input)
    {
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('.preview').attr('src',e.target.result).width(170).height(165);
            }
           reader.readAsDataURL(input.files[0]);
        }
    }
$(document).ready(function(){
 
    $('.add-new').hide();
    
    $('#add').click(function(){
        $('.add-new').slideToggle();
    });
    
    $('table').DataTable();   
    var datatable = $('#example').DataTable(); 
    
    $.ajaxSetup({
                headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //delete 
    
$(document).on('click', '.delete', function(e){
    e.preventDefault();
    var cnf = confirm('DELETED WILL NOT BE RECOVERED');
    if(!cnf){

    } else { 
    $id= $(this).attr('val');
    $.ajax({
        url: "{{ url('delete/leave') }}",
        type : "POST",
        data : {id: $id},
        dataType: "Json",
        success : function(data)
        {
            document.location.reload();
            console.log(data);
        }
    });
}
});
//view

$(document).on('click', '.get-emp', function(e){
    e.preventDefault();
    $id = $(this).attr('val');
    $('.modal-body').empty();
    $.ajax({
        url : "{{url('view/leave')}}",
        type : "post",
        dataType: "Json",
        data : {id: $id},
        dataType: 'Json',
        success: function(res)
        {
            $.each(res, function(key, value)
            { 
                $url = '{{url("public/leave")}}'+'/'+value.leave_attachment;
                $table = '<table class="table table-bordered">';
                $table += '<tr><td><span>Employee Name :</td><td>'+value.username+'</td></tr>';
                $table += '<tr><td>Company Name :</td><td>'+value.trading_name+'</td></tr>';
                $table += '<tr><td>Leave From :</td><td>'+value.from_date+'</td></tr>';
                $table += '<tr><td>Leave To :</td><td>'+value.to_date+'</td></tr>';
                $table += '<tr><td>Leave period :</td><td>'+value.period+'</td></tr>';
                $table += '<tr><td>Leave Type :</td><td>'+value.type_name+'</td></tr>';
                $table += '<tr><td colspan="2"><p>Attachment</p><img src="'+$url+'" class="rounded"></td></tr>';
                $table += '</table>';
                $('.modal-body').append($table);
            }); 
           
        }
    });
});
//change status

$('.pending').click(function(){
        var $id = $(this).attr('val');
        var $code = $(this).attr('code');
         
         $.post(
                '{{ url("change/leave/status") }}',
         {     
                id: $id,
                code: $code,
         }
         ).done(function(data)
                {
                document.location.reload();
                 
                }
        ).success(
                function(data)
                {
                        alert(data);
                }
        );
        
 });

});
</script>
@endsection
