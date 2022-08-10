<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class WarningController extends Controller
{
    public function index()
    {
        $admin = DB::table('kmac_employees')->get();
        $employee = DB::table('kmac_employees')->get();
        $company = DB::table('kmac_companies')->get();
        $warningType = DB::table('kmac_warning_type')->get();
       
        $data = DB::table('kmac_employee_warnings')  
        ->join('kmac_companies','kmac_companies.company_id','kmac_employee_warnings.company_id')
        ->join('kmac_warning_type','kmac_warning_type.warning_type_id','kmac_employee_warnings.warning_type_id') 
        ->get();
       
        return view('Admin.CoreHr.warning')->with([
            'employees'=>$employee,
            'companies'=>$company,
            'data'=>$data,
            'warningType'=>$warningType,
            'admin'=>$admin,
        ]);
    }

    public function add_warning_form()
    {
         $admin = DB::table('kmac_employees') 
        
        ->get();
        $employee = DB::table('kmac_employees')->get();
        $company = DB::table('kmac_companies')->get();
        $warningType = DB::table('kmac_warning_type')->get();

        $data = DB::table('kmac_employee_warnings')  
        ->join('kmac_companies','kmac_companies.company_id','kmac_employee_warnings.company_id')
        ->join('kmac_warning_type','kmac_warning_type.warning_type_id','kmac_employee_warnings.warning_type_id') 
        ->get();
       
        return view('Admin.CoreHr.warning-add')->with([
            'employees'=>$employee,
            'companies'=>$company,
            'data'=>$data,
            'warningType'=>$warningType,
            'admin'=>$admin,
        ]);
    }
    public function store(Request $request)
    {   
        $path = $request->file('attachment');
        $image = 'w_'.time().'.'.$path->getClientOriginalExtension();
        echo $image;
        
        $path->storeAs('warning', $image,'public');
        $data = [
           'company_id'=>$request->input('company'),
           'attachment'=>$image,
           'warning_to'=>$request->input('warning-to'),
           'warning_by'=>$request->input('warning-by'),
           'warning_date'=>$request->input('warning-date'),
           'warning_type_id'=>$request->input('warning-type-id'),
          
           'subject'=>$request->input('warning-subject'),
           'description'=>$request->input('description'),
           
       ];
       $result = DB::table('kmac_employee_warnings')->insert($data);
       if($result){
           return redirect('warning')->with([
               'message'=>'Warning Added',
           ]);
       } 
    }

  
    public function show(Request $request)
    {
        $id = $request->post('id'); 
         
        $data = DB::table('kmac_employee_warnings')
        ->join('kmac_warning_type','kmac_warning_type.warning_type_id','kmac_employee_warnings.warning_type_id') 
        ->join('kmac_companies','kmac_companies.company_id','kmac_employee_warnings.company_id')
        ->where('kmac_employee_warnings.warning_id',$id)
        ->get();
        
       
        echo json_encode($data);
         
        //echo json_encode($data);
//        return response()->json([
//            'data'=>$data,
//        ]);
        
       }
 
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy(Request $request)
    {
        $id = $request->input('id'); 
        
        $data = DB::table('kmac_employee_warnings')
                ->where('warning_id',$id)
                ->delete();
        
        return response()->json([
            'data'=>$data 
        ]);
        
    }

}
