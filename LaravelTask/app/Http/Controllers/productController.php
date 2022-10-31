<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class productController extends Controller
{
   public function productList()
    {
        // if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin')){
            $data = product::get();
            return view('list',compact('data'));
        // }
        // abort(403);
    }
}
