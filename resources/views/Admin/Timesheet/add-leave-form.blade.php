@extends('Admin.layout.main')
@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
            <h4 class="page-title">Add Leave</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('emp.leave') }}" class="btn btn btn-primary float-right" id="add">
                    <i class="fa fa-backward mr-1"></i> back</a>
    </div>
</div>
<div class="row">
    <div class="col-8 offset-2">
    <form id='add-emp-leave' enctype="multipart/form-data">
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
				<select name="leave-type" class="form form-control"> 
        		@foreach($leavetype as $data)
        		<option value="{{$data->leave_type_id}}">{{$data->type_name}}</option>
        		@endforeach
        		</select>
			</div>
		</div>

		<div class="col">
			<div class="form-group">
				<label>
					Attachment
				</label>
				<input type="file" class="form-control form-sm" name="certificate">
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
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		$('#add-emp-leave').submit(function(e){
			e.preventDefault();

			$.ajax({
				url : "{{ url('add/leave') }}",
				method: "POST",
				data: new FormData(this),

				contentType:false,
				cache:false,
				processData:false,

				success: function(data){
				document.location.href = "{{url('employee/leave')}}";	 
				}
			});
 		});
	});
</script>
@endsection