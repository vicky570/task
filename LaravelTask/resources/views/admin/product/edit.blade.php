<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @role('admin')
                {{ __('Edit Product') }}
                
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
<x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('admin.updateProduct', $data->id) }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$data->name}}" required autofocus />
            </div>

            <!-- Description -->
            <div>
                <x-label for="description" :value="__('Description')" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{$data->description}}" required autofocus />
            </div>

            <!-- Unit -->
            <div>
                <x-label for="unit" :value="__('Unit')" />

                <x-input id="unit" class="block mt-1 w-full" type="text" name="unit" value="{{$data->unit}}" required autofocus />
            </div>

            <!-- Price -->
            <div>
                <x-label for="price" :value="__('Price')" />

                <x-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{$data->price}}" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    Update
                </x-button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</x-admin-layout>