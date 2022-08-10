@extends("Admin.layout.main")
@section("content")<div class="row  ">
    <div class="col-sm-4 col-3">
            <h4 class="page-title"> Add Termination</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ url('termination') }}" class="btn btn btn-primary float-right" id="back">
                    <i class="fa fa-backward mr-1"></i> Back</a>
    </div>
</div>

	<div class="p-3 bg-white " id="add-form"> 
	<div class="row">
		<div class="col-lg-10 offset-lg-1">
		 
		 
			<form method="post" action="{{ url('add/termination') }}" enctype="multipart/form-data">
				@csrf
				<div class="row"> 
					<div class="col-md-6">
						<div class="form-group">
							<label>Company</label>
							<select class="form-control form-sm company-field" name="company">
								@foreach($company as $values)
								<option value="{{$values->company_id}}">{{$values->trading_name}}</option>
								@endforeach 
							</select>
						</div>
					</div>
				 
				</div>
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Employee Terminated</label>
							<select class="form form-control form-sm employee-field" name="employee-terminated">
								@foreach($employees as $values)
								<option value="{{$values->first_name.' '.$values->last_name}}">{{$values->first_name.' '.$values->last_name}}</option>
								@endforeach 
							</select>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label>Terminated By</label>
							<select class="form form-control form-sm" name="terminated-by">
								@foreach($admin as $values)
								<option value="{{$values->first_name.' '.$values->last_name}}">{{$values->first_name.' '.$values->last_name}}</option>
								@endforeach 
							</select>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Notice Date</label> 
								<input type="date" class="form-control form-sm" name="notice-date"> 
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Termination Date</label> 
								<input type="date" class="form-control form-sm" name="termination-date"> 
						</div>
					</div>
				</div>  
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label>Termination Type</label>
							<select class="form form-control form-sm" name="termination-type-id">
								@foreach($terminationType as $values)
								<option value="{{$values->termination_type_id}}">{{$values->type}}</option>
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
@endsection
@section("javascript")
<script>
$(document).ready(function(){
     
});
</script>
@endsection
