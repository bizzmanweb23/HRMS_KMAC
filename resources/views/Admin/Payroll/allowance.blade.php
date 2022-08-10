@extends('Admin.layout.main')
@section('content')
<div class="container-fluid  content">
<div class="row mt-5">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Allowance </h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
    <a href="javascript:void(0)  " class="btn btn btn-primary   float-right" id="add">
        <i class="fa fa-plus mr-1"></i>Add Allowance</a>
    </div>
</div>
	<!--From here from starts-->
<div class="p-3 bg-white my-3 border" id="add-form"> 
<div class="row">
<div class="col-lg-10 offset-lg-1">
<p class="lead my-3">Add Allowance</p>
<hr>
<form id="add-allowance">@csrf
<div class="row"> 
        <div class="col">
                <div class="form-group">
                <label>
                        Allowance Type
                </label>
                <input name="allowance-type" placeholder="type" class="form form-control company-field" /> 
                </div>
        </div>  
        <div class="col">
                <div class="form-group">
                <label>
                        Cost
                </label>
                <input name="cost" placeholder="cost" class="employee-field form form-control">  
            
                </div>
        </div> 
</div> 
<div class="m-t-20 text-right">
<button type="button" class="btn btn-primary save " id="save">
    <i class="fa fa-check-square mr-1"></i>
        Add
</button>
</div>
</form>
</div>
</div>
</div>
       
	<!--From here table starts-->
<div class="row  " id="table-section">
    <div class="col-md-12">
    <div class="card border">
         
        <div class="card-body">
            <h4>List All Allowance</h4><br>   
        <div class="table-responsive">
        <table class="table table-sm table-bordered display compact" id="example">
        <thead> 
            <th>Action</th>
            <th>Title</th> 
            <th>Amount</th> 
        </thead>
        <tbody>
            @foreach($allowance as $values)
            <tr>
                
                <td>
                    <a class="dropdown-item edit" href="javascript:void(0)"  
                     data-toggle="modal" data-target="#edit-modal">
                        <i class="fa fa-pencil m-r-5"></i> 
                        Edit
                    </a> 
                    <a class="dropdown-item delete" href="javascript:void(0)"  >
                        <i class="fa fa-trash-o m-r-5"></i>
                        Delete
                    </a>
                    <a class="dropdown-item view" href="javascript:void(0)"    
                        data-toggle="modal" data-target="#view-modal" >
                        <i class="fa fa-trash-o m-r-5"></i> 
                        View
                    </a>
                   
                </td>
                 
                <td>
                    {{$values->allowance_name}}
                </td>
                <td>
                    {{$values->amount}}
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

			 	
</div>

@endsection
@section('javascript')
<script>
$(document).ready(function(){  
  
$.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
});

$('#example').DataTable();

 $(document).on('click','.save', function(){
    var form = $('#add-allowance').serialize();
     $.ajax({
            url : '{{ url("add/allowance") }}',
            type : 'post',
            data : form,
              
            success : function(data){
                alert(data);
                document.location.reload();
                console.log(data);
            },
            error : function(data){
                console.log(data);
            }
        });
 });
    
});
</script>
@endsection 
