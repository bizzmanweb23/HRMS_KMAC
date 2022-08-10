<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    
    public function index()
    {
        $company = DB::table('kmac_companies')->get();

        $result = DB::table('kmac_employees') 
        ->select('kmac_employees.*','kmac_employees.username as empname','kmac_companies.*',
                'kmac_designations.*','kmac_departments.*')
        ->join('kmac_companies','kmac_companies.company_id','kmac_employees.company_id') 
        ->join('kmac_designations','kmac_designations.designation_id','kmac_employees.designation_id')
        ->join('kmac_departments','kmac_departments.department_id','kmac_employees.department_id')
        ->get();  
        
        $country = DB::table('countries')->get();
        $company = DB::table('kmac_companies')->distinct()->get(); 
        $department = DB::table('kmac_departments')->get();
        $designation = DB::table('kmac_designations')->get();
        
        
        
        
            return view('Admin.Employee.employee-list')->with([
               'data'=>$result,
               'company'=>$company, 
               'country'=>$country,
                'department'=>$department,
               'designation'=>$designation, 
              
            ]); 
        
    }
    
	public function employee_tabs()
	{
		 $data = DB::table('kmac_employees')
        ->join('kmac_designations','kmac_designations.designation_id','kmac_employees.designation_id')
        ->get(); 

        $country = DB::table('countries')->get();
        $department = DB::table('kmac_departments')->get();
        $designation = DB::table('kmac_designations')->get();
        
        return view('Admin.Employee.employees')->with([
            'employee'=>$data, 
            'result'=>$data,
            'country'=>$country,
            'department'=>$department,
            'designation'=>$designation,
        ]); 
	}
	public function employee_tab_edit($id){
		 
			$data = DB::table('kmac_employees')
			->join('kmac_designations','kmac_designations.designation_id','kmac_employees.designation_id')
			->join('kmac_departments','kmac_departments.department_id','kmac_employees.department_id')
			->where('employee_id',$id)
			->get(); 
			

			$country = DB::table('countries')->get();
			$department = DB::table('kmac_departments')->get();
			$designation = DB::table('kmac_designations')->get();
			$company = DB::table('kmac_companies')->get();

			return view('Admin.Employee.employee-edit')->with([
				'result'=>$data,
				'country'=>$country,
				'department'=>$department,
				'designation'=>$designation,
				'company'=>$company,
			]);

	}
	
    public function employee_add_form()
    {
        
        $company = DB::table('kmac_companies')->get();

        $result = DB::table('kmac_employees')  
        ->get();  
      
        $department = DB::table('kmac_departments')->get();
        $designation = DB::table('kmac_designations')->get();
        $company = DB::table('kmac_companies')->distinct()->get();
        $role = DB::table('hrms_roles')->get();
        $country = DB::table('countries')->get(); 
        
//        print "<pre>";
//        print_r($company);
//        print_r($designation);
//        print_r($department);
//        print_r($country);
//        exit();
        return view('Admin.Employee.employee-add')->with([

           'company'=>$company, 
           'department'=>$department,
           'designation'=>$designation,
           'country'=>$country,
        ]); 
     
    }
 
    public function store(Request $request)
    {
        $unique_id = DB::table('kmac_employees')->orderBy('employee_id', 'desc')->first();
        $number = str_replace('EMP', '', $unique_id ? $unique_id->employee_id  : 0);
        if ($number == 0) {
            $number = 'EMP-00001';
        } else {
            $number = "EMP-" . sprintf("%05d", $number + 1);
        }
        $file = $request->file('image');
        $filename = 'Emp-'.time().'.'.$file->getClientOriginalExtension();
        // $file->move(public_path('Employee'), $filename);
        $file->storeAs('employee',$filename, 'public');
        $data = [
            
            'emp_code'=>$number,
            'first_name'=>$request->input('first-name'),
            'last_name'=>$request->input('last-name'),
            'email'=>$request->input('email'),
            'company_id'=>$request->input('company'),
            'username'=>$request->input('first-name').' '.$request->input('last-name'), 
           
            'designation_id'=>$request->input('designation'),
            'department_id'=>$request->input('department'),
            'date_of_birth'=>$request->input('dob'),
            'gender'=>$request->input("gender"),
            'emp_contact'=>$request->input('phone'),
            'date_of_joining'=>$request->input('date-of-join'), 
            
            'country'=>$request->input('country'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'zipcode'=>$request->input('postal-code'),
           
            'address'=>$request->input('address'), 
            'image'=>$filename,
        ];
        
        
        $result = DB::table('kmac_employees')->insert($data);
        
        if($result){
            return redirect('employee')->with('message','Employee Inserted');
        } 
    }
    
    public function view(Request $request)
    { 
         
        $id =  $request->post('id');
       
        $result = DB::table('kmac_employees') 
        ->join('kmac_companies','kmac_companies.company_id','kmac_employees.company_id')  
        ->join('kmac_designations','kmac_designations.designation_id','kmac_employees.designation_id')
        ->join('kmac_departments','kmac_departments.department_id','kmac_employees.department_id')
        ->where('employee_id','=',$id)
        ->get(); 
     
       echo json_encode($result);

    } 
    
    public function destroy($id)
    { 	  
        $image = DB::table('kmac_employees')->select('image')->where('employee_id',$id)->get();
		$image_path = "public/storage/employee/".$image[0]->image; 

        if (file_exists($image_path)) { 
           @unlink($image_path); 
        }

        $result = DB::table('kmac_employees')
        ->where('employee_id','=',$id)
        ->delete();
		 
		echo json_encode($result);
   }
    
    public function edit(Request $request)
    { 
        $id = $request->input('id'); 
        
        $employee = DB::table('kmac_employees')->get();
        $company = DB::table('kmac_companies')->get();
        
         
        $result = DB::table('kmac_employees') 
        ->join('kmac_companies','kmac_companies.company_id','kmac_employees.company_id') 
        ->join('kmac_designations','kmac_designations.designation_id','kmac_employees.designation_id')
        ->join('kmac_departments','kmac_departments.department_id','kmac_employees.department_id')
        ->where('employee_id','=',$id)
        ->get();  
         
        echo json_encode($result);
       
    }
    
    public function update(Request $request)
    {	 
        $id = $request->input('userid');
        $image = DB::table('kmac_employees')->select('image')->where('employee_id',$id)->get();
      
        if($request->hasFile('image'))
        { 
            $image_path = "public/storage/employee/".$image[0]->image; 

            if (file_exists($image_path)) { 
               @unlink($image_path); 
            }

            $file = $request->file('image');
            $filename = 'emp_image_'.time().'.'.$file->getClientOriginalExtension(); 
            echo $filename;   
            
            //$file->move(public_path('Employee'), $filename);
            $file->storeAs('employee',$filename,'public');
            $unique_id = DB::table('kmac_employees')->orderBy('employee_id', 'desc')->first();
            $number = str_replace('EMP', '', $unique_id ? $unique_id->employee_id  : 0);
            if ($number == 0) {
                $number = 'EMP-00001';
            } else {
                $number = "EMP" . sprintf("%05d", $number + 1);
            }

         $data = [
            
            'emp_code'=>$number,
            'first_name'=>$request->input('first-name'),
            'last_name'=>$request->input('last-name'),
            'email'=>$request->input('email'),
            'company_id'=>$request->input('company'),
            'username'=>$request->input('first-name').' '.$request->input('last-name'), 
           
            'designation_id'=>$request->input('designation'),
            'department_id'=>$request->input('department'),
            'date_of_birth'=>$request->input('dob'),
            'gender'=>$request->input("gender"),
            'emp_contact'=>$request->input('phone'),
            'date_of_joining'=>$request->input('date-of-join'), 
            
            'country'=>$request->input('country'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'zipcode'=>$request->input('postal-code'),
           
            'address'=>$request->input('address'), 
             'image'=>$filename,
        ];  
         $result = DB::table('kmac_employees')->where('employee_id',$id)->update($data);
        } 
        
            $unique_id = DB::table('kmac_employees')->orderBy('employee_id', 'desc')->first();
            $number = str_replace('EMP', '', $unique_id ? $unique_id->employee_id  : 0);
            if ($number == 0) {
                $number = 'EMP-00001';
            } else {
                $number = "EMP" . sprintf("%05d", $number + 1);
            }
  
            $data = [
            
                'emp_code'=>$number,
                'first_name'=>$request->input('first-name'),
                'last_name'=>$request->input('last-name'),
                'email'=>$request->input('email'),
                'company_id'=>$request->input('company'),
                'username'=>$request->input('first-name').' '.$request->input('last-name'), 
               
                'designation_id'=>$request->input('designation'),
                'department_id'=>$request->input('department'),
                'date_of_birth'=>$request->input('dob'),
                'gender'=>$request->input("gender"),
                'emp_contact'=>$request->input('phone'),
                'date_of_joining'=>$request->input('date-of-join'), 
                
                'country'=>$request->input('country'),
                'city'=>$request->input('city'),
                'state'=>$request->input('state'),
                'zipcode'=>$request->input('postal-code'),
               
                'address'=>$request->input('address'), 
                 

            ];  
                $result = DB::table('kmac_employees')->where('employee_id',$id)->update($data);
            

         
            return back()->with('message','Employee Updated');
 
    }
    
    
    
}
