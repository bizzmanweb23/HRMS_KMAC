@extends('Admin.layout.main')
@section('content')

<div class="content">
<div>
    <h4 class="page-title">Dashboard</h4>
</div>   
  
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
        <span class="dash-widget-bg1"><i class="fa fa-user" aria-hidden="true"></i></span> 
        <a href="{{url('employee')}}" class="link text-black">
        <div class="dash-widget-info text-right">
                <h3> {{ $employee }}  </h3>   
                <span class="widget-title1">Employees   
                    <i class="fa fa-check" aria-hidden="true"></i>  
               
               </span>
        </div> 
        </a>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
            <a href="{{url('employee/leave')}}" class="text-black">
                <div class="dash-widget-info text-right">
                <h3>{{ $leave }}</h3>
                <span class="widget-title2">Leaves <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
           <a href="{{url('salary')}}">
                <div class="dash-widget-info text-right">
                <h3>{{ $payroll }}</h3>
                <span class="widget-title3">Payroll <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
           </a>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3>{{ $payroll }}</h3>
                <span class="widget-title4">Pending <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="chart-title">
                        <h4>Employees Total</h4>
                        <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month</span>
                    </div>  
                    <canvas id="linegraph"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="chart-title">
                        <h4>Employees In</h4>
                        <div class="float-right">
                            <ul class="chat-user-total">
                                <li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU</li>
                                <li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li>
                            </ul>
                        </div>
                    </div>  
                    <canvas id="bargraph"></canvas>
                </div>
            </div>
        </div>
</div>

 
</div>
@endsection