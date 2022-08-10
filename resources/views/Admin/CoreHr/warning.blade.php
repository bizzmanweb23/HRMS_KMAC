@extends('Admin.layout.main')
@section('content')
<div class="   content">
    <div class="row mb-3">
        <div class="col my-auto">
        <h4 class="page-title">Warning</h4>
        </div>
        <div class="col my-auto">
        <a href="{{ route('warning.add.form') }}" class="btn btn btn-primary  float-right" id="add">
        <i class="fa fa-plus mr-3"></i>Add New</a>
        </div>
    </div>
	 
 
    <!--From here table starts-->
    <div class="row" id="table-section">
        <div class="col">
        <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-sm table-bordered display compact" id="example">
            <thead>
            <tr>
                <th>Action</th> 
                <th>Company</th> 
                <th><i class="fa fa-calendar"></i> Warning Date</th> 
                <th>Warning To</th>
                <th><i class="fa fa-user"></i> Warning By</th> 
                <th>Subject</th> 
                
            </tr>
            </thead>
            <tbody>
            @foreach($data as $values)
            <tr>
            <td>
               <div>  
             
<!--                <a class="dropdown-item edit" href="javascript:void(0)" val="{{ $values->warning_id}}"
                   data-toggle="modal" data-target="#exampleModal"">
                    <i class="fa fa-pencil m-r-5"></i> 
                Edit
                </a> -->
                <a class="dropdown-item delete" href="javascript:void(0)" val="{{ $values->warning_id}}" 
                   data-toggle="modal" data-target="">
                    <i class="fa fa-trash-o m-r-5"></i> Delete</a>

                <a class="dropdown-item view" href="javascript:void(0)" val="{{ $values->warning_id}}" 
                    data-toggle="modal" data-target="#viewmodal">
                    <i class="fa fa-eye m-r-5"></i> View</a> 
             
            </div>         
            </td>    
            <td>{{ $values->trading_name}}</td>
            <td>{{ $values->warning_date }}</td>
            <td>{{ $values->warning_to }}</td>
            <td>{{ $values->warning_by}}</td>
            <td>{{ $values->subject }}</td> 
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
<!-- Button trigger modal --> 
<!-- Modal -->
<div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Warning View</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-lg w-100 table-bordered">
              <tbody>
                  <tr>
                        <td>
                                Warning To
                        </td>
                      <td>
                        <span class="warning-to">
                                
                        </span>
                      </td>

                  </tr>
                  <tr>
                          <td>
                                  Warning By
                          </td>
                          <td>
                                  <span class="warning-by">
                                          
                                  </span>
                          </td>
                  </tr>
                   <tr>
                          <td>
                                  Warning Type
                          </td>
                          <td>
                                  <span class="warning-type">
                                          
                                  </span>
                          </td>
                  </tr>
                  <tr>
                          <td>
                                  Warning Date
                          </td>
                          <td>
                                  <span class="warning-date">
                                          
                                  </span>
                          </td>
                  </tr>
                  <tr>
                          <td>
                                  Company
                          </td>
                          <td>
                                  <span class="company">
                                          
                                  </span>
                          </td>
                  </tr>
                 
                  <tr>
                          <td>
                                  Subject
                          </td>
                          <td>
                                  <span class="subject">
                                         
                                  </span>
                          </td>
                  </tr>
                  <tr>
                    <td>
                      <img class="preview" src="">
                    </td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>
@if(Session::has('message'))
<div class="text-success">
  <p>
    {{Session::get('message')}}
  </p>
</div>
@endif
@endsection
@section('javascript')
<script>
$(document).ready(function(){ 
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
    });  
    $('#example').DataTable(); 
    
    //delete
     $('.delete').click(function(){ 
        id = $(this).attr('val');
        $cnf = confirm('Deleted Row will not be Recovered !');
        if(!$cnf){
            
        }else {
                     
        $.ajax({  
            url : '{{ url("delete/warning") }}',
            type :"POST",
            data: {id: id}, 
            dataType: 'Json',
            success: function(data){
                console.log(data);
                location.reload();
 
            }
        });
        }
    });
    //view
    $('.view').click(function(){ 
        var $id = $(this).attr('val');
        $.ajax({
            type : "POST",
            url : "{{ url('show/warning') }}",
            data : {id: $id},
            dataType: 'JSON',
            success: function(response){
                $.each(response, function(key,value){ 
                  $url = "{{url('public/storage/warning')}}"+"/"+value.attachment
                    $('.warning-to').text(value.warning_to);
                    $('.warning-by').text(value.warning_by);
                    $('.warning-type').text(value.type);
                    $('.warning-date').text(value.warning_date);
                    $('.company').text(value.trading_name);
                    $('.subject').text(value.subject); 
                    $('.preview').attr('src',$url);
                });
            }
        });
    });
    
  
});



 

</script>
@endsection