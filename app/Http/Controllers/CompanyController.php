<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompany;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try{
         $data['companies'] = Company::orderBy('id', 'DESC')->paginate(10);
         return view('company.all-company', $data);
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
           $data['company'] = '';
           $data['title'] = 'Add';
           return view('company.add-edit-company', $data); 
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
    public function store(StoreCompany $request)
    {   
         try{
            $details['name']      =  $request->name;
            $details['email']     =  $request->email;
            $details['website']   =  $request->website;
            //check if file exist 
              if($request->hasFile('logo')){
                $logo = $request->file('logo');
                $filename = random_int(100000, 999999).'.'.$logo->getClientOriginalName();
               
                $logo->storeAs('public/app/public/',$filename);
                 $details['logo']  =  $filename ??  "N/A";
                   
              }
            Company::create($details);
            return redirect()->route('company.index')->with('success', 'Company Added Successfully');
        } catch (Exception $e) {
          return redirect()->back()->with('success', 'Somthing Went Wrong');     
       }
             
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
         
        try{
             $data['title'] = 'Update';
            $data['company'] = $company;
            return view('company.add-edit-company', $data); 
       } catch (Exception $e) {
          return redirect()->back()->with('success', 'Somthing Went Wrong');     
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
       ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompany $request, Company $company)
    {
         
         try{
            $details['name']         =  $request->name;
            $details['email']        =  $request->email;
            $details['website']      =  $request->website;
            $details['company_id']   =  $request->company_id;
            //check if file exist 
              if($request->hasFile('logo')){
                $logo = $request->file('logo');
                $filename = random_int(100000, 999999).'.'.$logo->getClientOriginalName();
               
                $logo->storeAs('public/app/public/',$filename);
                 $details['logo']  =  $filename ??  "N/A";
                   
              }
            Company::updateOrCreate(['id' => $details['company_id']], $details);
            return redirect()->route('company.index')->with('success', 'Company Updated Successfully');
        } catch (Exception $e) {
          return redirect()->back()->with('success', 'Somthing Went Wrong');     
       }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    { 
       try{
              Company::find($company->id)->delete();
              Employee::where('company_id',$company->id)->delete();
            return redirect()->route('company.index')->with('success', 'Company Deleted Successfully');
        } catch (Exception $e) {
          return redirect()->back()->with('success', 'Somthing Went Wrong');     
       }
    }
}
