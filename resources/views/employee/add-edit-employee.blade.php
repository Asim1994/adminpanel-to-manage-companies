<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Company') }} 
      </h2>
   </x-slot>
   <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
         <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
               <section>
                  <header>
                     <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Employee Information') }} 
                     </h2>
                     <p class="mt-1 text-sm text-gray-600">
                        {{ $title}} Employee information
                     </p>
                  </header>
                  @if(session()->has('success'))
                  <div class="alert alert-success">
                     {{ session()->get('success') }}
                  </div>
                  @endif
                   <form method="post" action="{{  $employee ? route('employee.update', $employee->id) : route('employee.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                     @csrf
                     @if($employee && empty(Request::get('type') ))
                     @method('patch')
                     @endif 
                     @if((!empty(Request::get('type')) && decrypt(Request::get('type'))=='delete'))
                     @method('delete')
                     @endif
                     <input type="hidden" name="employee_id" value="{{$employee ? $employee->id : ''}}">
                     <div>
                        <x-input-label for="name" :value="__('Company')" />
                       <select class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out rounded-md ring-1 ring-black ring-opacity-5" name="company">
                        <option value="">--select company</option>
                        @foreach($companies as $company)
                        @if($employee)
                        <option value="{{$company->id}}" {{$employee->company_id == $company->id ? 'selected' : ''}}  >{{$company->name}}</option>
                        @else
                         <option value="{{$company->id}}" >{{$company->name}}</option>
                        @endif
                         
                         @endforeach
                       </select>
                        <x-input-error class="mt-2" :messages="$errors->get('company')" />
                     </div>
                     <div>
                        <x-input-label for="first_name" :value="__('First Name')" />
                        <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="$employee ? $employee->first_name : old('first_name')"  autofocus autocomplete="first_name" />
                        <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                     </div>
                     <div>
                        <x-input-label for="last_name" :value="__('Last Name')" />
                        <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="$employee ? $employee->last_name : old('last_name')"  autofocus autocomplete="last_name" />
                        <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                     </div>
                     <div>
                        <x-input-label for="name" :value="__('Gender')" />
                         
                           <input type="radio" id="Male" name="gender" value="Male">Male
                           <input type="radio" id="Female" name="gender" value="Female">Female

                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                     </div>
                      <div>
                        <x-input-label for="mobile" :value="__('Mobile')" />
                        <x-text-input id="mobile" name="mobile" type="text" class="mt-1 block w-full" :value="$employee ? $employee->mobile : old('mobile')"  autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('mobile')" />
                     </div>
                     <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="$employee ? $employee->email : old('email')"  autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                     </div>

                      <div>
                        <x-input-label for="status" :value="__('Status')" />
                       <select class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out rounded-md ring-1 ring-black ring-opacity-5" name="status">
                          @if($employee)
                          <option value="1"  {{$employee->status=='1' ? 'selected' : ''}} >Active</option>
                          <option value="2" {{$employee->status=='2' ? 'selected' : ''}}>Resigned</option>
                          <option value="3" {{$employee->status=='3' ? 'selected' : ''}}> Suspended</option>
                          @else
                           <option value="1" >Active</option>
                          <option value="2">Resigned </option>
                          <option value="3">Suspended</option>
                          @endif
                         
                       </select>
                        
                     </div>
                      
                      
                     <div class="flex items-center gap-4">
                        @if((!empty(Request::get('type')) && decrypt(Request::get('type'))=='delete'))
                        <x-danger-button class="ml-3">{{ __('Delete Company') }}</x-danger-button>
                        @else
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        @endif
                     </div>
                  </form>
               </section>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>