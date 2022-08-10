<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EmployeeDetailsController extends Controller
{ 
    public function index(Request $request)
    {   
        $OPT = $request->input('optval');
        $result = DB::table('kmac_employees')
        ->join('kmac_companies','kmac_companies.company_id','kmac_employees.company_id')
        ->where('employee_id',$OPT)
        ->get();
        print_r($result);
        exit();
    }

}
