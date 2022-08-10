@extends("Admin.layout.main")
@section("content")
<div class="row my-3">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">CPF Submittion</h4>
    </div> 
    <div class="col">
    <a href="javascript:void(0)" 
        class="btn btn-primary btn-rounded float-right cpf-add-btn">
        <i class="fa fa-plus"></i> 
        Add New
    </a>
    </div>
</div>
<div class="card cpf-add-form">
    <div class="card-body">
        <h4>Generate CPF Submission File</h4>
        <div class="row mt-5">
            <div class="col">
                <div class="form-group">
                    <label for="">CPF Submittion Number</label>
                    <input name='cpf-submittion-number' class='form form-control' placeholder="CPF Submittion Number">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Select Month</label>
                    <input type="date" name="month-year" id="" class="form form-control">
                </div>
            </div>
        </div>
        <div class="row text-right">
            <div class="col">
                <button type="submit" class="btn btn-primary">
                    Generate</button>
            </div>
        </div>
    </div>
</div>
<div class="card">
<div class="card-body">
    <h4 class=" ">
        List of CPF Submittion
    </h4>
    <table class="table table-sm table compact table-bordered" id="table">
        <thead>
            <tr>
                <th>Action</th>
                
                <th>Option Name</th>
                <th>Option value</th> 
                 
            </tr>
        </thead>
        <tbody class="data-table-row">
           
        </tbody>
    </table>
     
</div>
</div>
<div>
    <form id="add-form">
        <p>
            <input type="" name="name">
        </p>
        <p>
            <input type="" name="value">
        </p>
        <p>
            <button type="button" id="add-form-btn">Save</button>
        </p>
    </form>
</div>
@endsection
@section("javascript")
<script>
$(document).ready(function(){
    

    $.ajax({
        url: "{{url('cpf/data')}}",
        method: "GET",
        dataType: "JSON",
        success : function(data){
           
            $.each(data, function(key ,value){
               console.log(value);
                $row = '<tr>';
                $row += '<td>'+value.id+'</td>';
                $row += '<td>'+value.option_name+'</td>';
                $row += '<td>'+value.option_value+'</td>';
                $row += '</tr>';
                $('.data-table-row').append($row);
            });
       
        }
    });

    $('#add-form-btn').click(function(e){
        e.preventDefault();
        var form = $('#add-form').serialize();
        $.ajax({
            url: '{{url("add/cpf")}}',
            method: 'POST',
            data : form,
            success : function(data){
                
                tablelist.ajax.reload();
                toastr.success('CPF ADDED');
            }
        });
    });
    $('.delete-row').click(function(){
        $id = $(this).attr('value');
        alert($id);
     });
     var tablelist = $('.table').DataTable({
        processing: true,
        serverSide: true,
        paginate: true,

        ajax: "{{url('cpf/data')}}",

        columns: [
             
            {   
                data: 'id' ,
                render: function(data, type,row){
                    return '<a href="javascript:void(0)" class="delete-row" value="'+data+'"><i class="fa fa-trash"><i></a>';
                    
                }, 
                data: 'id' ,
                render: function(data, type,row){
                    return '<a href="javascript:void(0)" class="delete-row" value="'+data+'"><i class="fa fa-trash"><i></a>';
                    
                }, 
                data: 'id' ,
                render: function(data, type,row){
                    return '<a href="javascript:void(0)" class="delete-row" value="'+data+'"><i class="fa fa-trash"><i></a>';
                    
                }, 

            },
           
            { data: 'option_name'  },
             
            { data: 'option_value'  },  

        ] 
     });

    
	 
     $('.cpf-add-form').hide();

     $('.cpf-add-btn').click(function(){
        $('.cpf-add-form').slideToggle();
     });

});
</script>
@endsection
