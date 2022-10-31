<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @role('admin')
                {{ __('Admin Dashboard') }}
                <a href="{{ route('admin.productList')}}" style="float: right;" class="px-5 py-2 bg-green-400 text-white cursor-pointer">Product</a>
                <a href="{{ route('admin.userList')}}" style="float: right; margin-right: 5px;" class="px-5 py-2 bg-green-400 text-white cursor-pointer">Users</a>
                
            @endrole
            

            {{-- check permission --}}
            @permission('add-post')
                
            @endpermission

        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
