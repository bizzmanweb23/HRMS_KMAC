<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ReferalController extends Controller
{   
    public $prefix = "referal_column";
     
    public function index()
    {
        $company = DB::table('kmac_companies')->get();
        $employee = DB::table('kmac_employees')->get();
        $result = DB::table('kmac_emp_referal_column')->get();
       
        return view('Admin.Employee.emp-details.referral-column')
            ->with([
                'licence'=>$result,
                'employees'=>$employee,
                'company'=>$company,
            ]);
    }

     public function store(Request $request)
    {           
         
        $empid = $request->post('employee'); 
        $path = $request->file('attachment');
        $filename = $this->prefix.'_'.time().'.'.$path->getClientOriginalExtension();
         
         
        $path->move(public_path('referal'), $filename);
        
        $data = [ 
            'employee_id'=>$empid,
            'attachment'=>$filename, 
        ];

        $result = DB::table('kmac_emp_referal_column')->insert($data);
 
        if($result){
            return back()->with([
                'message'=>'Attachment Updated',
            ]);
        }

    }
    public function delete(Request $request )
    {
        $id = $request->input('id');
         
        $result = DB::table('kmac_emp_referal_column')
        ->where('id','=',$id)
        ->delete();
       
        if($result){
            return response()->json([
                "message"=>"Record Row",
            ]);
        }
        
    }
}
