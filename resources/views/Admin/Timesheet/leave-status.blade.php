@extends('Admin.layout.main')
@section('content')
  <div class="  content row mt-5">
        <div class="col-sm-4 col-3">
                <h4 class="page-title">Leaves Status</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="javascript:void(0)" class="btn btn btn-primary   float-right" id="add">
                        <i class="fa fa-plus mr-3"></i>Add Leave</a>
        </div>
    </div>

<div class="  content">
  
    <div class="row">
        <div class="col-md-3 col-sm-12 col-lg-3"> 
            <div class="border bg-white p-3">
                <h3>Report Filters</h3>
                <form action="#">
                    <div class="row">
                        <div class="col-12 cal-icon form-group"> 
                            <input type="text" class="form form-control datetimepicker" name="start-date" placeholder="Start Date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 cal-icon form-group"> 
                            <input type="text" placeholder="End Date" class="form form-control datetimepicker" name="end-date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label></label>
                            <select name="company" class="form form-control select">
                                @foreach($company as $data)
                                    <option value="{{$data->company_id}}">{{$data->trading_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label></label>
                             <select name="employee" class="form form-control select">
                            @foreach($employee as $data)
                            <option value="{{$data->employee_id}}">{{$data->first_name .' '.$data->last_name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="m-t-20 text-right">
                        <button class="btn btn-primary btn-sm  ">
                        <i class="fa fa-check-square mr-1"></i>	
                         Get 
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <!--Table starts here-->    
        <div class="col"> 
            <div class="card border">
                <div class="card-header">
                    <p class="card-title">View Leave Reports</p>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered" id="example">
                        <thead>
                        <th>Company</th>
                        <th>Employee</th>
                        <th>Status</th> 
                        
                        </thead>
                        <tbody>
                            @foreach($fields as $key=>$values)
                            <tr>
                                <td>{{ $values->name }}</td>
                                <td>{{ $values->first_name.' '.$values->last_name}}</td>
                                <td>
                                   @if($values->status_id == 1)  
                                    <a class="custom-badge status-green " href="#">
                                      {{$values->type_name}}
                                    </a> 
                                    @endif
                                    @if($values->status_id == 2)  
                                    <a class="custom-badge status-blue  " href="#" >
                                        {{$values->type_name}}
                                    </a> 
                                    @endif
                                    @if($values->status_id == 3)  
                                    <a class="custom-badge status-red " href="#">
                                         {{$values->type_name}}
                                    </a> 
                                    @endif 
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
@endsection

@section('javascript')
<script>
$(document).ready(function(){  
 $('#example').DataTable(); 
});
</script>
@endsection
 
