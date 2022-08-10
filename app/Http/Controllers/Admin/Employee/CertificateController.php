<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CertificateController extends Controller
{
    public $table = "kmac_emp_certificate_attained";
    
    public function index()
    {
        $company = DB::table('kmac_companies')->get();
        $employee = DB::table('kmac_employees')->get();
        
        $result = DB::table('kmac_employees') 
        ->join('kmac_emp_certificate_attained','kmac_emp_certificate_attained.employee_id','kmac_employees.employee_id') 
        ->join('kmac_emp_licence','kmac_emp_licence.employee_id','kmac_employees.employee_id') 
        ->join('kmac_emp_vaccination','kmac_emp_vaccination.employee_id','kmac_employees.employee_id') 
        ->join('kmac_emp_wsq_certificates','kmac_emp_wsq_certificates.employee_id','kmac_employees.employee_id')
        ->get(); 
       
       
        
        return view('Admin.Employee.emp-details.certificate-attained')
            ->with([
                'data'=>$result,
                'employees'=>$employee,
                'company'=>$company,
            ]);
    }

   
    public function store(Request $request)
    {           
        $empid = $request->post('employee'); 
        $path = $request->file('attachment');
        $filename = 'Licence_'.time().'.'.$path->getClientOriginalExtension();
         
         
        $path->move(public_path('certicates'), $filename);
        
        $data = [ 
            'employee_id'=>$empid,
            'attachment'=>$filename, 
        ];

        $result = DB::table('kmac_emp_certificate_attained')->insert($data);
 
        if($result){
            return back()->with([
                'message'=>'Attachment Updated',
            ]);
        }

    }
    public function delete(Request $request )
    {
        $id = $request->input('id');
         
        $result = DB::table('kmac_emp_certificate_attained')
        ->where('id','=',$id)
        ->delete();
       
        if($result){
            return response()->json([
                "message"=>"Record Row",
            ]);
        }
        
    }
}
