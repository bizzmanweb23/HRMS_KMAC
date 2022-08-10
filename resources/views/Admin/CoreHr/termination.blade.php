@extends("Admin.layout.main")
@section("content")
<div class="row mt-3">
    <div class="col-sm-4 col-3">
            <h4 class="page-title">Termination</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="javascript:void(0)" class="btn btn btn-primary  float-right" id="add">
                    <i class="fa fa-plus mr-1"></i> Add New</a>
    </div>
</div>
<div class="card add-form">
    <div class="row card-body">
        <div class="col-10 offset-1">
            <form method="post" action="{{ url('add/termination') }}" enctype="multipart/form-data">
                @csrf
                <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control form-sm company-field select" name="company">
                                @foreach($company as $values)
                                <option value="{{$values->company_id}}">{{$values->trading_name}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                   <div class="col">
                        <div class="form-group">
                            <label>Employee Terminated</label>
                            <select class="form form-control form-sm employee-field select" name="employee-terminated">
                                @foreach($employees as $values)
                                <option value="{{$values->first_name.' '.$values->last_name}}">{{$values->first_name.' '.$values->last_name}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                  
                    <div class="col">
                        <div class="form-group">
                            <label>Terminated By</label>
                            <select class="form form-control form-sm select" name="terminated-by">
                                @foreach($admin as $values)
                                <option value="{{$values->first_name.' '.$values->last_name}}">{{$values->first_name.' '.$values->last_name}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                     <div class="col">
                        <div class="form-group">
                            <label>Termination Type</label>
                            <select class="form form-control form-sm select" name="termination-type-id">
                                @foreach($terminationType as $values)
                                <option value="{{$values->termination_type_id}}">{{$values->type}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6"> <label>Notice Date</label> 
                        <div class="form-group cal-icon">
                           
                                <input type="text" class="form-control form-sm datetimepicker" name="notice-date"> 
                        </div>
                    </div>
                    <div class="col-md-6"> <label>Termination Date</label> 
                        <div class="form-group cal-icon">
                           
                                <input type="text" class="form-control form-sm datetimepicker" name="termination-date"> 
                        </div>
                    </div>
                </div>  
                <div class="row">
                   
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
                    <label>Description</label>
                    <textarea cols="30" rows="4" class="form-control" name="description"></textarea>
                </div>
                <div class="m-t-20 text-right">
                    <button type="submit" class="btn btn-primary  ">
                    <i class="fa fa-check-square mr-1"></i> 
                     Save </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="">
    <div class="row" id="table-section">
		<div class="col-md-12">
		<div class="card">
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-sm table-bordered display compact" id="example">
                <thead>
                <tr>
                <th>Action</th>
                <th><i class="fa fa-user mr-1"></i>Employee</th>
                <th>Terminated By</th>  
                <th>Company</th>
                <th>Termination Type</th>
                <th><i class="fa fa-calendar mr-1"></i>Notce Date</th> 
                <th><i class="fa fa-calendar mr-1"></i>Terminaton Date</th>

                </tr>
                </thead>
                <tbody>
            @foreach($data as $values)
            <tr>
             <td>
                <div class=" ">
               
                <div class="  ">

                    <a class="dropdown-item delete" id='delete-termination' 
                       href="javascript:void(0)" 
                       val="{{ $values->termination_id}}" 
                    >
                        <i class="fa fa-trash-o m-r-5"></i> 
                        Delete
                    </a>

                    <a class="dropdown-item view-modal-box" href="javascript:void(0)" 
                       val="{{ $values->termination_id}}" 
                        data-toggle="modal" data-target="#view-termination">
                        <i class="fa fa-eye m-r-5"></i> 
                        View</a> 
                </div>
                </div>         
            </td> 
                    <td>{{$values->employee_terminated}}</td>
                    <td>{{$values->terminated_by}}</td>
                    <td>{{$values->trading_name}}</td>
                    <td>{{$values->type}}</td>
                    <td>{{$values->notice_date}}</td>
                    <td>{{$values->termination_date }}</td>
            </tr>
            @endforeach


                </tbody>
        </table>
        </div>
        </div>
		</div>
		</div>
	</div>  
</div>


<div class="modal fade" id="view-termination" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Termination</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="view-termination">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
   
      </div>
    </div>
  </div>
</div>
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
    $('.table').DataTable(); 
    
    $('.add-form').hide();

    $('#add').click(function(){
        $('.add-form').slideToggle();
    });

    $('.view-modal-box').click(function(e){
        e.preventDefault();
        var $id = $(this).attr('val');
        $('.view-termination').empty();
        $.ajax({
            url : "{{ url('show/termination') }}",
            type : "POST",
            data : {id : $id},
            dataType:'JSON',
            success: function(res){
            $.each(res, function(i, value){
               
                $url = '{{url("public/storage/termination")}}'+'/'+value.attachment;
                $table = '<table class="table table-bordered table-lg">';
                $table += '<tr><td><span>Employee Name :</td><td>'+value.terminated_by+'</td></tr>';
                $table += '<tr><td>Company Name :</td><td>'+value.trading_name+'</td></tr>';
                $table += '<tr><td>Terminated Date :</td><td>'+value.termination_date+'</td></tr>';
                $table += '<tr><td>Terminated By :</td><td>'+value.terminated_by+'</td></tr>'; 
                $table += '<tr><td>Termination Type :</td><td>'+value.type+'</td></tr>'; 
                $table += '<tr><td colspan="2"><p>Attachment</p><img src="'+$url+'" class="rounded"></td></tr>';
                $table += '</table>';
                $('.view-termination').append($table);
                
            }); 
            }
        });      
    });
    
    $('#delete-termination').click(function(){
        var $id = $(this).attr('val');
        var form = confirm('Deleted cannot be recovered');
        if(!form){
            
        }
        else {
        $.ajax({
            url : "{{ url('delete/termination') }}",
            type : "POST",
            data : {id : $id},
            success: function(response){
                 
                $.each(response, function(key, value){
                    
                   location.reload();
                });
            }
        });
        
        }
    });
    
});
</script>
@endsection
