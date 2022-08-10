@extends('Admin.layout.main')
@section('content')
<div class="row mt-5">
    <div class="col-sm-4 col-3">
            <h4 class="page-title">Add Staff Salary</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('salary.list') }}" class="btn btn btn-primary float-right" id="add">
                    <i class="fa fa-backward mr-1"></i>Back</a>
    </div>
</div>
<div class="p-3   add-form mb-3  " id="add-form"> 
<div class="row">
<div class="col-8 offset-2">
<form id="add-basic-salary">
    @csrf 
        <div class="row">
        <div class="col">
        <div class="form-group">
        <label>EMPLOYEE</label> 
        <select class="form form-control employee" name="employee-id">
            @foreach($employee as $values)
            <option value="{{$values->username}}">{{$values->first_name.' '.$values->last_name}}</option>
            @endforeach
        </select>
        </div>
        </div> 
            
        <div class="col">
        <div class="form-group">
        <label>COMPANY</label> 
        <select class="form form-control company-list" id="company" name="company-id">
            @foreach($company as $values)
            <option value="{{$values->trading_name}}">{{$values->trading_name}}</option>
            @endforeach
        </select> 
        </div>
        </div>
            
        <div class="col">
        <div class="form-group">
            <label>NET SALARY</label> 
            <input type='text' name="net-salary" class='form-control'>  
        </div>
        </div>
            
        </div> 
        <div class="row">
        <div class='col'>
            <h4 class="text-primary">
                    EARNINGS
            </h4>
        <div class="form-group">
            <label>Basic</label>
            <input name="basic-pay" class="form-control"  />
        </div> 
        <div class="form-group">
            <label>
                   HOUSING ALLOWANCE
            </label>
            <input type="text"  name="allowances[]" class="form form-control"   placeholder="">
        </div>
        <div class="form-group">
            <label>
            TRANSPORT ALLOWANCE
            </label>
            <input type="text"  name="allowances[]" class="form form-control"   placeholder="">
        </div>
        <div class="form-group">
            <label>
            PERFORMANCE ALLOWANCE
            </label>
            <input type="text"  name="allowances[]" class="form form-control"   placeholder="">
        </div>
        
         
         <div class="form-group">
            <label>
                    INCENTIVES
            </label>
            <input type="text" name="incentive" class="form form-control" placeholder="">
        </div>        
        <div class="form-group">
            <label>
                    BONUS
            </label>
            <input type="text" name="bonous" class="form form-control" placeholder="">
        </div>  
        </div>
            <div class='col'>
                <h4 class="text-primary">
                DEDUCTIONS
                </h4>
            <div class="form-group">
            <label>TDS</label>
            <input name="tds" class="form-control"  />
        </div> 
        <div class="form-group">
            <label>
             ESI
            </label>
            <input type="text"  name="esi" class="form form-control"   placeholder="">
        </div>
        <div class="form-group">
            <label>
             PF
            </label>
            <input type="text"  name="pf" class="form form-control"   placeholder="">
        </div>
        <div class="form-group">
            <label>
            LEAVE
            </label>
            <input type="text"  name="leave" class="form form-control"   placeholder="">
        </div>
        
         
         <div class="form-group">
            <label>
            FUND
            </label>
            <input type="text" name="fund" class="form form-control" placeholder="">
        </div>        
        <div class="form-group">
            <label>
            OTHERS
            </label>
            <input type="text" name="others" class="form form-control" placeholder="">
        </div>    
            </div>
        </div>
       
      
        <div class="m-t-20 text-right">
        <button type="button" class="btn btn-primary save " id="save">
                <i class="fa fa-check-square mr-1"></i>
                Save
        </button>
        </div>
</form>
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


    $(document).on('click','.save', function(e){ 
            e.preventDefault();
            var $form = $('#add-basic-salary').serialize(); 
            
            $.ajax({
                type : "POST",
                url : "{{ url('add/salary') }}",
                dataType : "JSON",
                data: $form,
                success: function(data){
                    //toastr.success("salary Added");
                    document.location = "{{ url('salary') }}"; 
                }
            });
        }); 

});
</script>
@endsection