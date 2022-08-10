<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class LicenceController extends Controller
{
    public $prefix = "licence";

    public function index(){
        $result = DB::table('kmac_emp_licence')
                ->join('kmac_employees','kmac_employees.employee_id','kmac_emp_licence.employee_id')
                ->get(); 
        return view('Admin.Employee.emp-details.licence')->with([
            'result'=>$result,
         ]);
    }

    public function data_table()
    { 
        
        
        return Datatables::of($data)
         ->addColumn('action', function($data){
            $button = '<a href="javascript:void(0)"  id="'.$data->id.'" class="edit btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>';

            $button .= '&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  id="'.$data->id.'" class="delete btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>';
                        return $button;
        })->make(true);

         return view('Admin.Employee.emp-details.licence')->with([
            'result'=>$result,
         ]);
          
    } 
    
    public function store(Request $request)
    {    
         
        $empid = $request->post('employee-id');  
        $path = $request->file('attachment');
        
        $filename = $this->prefix.'_'.time().'.'.$path->getClientOriginalExtension();
        
        //$path->move(public_path('licence'), $filename);
        $path->storeAs('licence',$filename,'public');
            
        $unique_id = DB::table('kmac_emp_licence')->orderBy('id', 'desc')->first();
        $number = str_replace('LNC', '', $unique_id ? $unique_id->id  : 0);
        if ($number == 0) {
            $number = 'LNC0001';
        } else {
            $number = "LNC-" . sprintf("%05d", $number + 1);
        }
        
        $data = [ 
            'employee_id'=>$empid,
            'licence_no'=>$number,
            'emp_licence'=>$filename, 
        ];

        $result = DB::table('kmac_emp_licence')->insert($data);
         DB::table('kmac_emp_certificate_attained')->insert([
            'licence'=>$number,
        ]);  
        if($result){
            return back()->with([
                'message'=>'Attachment Updated',
            ]);
        }

    }
    public function delete(Request $request )
    {
        $id = $request->input('id');
         
        $result = DB::table('kmac_emp_licence')
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
        $id = $request->input("id");
        
        $result = DB::table('kmac_emp_licence')
                ->join('kmac_employees','kmac_employees.employee_id','kmac_emp_licence.employee_id')
                ->join('kmac_companies','kmac_companies.company_id','kmac_employees.company_id')
        ->where('id','=',$id)
        ->get();


       echo json_encode($result);
    }
   

   
    
}
