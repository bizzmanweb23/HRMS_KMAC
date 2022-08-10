<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WsqController extends Controller
{
    public $table = 'kmac_emp_wsq_certificates';
    public $prefix = 'WSQ-';
    
    public function index()
    
    {
        $company = DB::table('kmac_companies')->get();
        $employee = DB::table('kmac_employees')->get();
        $result = DB::table($this->table)->get();
       
        return view('Admin.Employee.emp-details.wsq-certificate')
            ->with([
                'result'=>$result,
                'employees'=>$employee,
                'company'=>$company,
            ]);
    }

    public function store(Request $request)
    {           
        $empid = $request->post('employee'); 
        $path = $request->file('attachment');
        $filename = $this->prefix.time().'.'.$path->getClientOriginalExtension();
         
       
        $path->move(public_path('wsq'), $filename);
        
        $unique_id = DB::table($this->table)->orderBy('id', 'desc')->first();
        $number = str_replace('EDU', '', $unique_id ? $unique_id->id  : 0);
        if ($number == 0) {
            $number = 'WSQ-0001';
        } else {
            $number = "WSQ-" . sprintf("%05d", $number + 1);
        }
        
        $data = [ 
            'employee_id'=>$empid,
            'cft_number'=>$number,
            'wsq_certificate'=>$filename, 
        ];

        $result = DB::table($this->table)->insert($data);
 
        if($result){
            return back()->with([
                'message'=>'Attachment Updated',
            ]);
        }

    }
    public function delete(Request $request )
    {
        $id = $request->input('id');
         
        $result = DB::table($this->table)
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
      
        $result = DB::table('kmac_emp_wsq_certificates')
                ->join('kmac_employees','kmac_employees.employee_id','kmac_emp_wsq_certificates.employee_id') 
                ->where('kmac_emp_wsq_certificates.id','=',$id)
                ->get();
        
        echo json_encode($result);
                
    }
   
}
