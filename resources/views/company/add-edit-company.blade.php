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
                        {{ __('Company Information') }} 
                     </h2>
                     <p class="mt-1 text-sm text-gray-600">
                        {{ $title}} your Company information
                     </p>
                  </header>
                  @if(session()->has('success'))
                  <div class="alert alert-success">
                     {{ session()->get('success') }}
                  </div>
                  @endif
                  <form method="post" action="{{  $company ? route('company.update', $company->id) : route('company.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                     @csrf
                     @if($company && empty(Request::get('type') ))
                     @method('patch')
                     @endif 
                     @if((!empty(Request::get('type')) && decrypt(Request::get('type'))=='delete'))
                     @method('delete')
                     @endif
                     <input type="hidden" name="company_id" value="{{$company ? $company->id : ''}}">
                     <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$company ? $company->name : old('name')"  autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                     </div>
                     <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="$company ? $company->email : old('email')"  autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                     </div>
                     <div>
                        <x-input-label for="logo" :value="__('Logo')" />
                        <x-text-input id="logo" name="logo" type="file" class="mt-1 block w-full" autofocus autocomplete="logo" />
                        <x-input-error class="mt-2" :messages="$errors->get('logo')" />
                        @if($company && $company->logo!="" )
                        <img src="{{asset('/storage/app/public/'.$company->logo)}}"   />
                        @endif
                     </div>
                     <div>
                        <x-input-label for="website" :value="__('Website')" />
                        <x-text-input id="website" name="website" type="url" class="mt-1 block w-full" :value="$company ? $company->website : old('website')" autofocus autocomplete="website" />
                        <x-input-error class="mt-2" :messages="$errors->get('website')" />
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