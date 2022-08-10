@extends('Admin.layout.main')
@section('content')
<div class="  my-3">
    <h3 class="lead">Employee Certificate</h3>
</div>
<div class="row p-3"> 

    <div class="col card bg-white">
    <div class="card-body">
    <table class="table table-sm table-bordered">
            <thead>
                <th>
                Action
                </th>
                <th>
                Employee
                </th> 
                <th>
                Licence
                </th>
                <th>
                Education
                </th>
                <th>
                Wsq
                </th>
                <th>Vaccination</th>
            </thead>
            <tbody>
            @foreach($data as $values)
            <tr>
               <td style="width: 2cm;">
                    <a href="javascript:void(0)" 
                        val="{{$values->id}}" 
                        class="dropdown-item delete"  >
                    <i class="fa fa-trash-o m-r-5"></i>
                        Delete
                    </a>
                    <a  href="#" class="dropdown-item" 
                        data-toggle="modal" data-target="#view-modal" >
                        <i class="fa fa-trash-o m-r-5"></i> 
                        View
                    </a> 
                </td>

                <td>
                    <a href="javascript:void(0)">
                       {{$values->employee_id}}
                    </a>
                    <br>
                </td>
                <td>
                    <a href="javascript:void(0)">
                        {{$values->licence_no}}
                    </a>
                    <br>
                     <img src="{{url('public/licence').'/'.$values->emp_licence }}"  width="100px" class="img img-thumb" />
                </td>
                <td>
                    <a href="javascript:void(0)">
                        {{$values->cft_number}}
                    </a>
                    <br>
                     <img src="{{url('public/education').'/'.$values->edu_certificate }}"  width="100px" class= "img img-thumb" />
                </td>
                <td>
                    <a href="javscript:void(0)">
                        {{$values->wsq_certificate}}
                    </a>
                    <br>
                     <img src="{{url('public/wsq').'/'.$values->wsq_certificate }}"  width="100px" class="img img-thumb" />
                </td>
                <td>
                    <a href="javascript:void(0)">
                        {{$values->vaccination_certificate}}
                    </a>
                    <br>
                     <img src="{{url('public/vaccination').'/'.$values->vaccination_certificate }}"  width="100px" class="img img-thumb" />
                </td>
                
            </tr>
            @endforeach
            </tbody>
    </table>
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
   
    $('.table').DataTable();
   
    $('.delete').click(function(){
        $id = $(this).attr('val');
        $cnf = confirm('Deleted can not be recovered');
        if(!$cnf){
            
        } else {
           
            $.ajax({
                url : "{{url('delete/certificate') }}",
                method: "POST",
                data : {id: $id},
                dataType: "Json",
                success: function(data){
                document.location.reload();
                }
            });
        }
    });
    
    //view
    
});
</script>
@endsection