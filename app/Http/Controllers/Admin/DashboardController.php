<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    public function index()
   {
      
        $emp = DB::table('kmac_employees')->count();
        $leave = DB::table('kmac_leave_applications')->count();
        $payroll = DB::table('kmac_emp_basic_salary')->count(); 
        
        
        return view('Admin.dashboard')->with([
           'employee'=>$emp, 
           'leave'=>$leave,
           'payroll'=>$payroll, 

        ]);


   }
   public function dashboard()
   {
   $emp = DB::table('kmac_employees')->count();
       
        return view('Admin.dashboard')->with([
           'employee'=>$emp, 
        ]);
       
   }

   public function cpf()
   {
      return view('Admin.cpf-submittion');
   }
   public function iras()
   {
      return view('Admin.IRAS-submittion');
   }
}
