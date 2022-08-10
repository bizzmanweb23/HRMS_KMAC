<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class HomeController extends Controller
{
   public function cpf()
   {
      return view('Admin.cpf-submittion');
   }

   public function company_list(){
      $cmp = DB::table('kmac_companies')->get();
      echo json_encode($cmp);
   }

   public function employee_list(){
      $emp =  DB::table('kmac_employees')
                ->join('kmac_companies','kmac_companies.company_id','kmac_employees.company_id')
                ->get();
      return response()->json($emp);
   }

   public function add_cpf(Request $request)
   {
      $name = $request->input('name');
      $value = $request->input('value');
      $data = [
         'option_name'=>$name,
         'option_value'=>$value,
      ];
      $result = DB::table('xin_cpf_options')->insert(
         $data
      );
      if($result){
         return $result;
      }
   }
   public function cpf_data()
   {
      $data = DB::table('xin_cpf_options')->get();
      return response()->json([
         'data'=>$data
      ]);
      //zzecho json_encode($data);
   }
}
