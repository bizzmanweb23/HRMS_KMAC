@extends('Admin.layout.main')
@section('content')
<div class="  row my-3">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Payslip History</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
         
    </div>
</div>
<div class='  content'>
    <div class='card'>
        <div class='card-body'>
            <table class='table table-sm table-bordered' id='example'>
                <thead>
                    <th>Action</th>
                    <th>Employee</th>
                    <th>Company</th>
                    <th>Account #</th>
                    <th>Net Payable</th>
                    <th>Salary Month</th>
                    <th>
                        <i class="fa fa-calendar-check-o mr-1"></i>
                        Payroll Date
                    </th>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('table').DataTable();
    });
</script>
@endsection