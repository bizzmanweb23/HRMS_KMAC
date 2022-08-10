<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PayrollController extends Controller
{
     
    public function basic_salary()
    {
        $employee = DB::table('kmac_employees')->get();
        $company = DB::table('kmac_companies')->get();
        
        $allowance= DB::table('kmac_allowance')->get();
        
        $data = DB::table('kmac_emp_basic_salary')->get();  
        
        return view('Admin.Payroll.employee-salary')->with([
            'employee'=>$employee,
            'data'=>$data,
            'company'=>$company,
            'allowance'=>$allowance,
        ]);

    }
    public function allowance()
    {
        $employee = DB::table('kmac_employees')->get();
        $company = DB::table('kmac_companies')->get();
        $allowance = DB::table('allowance')->get();
        
        $result = DB::table('kmac_emp_basic_salary')
        ->join('kmac_employees','kmac_employees.employee_id','kmac_emp_basic_salary.employee_id')
        ->join('kmac_companies','kmac_companies.company_id','kmac_emp_basic_salary.company_id')
        ->get();

        return view('Admin.Payroll.allowance')->with([
            'employee'=>$employee,
            'company'=>$company,
            'allowance'=>$allowance,
             
        ]);

    }
    public function add_allowance(Request $request){
        
        $data = [
            'allowance_name'=>$request->input('allowance-type'),
            'amount'=>$request->input('cost'),
        ];
        $result = DB::table('allowance')->insert($data);
        if($result){
            return response()->json([
                'message'=>'Allowance Added',
            ]);
        }
    }

    public function payroll_history()
    {
        $employee = DB::table('kmac_employees')->get();
        $company = DB::table('kmac_companies')->get();
        
        $allowance= DB::table('kmac_allowance')->get();
        
        $data = DB::table('kmac_emp_basic_salary')
            ->join('kmac_employees','kmac_employees.employee_id','kmac_emp_basic_salary.employee_id')
            ->join('kmac_companies','kmac_companies.company_id','kmac_employees.company_id')
            ->distinct()
            ->get();  
        
         
        return view('Admin.Payroll.payslip-history')->with([
            'employee'=>$employee,
            'data'=>$data,
            'company'=>$company,
            'allowance'=>$allowance,
        ]);
    } 
    public function incentive()
    {
         echo "incentives";
    } 
    public function bonous()
    {
         echo "bonous";
    } 
    public function add_salary_form(Request $request)
    {
        $employee = DB::table('kmac_employees')->get();
        $company = DB::table('kmac_companies')->get();
        $allowance= DB::table('allowance')->get();
        $data = DB::table('kmac_emp_basic_salary')
            ->join('kmac_employees','kmac_employees.employee_id','kmac_emp_basic_salary.employee_id')
            ->join('kmac_companies','kmac_companies.company_id','kmac_employees.company_id')
            ->distinct()
            ->get();  
        
        return view('Admin.Payroll.add-salary')->with([
            'employee'=>$employee,
            'data'=>$data,
            'company'=>$company,
            'allowance'=>$allowance,
        ]);
    }
    public function store(Request $request)
    { 
      
        $bs = $request->input('basic-pay');
        $ns = $request->input('net-salary');
        $employee = $request->input('employee-id');
        $company = $request->input('company-id');
        $allowances =  $request->input('allowances');
        
        $ha = $allowances[0];
        $ta = $allowances[0];
        $pa = $allowances[0];

        $i = $request->input('incentive');
        $b = $request->input('bonous');

        $data = [
            'company_id'=>$company,
            'employee_id'=>$employee,
            'basic_salary'=>$bs,
            'net_salary'=>$ha+$ta+$pa+$i+$b+$bs+$ns,
            'housing_allowance'=>$ha,
            'transport_allowance'=>$ta,
            'performance_allowance'=>$pa,
            'incentives'=>$i,
            'bonous'=>$b,
            
            'tds'=>$request->input('tds'),
            'esi'=>$request->input('esi'),
            'pf'=>$request->input('pf'),
            'lve'=>$request->input('leave'),
            'fund'=>$request->input('fund'),
            'others'=>$request->input('others'),
        ]; 
        
        $result = DB::table('kmac_emp_basic_salary')->insert($data);

        if($result){
            return response()->json([
                'message'=>'Salary Added',
            ]);
        }        
      
    }

    public function view(Request $request)
    {
        $id = $request->input('id'); 
       
        $result = DB::table('kmac_emp_basic_salary') 
        
        ->where('salary_id','=',$id)
        ->get(); 
        
        
        echo json_encode($result);

    }
    public function edit(Request $request)
    {
        $id = $request->input('id'); 
        
        $result = DB::table('kmac_emp_basic_salary')
        
        ->where('salary_id','=',$id)
        ->get(); 
        echo json_encode($result);
        
    }
    public function update(Request $request)
    {
        print "<pre>";
        print_r($request->input());
        exit();
        $id =  $request->input('id'); 
        $employee = $request->input('emp-name');
        $company = $request->input('cmp-name');
        
        $ns = $request->input('net-salary');
        $bs = $request->input('basic-salary');
        
        $ha = $request->input('ha');
        $ta = $request->input('ta');
        $pa = $request->input('pa');

        $i = $request->input('i');
        $b = $request->input('b');

        $data = [
            'employee_id'=>$employee,
            'company_id'=>$company,
            'net_salary'=>$ha+$ta+$pa+$i+$b+$bs,
            'basic_salary'=>$bs,
            'housing_allowance'=>$ha,
            'transport_allowance'=>$ta,
            'performance_allowance'=>$pa,
            'incentives'=>$i,
            'bonous'=>$b, 
            
            'tds'=>$request->input('tds'),
            'esi'=>$request->input('esi'),
            'pf'=>$request->input('pf'),
            'lve'=>$request->input('lve'),
            'fund'=>$request->input('fund'),
            'others'=>$request->input('others'),
        ];

        $result = DB::table('kmac_emp_basic_salary')
        ->where('salary_id','=',$id)
        ->update($data);

        if($result){
            return response()->json([
                'message'=>'Salary Updated',
            ]);
        }   


    }
    public function destroy(Request $request)
    {
        $id = $request->input('id');  
        $result = DB::table('kmac_emp_basic_salary')
                ->where('salary_id','=',$id)->delete(); 
        
        if($result){
             return true;
        }
    }
    
    public function make_payslip($id)
    {
        $data = DB::table('kmac_emp_basic_salary')
            ->join('kmac_employees','kmac_employees.employee_id','kmac_emp_basic_salary.employee_id')
            ->join('kmac_companies','kmac_companies.company_id','kmac_employees.company_id')
            ->distinct()
            ->get();  
        return view('Admin.Payroll.make-payslip')->with([
            'data'=>$data,
        ]);
    }
    
    public function get_row($id)
    {
       $result = DB::table('kmac_emp_basic_salary')->select('status')->where('salary_id','=',$id)->get();
        return $result[0]->status;
    }
    public function status_change(Request $request)
    {
        $id = $request->input('id');
        $status =  $this->get_row($id);
         
        if($status == 0)
        {
            $result = DB::table('kmac_emp_basic_salary')->where('salary_id','=',$id)->update([
            'status'=> 1,
            ]);
        }
        if($status == 1)
        {
            $result = DB::table('kmac_emp_basic_salary')->where('salary_id','=',$id)->update([
            'status'=> 0,
            ]);
            
        }
          

    }
   
}
