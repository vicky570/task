<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @role('admin')
                {{ __('Admin Dashboard') }}
                <a href="{{ route('admin.admintest')}}" class="px-5 py-2 bg-green-400 text-white cursor-pointer">Add Product</a>
            @endrole

            @role('editor')
                {{ __('Editor Dashboard') }}
                <a href="{{ route('admin.editortest')}}" class="px-5 py-2 bg-green-400 text-white cursor-pointer">Link</a>
            @endrole
            

            {{-- check permission --}}
            @permission('add-post')
                <button type="button" class="px-5 py-2 bg-green-400 text-white">Add Post</button>
            @endpermission

            @permission('delete-post')
                <button type="button" class="px-5 py-2 bg-red-400 text-white">Delete Post</button>
            @endpermission

            <a href="{{ route('admin.posts.index') }}" class="px-5 py-2 bg-red-400 text-white">Posts</a>
        </h2>
    </x-slot>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> -->
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('new_product') }}">
            @csrf

            
            <div>
                <x-label for="product_name" :value="__('Product Name')" />

                <x-input id="product_name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            
            <div class="mt-4">
                <x-label for="image" :value="__('Image')" />

                <x-input id="image" class="block mt-1 w-full"
                                type="file"
                                name="image"
                                required/>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-admin-layout>
