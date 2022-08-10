<style>
	.sidebar-menu ul li a{
		font-size: 14px;
		font-family: calibri;
		 
		 
	}
</style>
<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
        <ul>
            <li class="menu-title"> 
			Kmac Hrms
			</li>
            <li class=" ">
                <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li>
            <!--     
				 <a href="{{ url('employee/tabs') }}"><i class="fa fa-user-md"></i> <span>Employee</span></a>
             -->
             <li class="submenu">
            <a href="#"><i class="fa fa-folder-o"></i> 
			<span> Employee Details </span> <span class="menu-arrow"></span>
			</a>
            <ul style="display: none;"> 
				<li>
                    <a href="{{ url('employee') }}">
                    Employee</a>
                </li>
                <li>
                    <a href="{{ route('emp.licence') }}">
                    Licence</a>
                </li>
                <li>
                    <a href="{{ route('emp.education') }}">
                   Education</a>
                </li>
                <li><a href="{{ route('emp.vaccination') }}">
                     Vaccination</a>
                </li>
                <li><a href="{{ route('emp.wsq') }}">
                     Wsq</a>
                </li>
                
                <li><a href="{{ route('emp.certificate') }}">
                     Certificates</a>
                </li>
                <li><a href="{{ route('emp.bonus') }}">
                      Bonus</a>
                </li>  
                <li><a href="{{ route('emp.referal') }}">
                      Referal</a>
                </li>
                <li><a href="#">
                     Renewal</a>
                </li>
               
            </ul>
            </li>
            <li class="submenu">
                <a href="#"><i class="fa fa-folder"></i> <span> Leave Management </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">
                <li>
                <a href="{{ url('/employee/leave')}}">  <span>Employee Leaves</span></a>
                </li>
                    <li><a href="{{ route('emp.leave.status') }}">
                         Leave Status</a></li> 
                </ul>
            </li>
            <li class="submenu">
                <a href="#"><i class="fa fa-folder"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">
                    <li><a href="{{ url('salary')}}">Employee Salary</a></li>
                    <li><a href="{{ url('payslip/history') }}">Payslip History</a></li> 
                </ul>
            </li>
             
            <li class="submenu">
                    <a href="#"><i class="fa fa-folder"></i> <span> Core Hr </span> 
					<span class="menu-arrow"></span>
					</a>
                    <ul style="display: none;">
                            <li><a href="{{ url('warning') }}">Employees Warning</a></li>
                            <li><a href="{{url('termination')}}">Employee Terminations</a></li> 
                    </ul>
            </li>  
            <li class="submenu">
                    <a href="#"><i class="fa fa-folder"></i> <span> E-Filling </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                    <li class=" ">
                        <a href="{{ url('cpf') }}">
                            <span>CPF</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ url('iras') }}">
                            <span>IRAS</span>
                        </a>
                    </li>
                    </ul>
            </li> 
        </ul>
      
    </div>
</div>
</div>