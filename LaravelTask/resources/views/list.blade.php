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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                      <tr>
                        <th>Name</th>
                        <th>Descriptin</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <!-- <th>Action</th> -->
                      </tr>
                      @foreach($data as $product)
                      <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->unit}}</td>
                        <td>{{$product->price}}</td>
                        <!-- <td><a href="{{ route('admin.productEdit', $product->id)}}" class="px-5 py-2 cursor-pointer">Edit</a>
                        <a href="{{ route('admin.productDelete', $product->id)}}" class="px-5 py-2 cursor-pointer">Delete</a></td> -->
                      </tr>
                      @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
