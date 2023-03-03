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
                          <caption class="left">Companies List</caption>
                          <caption class="right">
                           <a href="{{route('company.create')}}">Add New Company</a> 
                          </caption>
                          <thead>
                            <tr>
                              <th scope="col">Sno.</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Logo</th>
                              <th scope="col">Website</th>
                               <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $count = 0 @endphp
                            @foreach($companies as $company)
                           
                            <tr>
                              <td data-label="Sno">{{$loop->iteration }}</td>
                              <td data-label="Name">{{$company->name }}</td>
                              <td data-label="Email">{{$company->email ?? '--' }}</td>
                              @if($company->logo=="")
                              <td data-label="Logo">--</td>
                              @else
                               <td data-label="Logo"><img src="{{asset('/storage/app/public/'.$company->logo)}}"   /></td>
                              @endif
                              <td data-label="Website" title={{$company->website }}>
                                <a href={{$company->website=="" ? '#' : $company->website}}>
                                    {{$company->website ? mb_strimwidth($company->website , 0, 30, "...") : '--'}}

                                </a>
                            </td>
                              <td> 
                                  <a href="{{ route('company.show', $company->id) }}" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                  </a>
                                  @php  $type = encrypt('delete');@endphp
                                  <a href="{{ route('company.destroy', [$company->id,'type='.$type]) }}" title="Edit">
                                   <i class="fa fa-trash-o" aria-hidden="true"></i>
                                 </a>
                                   
                               </td>
                            </tr>

                            @endforeach
                            
                          </tbody>
                        </table>
                        <div class="mt-2">
                        {{ $companies->links() }}
                     </div>
                     </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
