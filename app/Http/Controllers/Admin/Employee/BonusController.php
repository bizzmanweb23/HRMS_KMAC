<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
{
    
    public function index()
    {
        $company = DB::table('kmac_companies')->get();
        $employee = DB::table('kmac_employees')->get();
        $result = DB::table('kmac_joining_bonus')->get();
       
        return view('Admin.Employee.emp-details.joining')
            ->with([
                'licence'=>$result,
                'employees'=>$employee,
                'company'=>$company,
            ]);
    }

    public function getall()
    {
        $result = DB::table('kmac_joining_bonus')
            ->join('kmac_employees','kmac_employees.employee_id','kmac_emp_joining_bonus.employee_id') 
            ->get();
        
        echo json_encode($result); 

    }
   
     public function store(Request $request)
    {           
        $empid = $request->post('employee'); 
        // $path = $request->file('attachment');
        // $filename = 'Licence_'.time().'.'.$path->getClientOriginalExtension();
         
        
        // $path->move(public_path('bonus'), $filename);
        
        $bonus = $request->input('joining-bonus');
        $data = [ 
            'employee_id'=>$empid,
            'joining_bonus'=>$bonus,
             
        ];

        $result = DB::table('kmac_joining_bonus')->insert($data);
 
        if($result){
            return back()->with([
                'message'=>'Attachment Updated',
            ]);
        }

    }
    public function delete(Request $request )
    {
        $id = $request->input('id');
         
        $result = DB::table('kmac_joining_bonus')
        ->where('id','=',$id)
        ->delete();
       
        if($result){
            return response()->json([
                "message"=>"Record Row",
            ]);
        }
        
    }
    
    public function view(Request $request)
    {
        $id = $request->input('id'); 
       
        $result = DB::table('kmac_joining_bonus')
            ->join('kmac_employees','kmac_employees.employee_id','kmac_joining_bonus.employee_id')
            ->where('id',$id)
            ->get();
        
        echo json_encode($result);
                
    }
}
