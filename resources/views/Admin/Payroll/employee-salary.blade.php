@extends('Admin.layout.main')
@section('content')

<div class="container-fluid  content">
<div class="row mt-3">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Basic Salary </h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ url('add/salary/form') }}" class="btn btn btn-primary float-right" id="add">
        <i class="fa fa-plus mr-1"></i>Add Salary</a>
    </div>
</div>
<!--From here from starts-->
 	<!--From here table starts-->
<div class="row " id="table-section">
    <div class="col-md-12">
    <div class="card border">
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-sm table-bordered display compact" id="example">
        <thead> 
                <th>Action</th>
                <th>Employee</th> 
                <th>Payroll Type</th>
                <th>Allowances</th> 
                <th>Payslip</th>
                <th>Net Salary</th>
                <th>Status</th>
             
        </thead>
        <tbody>
                @foreach($data as $values)
                <tr>
                <td> 
                <a class="dropdown-item edit-payroll" href="javascript:void(0)"  
                 data-toggle="modal" data-target="#editmodal" val="{{$values->salary_id}}">
                    <i class="fa fa-pencil m-r-5"></i> 
                    Edit
                </a> 
                <a class="dropdown-item edit-payroll" href="javascript:void(0)" val="{{$values->salary_id}}" >
                    <i class="fa fa-trash-o m-r-5"></i>
                    Delete
                </a>
                <a class="dropdown-item view-payroll" href="javascript:void(0)"    
                    data-toggle="modal" data-target="#viewmodal" val="{{$values->salary_id}}">
                    <i class="fa fa-eye m-r-5"></i> 
                    View
                </a>
                </td>
              
                <td>
                {{$values->employee_id}}
                <br>
                (
                <span class="font-italic">
                {{$values->company_id}}
                </span>
                )
                </td> 
                <td>
                {{$values->payroll_type}}
                </td>
                <td>  
                <span>
                Housing Allowance :
                {{$values->housing_allowance}}
                </span>
                <br>

                <span>
                Transport Allowance :
                {{$values->transport_allowance}}
                </span>
                <br>

                <span>
                Performance Allowance :
                {{$values->performance_allowance}}
                </span>
                <br>
                <span>
                Incentives :
                {{$values->incentives}}
                </span>
                <br>
                <span>
                Bonous :
                {{$values->bonous}}
                </span>
                </td>
                <td>
                    <a href="{{ route('make.payslip',$values->salary_id) }}" 
                       class='btn btn-primary text-center make-payslip' 
                       code="{{$values->salary_id}}">
                        Make 
                        Payslip
                    </a>
                </td>
                
                <td>
                {{
                    $values->housing_allowance 
                    +$values->transport_allowance
                    +$values->performance_allowance
                }}
                </td>
                <td>
                @if($values->status == 1)
                    <span class="custom-badge status-green">
                        paid
                    </span>
                @endif
                @if($values->status == 0)
                    <span class="custom-badge status-red">
                        unpaid
                    </span>
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
  
<!-- Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg w-100" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Edit Salary</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="update-salary">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Employee</label>
                            <select class="form-control select" name="emp-name">
                                @foreach($employee as $emp)
                                <option value="{{$emp->first_name.' '.$emp->last_name}}">{{$emp->first_name.' '.$emp->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control select" name="cmp-name">
                                @foreach($company as $cmp)
                                <option value="{{$cmp->trading_name}}">{{$cmp->trading_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="edit-paroll-box"> 
                  
                </div> 
                <div class="m-t-20 text-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save " id="update-btn">
                            <i class="fa fa-check-square mr-1"></i>
                            Update
                    </button>
                </div> 
            </form>
        </div>
        
    </div>
  </div>
</div>  
<!--end modal-->	
<!-- Modal -->
<div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="text-info modal-title" id="exampleModalLabel">Employee Payroll</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <table class="table table-sm table-bordered  m-auto view-payroll-box"> 
        </table>
      </div>
      <div class="card-footer   p-3 text-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>
<!--end modal-->

</div>

@endsection
@section('javascript')
<script>
$(document).ready(function(){  

$.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
});

$('#example').DataTable();
$('#add-form').hide(); 
   
        $('#add').click(function(){
            $('#add-form').slideToggle();
        });  
   
    //change status
    $('.paid').click(function(e){
        e.preventDefault();
        $id = $(this).attr('val');
       
        $.ajax({
            url : '{{url("status/change")}}',
            type : 'POST',
            data : {id : $id},
            
            success: function(data)
            {
                 location.reload();
            }
        });
    });
    
    $('.unpaid').click(function(e){
        e.preventDefault();
        $id = $(this).attr('val');
        $.ajax({
            url : '{{url("status/change")}}',
            type : 'POST',
            data : {id : $id},
            
            success: function(data)
            {
                location.reload();
            }
        });
    });
    
    
    $('.view-payroll').click(function(e){
        e.preventDefault();
        $id = $(this).attr('val');
        $('.view-payroll-box').empty();
        $.ajax({
            url : "{{url('view/salary/details')}}",
            type : "POST",
            data : {id : $id},
            dataType : 'Json',
            success : function(data){
                $.each(data, function(key, value){
                    $row = "<tr><td>Employee Name : </td><td>"+value.employee_id+"</td></tr>";
                    $row += "<tr><td>Company Name : </td><td>"+value.company_id+"</td></tr>";
                    $row += "<tr><td>Employee Net Salary : </td><td>"+value.net_salary+"</td></tr>";
                    
                    $row += "<tr class='mt-2'><td colspan='2'><h4 class='text-primary'>Earnings</h4></td></tr>";
                    $row += "<tr><td>Employee Basic Salary : </td><td>"+value.basic_salary+"</td></tr>";
                    $row += "<tr><td>Housing Allwance : </td><td>"+value.housing_allowance+"</td></tr>";
                    $row += "<tr><td>Transport Allowance : </td><td>"+value.transport_allowance+"</td></tr>";
                    $row += "<tr><td>Performance Allowance : </td><td>"+value.performance_allowance+"</td></tr>";
                    $row += "<tr><td>Incentives : </td><td>"+value.incentives+"</td></tr>";
                    $row += "<tr><td>Bonus : </td><td>"+value.bonous+"</td></tr>";
                    
                    $row += "<tr class='mt-2'><td colspan='2'><h4 class='text-primary'>Deductions</h4></td></tr>";
                    $row += "<tr><td>TDS : </td><td>"+value.tds+"</td></tr>";
                    $row += "<tr><td>ESI : </td><td>"+value.esi+"</td></tr>";
                    $row += "<tr><td>PF : </td><td>"+value.pf+"</td></tr>";
                    $row += "<tr><td>LEAVE : </td><td>"+value.lve+"</td></tr>";
                    $row += "<tr><td>FUND : </td><td>"+value.fund+"</td></tr>";
                    $row += "<tr><td>OTHERS : </td><td>"+value.others+"</td></tr>";
                });
                $('.view-payroll-box').append($row);
            }
        });
    });
    
    $('.edit-payroll').click(function(e){
        e.preventDefault();
        $id = $(this).attr('val');
        $('.edit-paroll-box').empty();
        $.ajax({
            url : "{{url('edit/salary')}}",
            type : "POST",
            data : {id : $id},
            dataType : 'Json',
            success : function(data){
                $.each(data, function(key, value){
                    $row = "<div class='row'>";
                    $row += "<input type='hidden' name='id' value='"+value.salary_id+"'>";
                    
                    $row += "</div>"; 
                    
                    $row += "<div class='row'>";
                    $row += "<div class='col form-group'><label>Net Salary </label><input class='form-control' name='net-salary' value='"+value.net_salary+"'></div>";
                    $row += "<div class='col form-group'><label>Basic Salary  </label><input class='form-control' name='basic-salary' value='"+value.basic_salary+"'></div>";
                    $row += "</div>"; 
                    
                    $row += "<div><h4 class='text-primary'>Earnings</h4></div>";
                    $row += "<div class='row'>";
                    $row += "<div class='col form-group'><label>Housing Allowance </label><input class='form-control' name='ha' value='"+value.housing_allowance+"'></div>";
                    $row += "<div class='col form-group'><label>Performance Allowance  </label><input class='form-control' name='pa' value='"+value.performance_allowance+"'></div>";
                    $row += "<div class='col form-group'><label>Transport Allowance  </label><input class='form-control' name='ta' value='"+value.transport_allowance+"'></div>";
                    $row += "</div>"; 
                    
                    $row += "<div class='row'>";
                    $row += "<div class='col form-group'><label>INCENTIVES </label><input class='form-control' name='i' value='"+value.inventives+"'></div>";
                    $row += "<div class='col form-group'><label>BONUS </label><input class='form-control' name='b' value='"+value.bonous+"'></div>";
                    $row += "</div>";
                    
                    $row += "<div><h4 class='text-primary'>Deductions</h4></div>";
                    $row += "<div class='row'>";
                    $row += "<div class='col form-group'><label>TDS  </label><input class='form-control' name='tds' value='"+value.tds+"'></div>";
                    $row += "<div class='col form-group'><label>ESI  </label><input class='form-control' name='esi' value='"+value.esi+"'></div>";
                    $row += "<div class='col form-group'><label>PF  </label><input class='form-control' name='pf' value='"+value.pf+"'></div>";
                    $row += "<div class='col form-group'><label>LEAVE  </label><input class='form-control' name='lve' value='"+value.lve+"'></div>";
                    $row += "<div class='col form-group'><label>FUND  </label><input class='form-control' name='fund' value='"+value.fund+"'></div>";
                    $row += "<div class='col form-group'><label>OTHERS  </label><input class='form-control' name='others' value='"+value.others+"'></div>";
                   
                    $row += "</div>";
                    
                   
                });
                $('.edit-paroll-box').append($row);
            }
        }); 
    });
    
    $('.delete-payroll').click(function(e){
        e.preventDefault();
        $id = $(this).attr('val');
        alert($id);
    });
    
    $('#update-btn').click(function(e){
        e.preventDefault();
        $form = $('#update-salary').serialize();
        $.ajax({
            url : "{{url('update/salary')}}",
            type : "POST",
            data : {form:$form},
            success : function(data){
                alert(data);
                //location.reload();
            }
        }); 
    });
    
});
</script>
@endsection 
