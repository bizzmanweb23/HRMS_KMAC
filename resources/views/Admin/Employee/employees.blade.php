@extends('Admin.layout.main')
@section('content')

<div>
<div class="content my-3">

    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Employees</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('emp.add') }}" class="btn btn-primary   float-right"><i class="fa fa-plus"></i> Add Employee</a>
        </div>
    </div>
    <div class="row doctor-grid"> 

    @foreach($employee as $values)
    
    
    <div class="col-md-4 col-sm-4  col-lg-3 m-auto">
            <div class="profile-widget">
                <div class="doctor-img">
                    <a class="avatar" href="#">
                        <img alt="" src="src="{{url('/')}}/{{$values->image}}"">
                    </a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item edit-emp" href="{{ route('emp.tab.edit',$values->employee_id) }}" code="{{$values->employee_id}}">
                            <i class="fa fa-pencil m-r-5"></i> Edit
                        </a>
						
                          <a class="dropdown-item text-danger deleteEmp" href="javascript:void(0)"
						  val="{{$values->employee_id}}"
                             >
                              <i class="fa fa-trash m-r-5"></i> Delete
                            </a>

                            
                    </div>
                </div>
                    <h4 class="doctor-name text-ellipsis">
                    <a href="profile.html">
                    {{$values->username}}
                    </a>
                    </h4>
                <div class="doc-prof">{{$values->designation_name}}</div>
                <div class="user-country">
                    <i class="fa fa-map-marker"></i> 
                   {{$values->address}}
                </div>
            </div>
        </div>
    @endforeach 
    </div>
   <!--  <div class="row">
        <div class="col-sm-12">
            <div class="see-all">
                <a class="see-all-btn" href="javascript:void(0);">Load More</a>
            </div>
        </div>
    </div> -->
</div>

</div>
<!-- Button trigger modal -->
 
@endsection
@section('javascript')
<script type="text/javascript"> 
   @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
    @elseif(Session::has('success'))
        toastr.error('{{ Session::get('success') }}');
    @endif


    @if (Session::has('message'))
        toastr.success('{{ Session::get('message') }}');
    @elseif(Session::has('message'))
        toastr.error('{{ Session::get('message') }}');
    @endif
$(document).ready(function(){
	
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
    //toastr.options.timeOut = 10000;

 

    // $('.edit-emp').click(function(e){
    //     e.preventDefault();
    //     $id = $(this).attr('code');

    //     $.ajax({
    //         url : "{{url('employee/edit')}}",
    //         type : "POST",
    //         data : $id,
    //         success : function(data){
    //             alert(data);
    //         }
    //     });

    // });

    

    // $('.delete').click(function(e){
    //     e.preventDefault();
    //     $id = $(this).attr('code');
    //      $.ajax({
    //             url : "{{url('employee/delete')}}",
    //             type : "POST",
    //             data : {id:$id},
    //             success : function(data){
                    
                   

    //             }
    //         });

    // });
});

</script>
@endsection