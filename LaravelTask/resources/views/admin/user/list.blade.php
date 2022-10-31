<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @role('admin')
                {{ __('User List') }}
                <a href="{{ route('admin.addUser')}}" style="float: right;" class="px-5 py-2 bg-green-300 text-white cursor-pointer">Add New User</a>
            @endrole
            

            {{-- check permission --}}
            @permission('add-post')
                
            @endpermission

        </h2>
    </x-slot>
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                      @foreach($data as $user)
                      <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><a href="{{ route('admin.userEdit', $user->id)}}" class="px-5 py-2 cursor-pointer">Edit</a>
                        <a onclick="return confirm('Are you sure?')" href="{{ route('admin.userDelete', $user->id)}}" class="px-5 py-2 cursor-pointer">Delete</a></td>
                      </tr>
                      @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
