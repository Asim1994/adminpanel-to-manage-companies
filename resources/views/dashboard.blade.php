<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display:flex">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="width: 50%;">
                <div class="p-6 text-gray-900">
                    {{ __("Number of Companies") }} : 
                   <b style="font-size:30px"> {{ company_count() }} </b>
                </div>
            </div></br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="width: 50%;">
                <div class="p-6 text-gray-900">
                    {{ __("Number of Employees") }} : 
                     <b style="font-size:30px"> {{ employee_count() }} </b>
                </div>
            </div>
           
        </div>
    </div>
</x-app-layout>
