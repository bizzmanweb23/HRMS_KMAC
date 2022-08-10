<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VaccinationController extends Controller
{
    public $prefix = "VAC";
    public $table = "kmac_emp_vaccination";
    
    public function index()
    {
        $company = DB::table('kmac_companies')->get();
        $employee = DB::table('kmac_employees')->get();
        $result = DB::table($this->table)->get();
       
        return view('Admin.Employee.emp-details.vaccination-status')
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
        $filename = $this->prefix.'_'.time().'.'.$path->getClientOriginalExtension();
         
         
        $path->move(public_path('vaccination'), $filename);
        
        $unique_id = DB::table($this->table)->orderBy('id', 'desc')->first();
        $number = str_replace('VAC', '', $unique_id ? $unique_id->id  : 0);
        if ($number == 0) {
            $number = $this->prefix.'-00001';
        } else {
            $number = $this->prefix .'-'. sprintf("%05d", $number + 1);
        }
        
        $data = [ 
            'employee_id'=>$empid,
            'cft_number'=>$number,
            'vaccination_certificate'=>$filename, 
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
        
        $result = DB::table('kmac_emp_vaccination')
                ->join('kmac_employees','kmac_employees.employee_id','kmac_emp_vaccination.employee_id') 
                ->where('kmac_emp_vaccination.id','=',$id)
                ->get();
        
        echo json_encode($result);
                
    }
    
}   
