<?php
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;

if (!function_exists('company_count')) {
    function company_count()
    {
        $company_count = Company::count();
        return $company_count ? $company_count : 0;
    }

}

if (!function_exists('employee_count')) {
    function employee_count()
    {
      $Employee = Employee::count();
        return $Employee ? $Employee : 0;
    }

}

if (!function_exists('company_details')) {
    function company_details($id)
    {
      $company_details = Company::where('id',$id)->first();
        return $company_details ? $company_details : 0;
    }

}

if (!function_exists('status_type')) {
    function status_type($type)
    { 
     if($type==1){
       $status_type =  "Active";
      }elseif($type==2){
        $status_type =  "Resigned";
      }elseif($type==3){
         $status_type =  "Suspended";
      }else{
         $status_type =  "--";
      }
        return $status_type;
    }

}

 
 
