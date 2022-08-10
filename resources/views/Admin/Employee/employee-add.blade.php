@extends('Admin.layout.main')
@section('content')

<div class="content my-3">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="row">
                <div class="col">
                     <h4 class="page-title">Add Employee</h4>
                </div>
                <div class="col">
                    <a href="javascript:void(0)" class="btn btn-primary   float-right back">
                    <i class="fa fa-angle-left custom mr-1"></i> Back</a>
                </div>
            </div> 
        </div> 
    </div>
</div>
<div class="p-1">
    <div class="row my-3 mb-5 ">
        <div class="col-lg-8 offset-lg-2">
            <form method='post' action="{{ url('add/employee') }}" enctype="multipart/form-data">
                @csrf
                 <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="first-name" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last-name" placeholder="Last Name">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" placeholder="Email">
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
                            <input  class="form-control datetimepicker" name="dob" placeholder="Date of Birth">
                           
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
                        <input class="form-control" type="text" name="phone" placeholder="Contact number">
                    </div>
                    </div>
                   
                    <div class="col ">
                        <div class="form-group">
                            <label>Date of Joining 
                                <span class="text-danger"></span>
                            </label>
                            
                            <input type="text" class="form-control datetimepicker" name="date-of-join" placeholder="Date of Joining">
                        </div>
                    
                </div>
                </div>
                <div class="row">
                     <div class="col">
                    <div class="form-group">
                        <label>Avatar</label>
                        <div class="profile-upload">    
                            <div class="upload-input">
                                <input type="file" class="form-control" name="image" onchange="PreviewImage(this)">
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
                <div class="row">
                
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control select" name="country">
                               @foreach($country as $value)
                               <option>{{$value->country}}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" placeholder="City">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label>State/Province</label>
                            <input type="text" class="form-control" name="state" placeholder="State / Province">
                           <!--  <select class="form-control" name="state">
                                <option>California</option>
                                <option>Alaska</option>
                                <option>Alabama</option>
                            </select> -->
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" class="form-control" name="postal-code" placeholder="Postal Code">
                        </div>
                    </div>
                </div>
                    
             

                <div class="row">
                    <div class="col">
                    
                        <div class="form-group">
                            <label>Address</label>
                           <input class="form-control" placeholder="Address" name="address">
                        </div>
                   
                    </div>
                </div>
                     
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn ">Save</button>
                </div> 
            </form>  
        </div> 
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script type="text/javascript">
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
     @if (Session::has('message'))
        toastr.success('{{ Session::get('message') }}');
        @elseif(Session::has('message'))
            toastr.error('{{ Session::get('message') }}');
        @endif
$(document).ready(function(){
    

    $('.back').click(function(){
        window.location.href = "{{ url('employee') }}";
        
    });

    $('#upload').submit(function(e){
        e.preventDefault();
         
         $.ajax({
                url : "{{ url('employee/store') }}",
                method: "POST",
                dataType: "Json",
                
                contentType: false,
                cache: false,
                processData :false,

                data : new FormData(this),

                success: function(data){
                     
                    if(data == true){
                        toastr.success('Processing........', 'Employee Added', {
                            timeOut: 1000,
                            preventDuplicates: true,
                            
                            // Redirect 
                            onHidden: function() {
                                window.location.href = "{{ url('employee') }}"; 
                            }
                        });
                      
                    }
                   
                }
                 
            });
    });
});
</script>
@endsection