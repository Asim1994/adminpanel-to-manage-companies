<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\StoreEmployee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try{
        
        $data['employees'] = Employee::orderBy('id', 'DESC')->paginate(10);
         return view('employee.all-employee', $data);
      } catch (Exception $e) {
         return redirect()->back()->with('success', 'Somthing Went Wrong');     
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
           $data['employee'] = '';
           $data['title'] = 'Add';
            $data['companies'] = Company::orderBy('id', 'DESC')->get();
           return view('employee.add-edit-employee', $data); 
       } catch (Exception $e) {
          return redirect()->back()->with('success', 'Somthing Went Wrong');     
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
       try{
            $details['first_name']      =  $request->first_name;
            $details['last_name']       =  $request->last_name;
            $details['gender']          =  $request->gender;
            $details['mobile']          =  $request->mobile;
            $details['email']           =  $request->email;
            $details['company_id']      =  $request->company;
             $details['status']         =  $request->status;
            
            
            Employee::create($details);
            return redirect()->route('employee.index')->with('success', 'Employee Added Successfully');
        } catch (Exception $e) {
          return redirect()->back()->with('success', 'Somthing Went Wrong');     
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
       try{
            $data['title'] = 'Update';
            $data['employee'] = $employee;
            $data['companies'] = Company::orderBy('id', 'DESC')->get();
           return view('employee.add-edit-employee', $data); 
       } catch (Exception $e) {
          return redirect()->back()->with('success', 'Somthing Went Wrong');     
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployee $request, Employee $employee)
    {
        try{
            $details['first_name']      =  $request->first_name;
            $details['last_name']       =  $request->last_name;
            $details['gender']          =  $request->gender;
            $details['mobile']          =  $request->mobile;
            $details['email']           =  $request->email;
            $details['company_id']      =  $request->company;
            $details['employee_id']   =    $request->employee_id;
            $details['status']         =  $request->status;
            
             Employee::updateOrCreate(['id' => $details['employee_id']], $details);
            return redirect()->route('employee.index')->with('success', 'Employee Updated Successfully');
        } catch (Exception $e) {
          return redirect()->back()->with('success', 'Somthing Went Wrong');     
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
       try{
            $data = Employee::find($employee->id)->delete();
            return redirect()->route('employee.index')->with('success', 'Employee Deleted Successfully');
        } catch (Exception $e) {
          return redirect()->back()->with('success', 'Somthing Went Wrong');     
       }
    }
}
