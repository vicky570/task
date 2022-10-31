<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class HomeController extends Controller
{
    public function index()
    {
        // dd(\Auth::guard('admin')->user()->hasRole('editor'));
        return view('admin.dashboard');
    }


    public function adminTest()
    {
        // if(\Auth::guard('admin')->user()->hasRole('admin')){
        //     dd('only admin allowed');
        // }
        if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin')){
            return view('admin.new_product');
        }
        abort(403);
    }

    public function editorTest()
    {
        if(\Auth::guard('admin')->user()->hasRole('editor')){
            return view('admin.new_product');
        }
        abort(403);
    }

    public function productList()
    {
        if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin')){
            $data = product::get();
            return view('admin.product.list',compact('data'));
        }
        abort(403);
    }

    public function userList()
    {
        if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin')){
            $data = User::get();
            return view('admin.user.list',compact('data'));
        }
        abort(403);
    }

    public function addUser()
    {
        if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin')){
            return view('admin.user.add');
        }
        abort(403);
    }

    public function addProduct()
    {
        if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin')){
            return view('admin.product.add');
        }
        abort(403);
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('admin.userList')->with('success', 'User saved.');
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
        ]);

        $user = product::create([
            'name' => $request->name,
            'description' => $request->description,
            'unit' => $request->unit,
            'price' => $request->price,
        ]);

        // return $this->productList()->with('success', 'Product created.');;
       return redirect()->route('admin.productList')->with('success', 'Product created.');
    }

    public function userEdit($id)
    {
        if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin')){
            $data = User::where('id',$id)->first();
            return view('admin.user.edit', compact('data'));
        }
        abort(403);
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.userList')->with('success', 'User updated.');
    }

    public function productEdit($id)
    {
        if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin')){
            $data = product::where('id',$id)->first();
            return view('admin.product.edit', compact('data'));
        }
        abort(403);
    }

    public function productDelete($id)
    {
        try{
            if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin')){
                $data = product::where('id',$id)->delete();
                return redirect()->route('admin.productList')->with('success', 'Deleted Successfully !!');
            }
        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function userDelete($id)
    {
        try{
            if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin')){
                $data = User::where('id',$id)->delete();
                return redirect()->route('admin.userList')->with('success', 'Deleted Successfully !!');
            }
        }catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
        ]);

        $user = product::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'unit' => $request->unit,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.productList')->with('success', 'Product updated.');
    }

}
