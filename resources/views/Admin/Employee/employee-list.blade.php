@extends("Admin.layout.main")
@section("content")
<div class="row mt-3">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Employee Management</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('emp.add') }}" class="btn btn btn-primary float-right" id="add">
        <i class="fa fa-plus mr-1"></i> Add New</a>
    </div>
</div>
<div class="row" id="table-section">
<div class="col-md-12">
<div class="card border">
<div class="card-body">
<div class="table-responsive">
    <table class="table table-sm table-bordered display compact" id="example">
    <thead>
        <tr>
            <th>Action</th>
            <th><i class="fa fa-user"></i>name</th> 
            <th>Company</th> 
            <th>Contact</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
    @foreach(@$data as $values)
        <tr>
            <td style="width: 2cm;">
                <a href="{{url('employee/delete').'/'.$values->employee_id}}" class="dropdown-item deleteEmp"
                   val="{{ $values->employee_id}}" >
                    <i class="fa fa-trash-o m-r-5"></i>
                    Delete
                </a>
                <a  href="javascript:void(0)" class="dropdown-item viewEmp"
                    
                    val="{{ $values->employee_id}}" 
                    data-toggle="modal" data-target="#view-modal" >
                    <i class="fa fa-eye m-r-5"></i> 
                    View
                </a>
                <a href="javascript:void(0)" class="dropdown-item edit-modal editEmp" 
                    id="edit-employee" val="{{$values->employee_id}}"
                    data-toggle="modal" data-target="#edit-modal"
                   >
                    <i class="fa fa-pencil m-r-5"></i> 
                    Edit
                </a> 
            </td>

            <td>
            <a href="javascript:void(0)" class="viewEmp"  val="{{ $values->employee_id}}" 
                    data-toggle="modal" data-target="#view-modal">
                <span class=""> 
                {{@$values->first_name.' '.$values->last_name}} 
                </span>
            
            <br>
            <span>
               @if($values->image == '')
               <img 
                class="img img-thumb rounded" 
                src="{{url('public/assets/img/user.jpg')}}" 
                width="70px" height="70px"
                >
               @endif

               @if($values->image)
                 <img 
                class="img img-thumb rounded" 
                src="{{url('public/storage/employee')}}/{{$values->image}}" 
                width="70px" height="70px"
                >
               @endif
                
            </span> 
            </a>
            </td>
            <td>
            <span>
                Company : {{ @$values->trading_name}}
            </span> 
           
            </td>
            <td> 
            <span>
            Contact: 
            {{@$values->emp_contact}}
            </span><br>
            <span class="text-info">Email: 
            {{@$values->email}}
            </span><br> 
            </td>
            <td> 
                 <span class="text-info"> 
            Role : {{ $values->designation_name }}
            <br>
            </span>
            <span class="text-info">  
            Department : {{ $values->department_name }} <br>
            </span>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table> 
</div>
</div>
</div>
</div>
</div>
<!-- View Modal -->
 
<div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="lead">Employee View</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body employee-view-box">
        <div class="">
            <h4 class="lead text-info">Personal Info</h4>
            <div class="container-fluid w-100">
                
            <div class="row justify-content-between"> 
                <div class="col-3 img img-thumb emp-image" style="width: 197px; height: 197px;" >
                    
                </div>
                 
                    <div class="col-9 pr-0">
                        <table class=" table personal-info table-sm" style="width:100%;">
                        
                        </table>
                    </div>   
            </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col  ">
                <table class="table table-sm emp-view-table-box">
              </table>
            </div>
        </div>
         </div>  
        <div class="modal-footer mt-3 text-right">
        <button type="button" class="btn btn-danger  "  data-dismiss="modal" >
          Close
        </button>
        </div>
    </div> 
    </div>
</div> 
<!-- End View Modal -->
<!-- start edit form --> 
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="lead">Employee Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body edit-modal-body ">
        
        <form method="post" action="{{ url('employee/update') }}" enctype="multipart/form-data">
            @csrf
             <input type='hidden' name='userid' class="user-id" >
                 <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input class="form-control" id="first-name" type="text" name="first-name"  >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" id="last-name" type="text" name="last-name"  >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" id="email" type="email" name="email"  >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company <span class="text-danger">*</span></label>
                            <select class="form-control select" name="company">
                            @foreach($company as $data)
                            <option value="{{$data->company_id}}">{{$data->trading_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                
                </div> 

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Designation <span class="text-danger">*</span></label>
                            <select class="form-control select" name='designation'>
                                @foreach($designation as $row)
                                <option value="{{$row->designation_id}}">{{$row->designation_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Department <span class="text-danger">*</span></label>
                            <select class="form-control select" name="department">
                                @foreach($department as $row)
                                <option value="{{$row->department_id}}">{{$row->department_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Date of Birth</label> 
                            <input id="dob" class="form-control date-of-birth datetimepicker" name="dob" placeholder="Date Of Birth" >
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group gender-select">
                            <label class="gen-label">Gender:</label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" name="gender" class="form-check-input" value="Male" checked>Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" name="gender" class="form-check-input" value="Female">Female
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                 
               <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phone </label>
                        <input class="form-control" id="phone" type="text" name="phone"  >
                    </div>
                    </div>
                   
                    <div class="col ">
                        <div class="form-group">
                            <label>Date of Joining <span class="text-danger"></span></label>
                            <input placeholder="Date Of Joining" 
                            type='text'
                            class="form-control date-of-joining datetimepicker" 
                            id="date-of-joining"  
                            name="date-of-join"
                            >
                        </div> 
                    </div>
                </div>
              
                <div class="row"> 
                    <div class="col-6">
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control select" name="country">
                               @foreach($country as $value)
                               <option>{{$value->country}}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6 ">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" id="city" class="form-control city" name="city"  >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>State/Province</label>
                            <input type="text" id="state" class="form-control state" name="state"  >
                          </div>
                    </div>
                    <div class="col-6 ">
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" id="zip" class="form-control zip" name="postal-code"  >
                        </div>
                    </div>
                </div> 

                <div class="row">
                   
                    <div class="col">
                        <div class="form-group">
                            <label>Image</label>
                            <div class="profile-upload">    
                                <div class="upload-input">
                                    <input type="file" class="form-control image" name="image" onchange="PreviewImage(this)">
                                </div>
                            </div>
                        </div>
                    </div> 
                     <div class="col">
                        <div class="form-group">
                            <img alt="" class="preview rounded" width="180" height="175" 
                            src="{{ url('public/assets/img/user.jpg')}}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col"> 
                        <div class="form-group">
                            <label>Address</label>
                          
                            <textarea class="form-control address" name="address" id="address" rows="5" style="resize:none;">
                                
                            </textarea>
                        </div> 
                    </div>
                </div>
                
            <div class="text-right"> 
            <button type="button" class="btn btn-danger  "  data-dismiss="modal" >
                Close
            </button>
                <button type="submit" class="btn btn-primary   ">Update</button> 
               
            </d iv>            
                
            </form>  
          
    </div>
  </div>
</div>
</div>

@if (Session::has('message'))
{{Session::get("message")}}
<script>
toastr.success("{{ Session::get('message') }}"); 
</script>        

@elseif(Session::has('message'))
<script>
toastr.success('{{ Session::get('message') }}'); 
</script> 
@endif

@if (Session::has('message'))
<script>
toastr.error('{{ Session::get('error') }}'); 
</script>        

@elseif(Session::has('message'))
<script>
toastr.error('{{ Session::get('error') }}'); 
</script> 
@endif
<!-- emd edot form --> 
@endsection
@section("javascript")
<script> 
@if(Session::has('error'))
 toastr.error('Employee Deleted');
@endif

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
    var table = $('#example').DataTable(); 
    //delete 
    $(document).on('click','.deleteEmp',function(e){
        e.preventDefault();
        $id = $(this).attr('val');
        var cfm = confirm('Do you want to delete');
        
        if(!cfm){ 
        } else {
            $.ajax({
                type :"POST",
                url : '{{ url("employee/delete")}}'+'/'+$id,
                
                dataType: 'json',
                success: function(data){ 
				 
                    if(data){
                        toastr.error('processing...', 'Deleting Employee', {
                        timeOut: 2000,
                        preventDuplicates: true, 
                        // Redirect 
                        onHidden: function() {
							location.reload();
							toastr.error('Employee Deleted');
                               
                        }
                    });
                        
                    }
                    
                }
            });
        } 
    });

    

$('.viewEmp').click(function(e){
    e.preventDefault();
    $id = $(this).attr('val'); 
    $('.emp-view-table-box').empty(); 
    $('.emp-image').empty();
            $('.personal-info').empty();   
    $.ajax({
        type :"POST",
        url : '{{ url("employee/vew")}}', 
        data: {id: $id},
        dataType: 'Json',
        success: function(response){ 
    
            $.each(response, function(key, value){
               
               
               if(value.image == null){
                $url = "{{url('public/assets/img/user.jpg')}}";
               } else {
                $url = '{{url("public/storage/employee/")}}'+'/'+value.image;
               }


                $image = '<img src="'+$url+'" class="img-thumb rounded" style="width:100%; height:100%" ></img>'; 
                
                $info = '<tr><td>First Name  </td><td>' +value.first_name+'</td></tr>';
                $info += '<tr><td>Last Name  </td><td>' +value.last_name+'</td></tr>'; 
                $info += '<tr><td>Full Name  </td><td>' +value.first_name+' '+value.last_name+'</td></tr>';  
                $info += '<tr><td> Date of Birth  </td><td>' +value.date_of_birth+'</td></tr>';
                $info += '<tr><td>Gender </td><td>' +value.gender+'</td></tr>'; 
                $info += '<tr><td>Contact </td><td>' +value.emp_contact+'</td></tr>'; 
                


                $row = '<tr><td>Company Name  </td><td colspan="2">' +value.trading_name+'</td></tr>';
                $row += '<tr><td>Employee Date of Joinning  </td><td colspan="2">' +value.date_of_joining+'</td></tr>';  
                $row += '<tr><td>Employee Department Name  </td><td colspan="2">' +value.department_name+'</td></tr>';  
                $row += '<tr><td>Employee Designation Name  </td><td colspan="2">' +value.designation_name+'</td></tr>'; 
                $row += '<tr><td>Employee Contact  </td><td colspan="2">' +value.emp_contact+'</td></tr>';  
                $row += '<tr><td class="lead text-info " colspan="2">Address</td></tr>';
                $row += '<tr><td> Address </td><td>' +value.address+'</td></tr>'; 
                $row += '<tr><td> Country  </td><td>' +value.country+'</td></tr>';
                $row += '<tr><td> State  </td><td>' +value.state+'</td></tr>'; 
                $row += '<tr><td> City </td><td>' +value.city+'</td></tr>';
                $row += '<tr><td> Zip </td><td>' +value.zipcode+'</td></tr>';  
            });

            $('.emp-image').append($image);
            $('.personal-info').append($info);
            $('.emp-view-table-box').append($row);
        }
    }); 

});

$('.editEmp').click(function(){ 
    $id = $(this).attr('val');
    
    $.ajax({  
        url : '{{ url("employee/edit") }}',
        type :"POST",
        data: {id:$id}, 
        dataType: 'Json',
        success: function(res){ 
            $.each(res , function(key, value){
                 
               
                $("input[name='userid']").val(value.employee_id); 
                $("input[name='first-name']").val(value.first_name); 
                $("input[name='last-name']").val(value.last_name); 
                $("input[name='email']").val(value.email); 
                $("input[name='phone']").val(value.emp_contact);
                $("input[name='city']").val(value.city);
                $("input[name='state']").val(value.state);   
                $("input[name='postal-code']").val(value.zipcode); 
                // $("input[name='address']").val(value.address);
                $("input[name='dob']").val(value.date_of_birth);
                $("input[name='date-of-join']").val(value.date_of_joining);
                $("input[name='address']").val(value.address);
                $('textarea').val(value.address);
                if(value.image == null){
                   $url = "{{ url('public/assets/img/user.jpg')}}"; 
                } else{
                    $url = "{{ url('public/storage/employee')}}"+"/"+value.image;    
                } 
                $('.preview').attr({'src':$url});
                 
            }); 
             
        }
    }); 
});


});
</script>
@endsection
