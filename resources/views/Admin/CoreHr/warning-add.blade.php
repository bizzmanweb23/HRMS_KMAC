@extends('Admin.layout.main')
@section('content')

<div class='container-fluid content'>
    <div class='row'>
        <div class='col my-auto'>
              <h4 class="page-title mt-3">Add New Warning</h4> 
        </div>
        <div class="col   my-auto">
             <a href="{{ route('emp.add') }}" class="btn btn btn-primary float-right" id="back">
                    <i class="fa fa-backward mr-1"></i> Back
            </a>
        </div>
    </div>  
</div>
<div class="container my-3 mb-5">  
<div class="row">
    <div class="col-10 offset-1"> 
    <form id="add-warning" enctype="multipart/form-data">
    @csrf
        <div class="row"> 
        <div class="col">
        <div class="form-group">
                <label>Company</label>
                <select class="form-control form-sm select" name="company">
                    @foreach($companies as $cmp)
                    <option value="{{$cmp->company_id }}">{{$cmp->trading_name}}</option>
                    @endforeach
                </select>
        </div>
        </div>
        <div class="col">
        <div class="form-group">
                <label>Attachment</label>
                <input type="file" name="attachment" id="" class="form form-control">
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col">
        <div class="form-group">
        <label>Warning By</label>
        <select class="form form-control form-sm select" name="warning-to">
                @foreach($employees as $emp)
                <option value="{{$emp->first_name.' '.$emp->last_name}}">{{$emp->first_name.' '.$emp->last_name}}</option>
                @endforeach
        </select>
        </div>
        </div>
        <div class="col">
        <div class="form-group">
        <label>Warning Type</label>
        <select class="form form-control select" name="warning-type-id">
                @foreach($warningType as $wtype)
                <option value="{{$wtype->warning_type_id }}">{{$wtype->type}}</option>
                @endforeach
        </select>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col"> 
            <label>Warning Date</label> 
                <div class="form-group cal-icon">
               
                <input type="text" class="form-control form-sm datetimepicker" name="warning-date"> 
                </div>
        </div> 
              <div class="col">
                 <div class="form-group">
                        <label>Warning To</label> 
        <select class="form form-control select" name="warning-by">
          @foreach($admin as $emp)
                <option value="{{$emp->first_name.' '.$emp->last_name}}">{{$emp->first_name.' '.$emp->last_name}}</option>
                @endforeach
        </select>
                </div>
        </div> 
        </div> 
        <div class="row">
              <div class="col">
              
                 <div class="form-group">
                        <label>Warning Subject</label> 
                        <input type="text" class="form-control form-sm" name="warning-subject" placeholder="Warning Subject"> 
                </div>
        </div> 
        </div>
        
        <div class="form-group">
                <label>Description</label>
                <textarea cols="30" rows="4" class="form-control" name="description"></textarea>
        </div>
        <div class="m-t-20 text-right">
                <button type='submit' class="btn btn-primary" id="add-warning-btn">
                <i class="fa fa-check-square mr-1"></i>	
                 Save 
                </button>
        </div>
        </form>
    </div>
</div>
 
</div>
<br><br><br>
@endsection
@section("javascript")
<script>
$(document).ready(function(){
   //add new employee
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
    }); 
    $('#back').click(function(){
       window.history.go(-1);return false; 
    });
    
     
    $('#add-warning').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : "{{url('store/warning')}}",
            method: "POST", 
            
            contentType: false,
            cache: false,
            processData : false,
            
            data : new FormData(this),
            success : function(response)
            {    
                window.location.href= "{{ url('warning') }}";
            }
            
            
        });
    });
   
    //end add new employee
});
</script>
@endsection
