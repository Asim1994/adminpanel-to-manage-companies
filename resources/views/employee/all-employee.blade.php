 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               @if(session()->has('success'))
                   <div class="alert alert-success">
                       {{ session()->get('success') }}
                   </div>
                 @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                      <table>
                          <caption class="left">Employees List</caption>
                          <caption class="right">
                           <a href="{{route('employee.create')}}">Add New Employee</a> 
                          </caption>
                          <thead>
                            <tr>
                            <th scope="col">Sno.</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Mobile</th>
                             <th scope="col">Email</th>
                            <th scope="col">Company</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $count = 0 @endphp
                            @foreach($employees as $employee)
                           
                            <tr>
                                <td data-label="Sno">{{$loop->iteration }}</td>
                                <td data-label="First Name">{{$employee->first_name }}</td>
                                <td data-label="Last Name">{{$employee->last_name ?? '--' }}</td>
                                <td data-label="Gender">{{$employee->gender ?? '--' }}</td>
                                <td data-label="Mobile">{{$employee->mobile ?? '--' }}</td>
                                <td data-label="Email">{{$employee->email ?? '--' }}</td>
                                <td data-label="Company">{{company_details($employee->company_id)->name }}</td>
                                <td data-label="Status">{{status_type($employee->status) }}</td>
                            
                             <td> 
                                  <a href="{{ route('employee.show', $employee->id) }}" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                  </a>
                                  @php  $type = encrypt('delete');@endphp
                                  <a href="{{ route('employee.destroy', [$employee->id,'type='.$type]) }}" title="Edit">
                                   <i class="fa fa-trash-o" aria-hidden="true"></i>
                                 </a>
                                   
                               </td>
                            </tr>

                            @endforeach
                            
                          </tbody>
                        </table>
                        <div class="mt-2">
                        {{ $employees->links() }}
                     </div>
                     </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
