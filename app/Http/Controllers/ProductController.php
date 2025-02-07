<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productstore(Request $request)
    {
        $emp = new Product();
        $emp->name = $request->name;
        $emp->price = $request->price;
        $emp->category = $request->category;
        $emp->condition = $request->condition;
        $emp->profilepic = $request->profilepic;
        $emp->expirydate = $request->expirydate;
    
        if ($request->hasFile('profilepic')) {
            $file = $request->file('profilepic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $filename, 'public');
            $emp->profilepic = $path;
        }
    
        $emp->save();

        return response()->json(['success' => 'Product added successfully!']);
    }
    public function productget()
    {
        $data=Product::all();
        return response()->json($data);
    }
    public function productedit($id)
    {
        $data=Product::findOrFail($id);
        return response()->json($data);
    }
    public function productupdate(Request $request,$id)
    {
        $emp =Product::findOrFail($id);
        $emp->name = $request->name;
        $emp->price = $request->price;
        $emp->category = $request->category;
        $emp->condition = $request->condition;
        $emp->profilepic = $request->profilepic;
        $emp->expirydate = $request->expirydate;
    
        if ($request->hasFile('profilepic')) {
            $file = $request->file('profilepic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $filename, 'public');
            $emp->profilepic = $path;
        }
    
        $emp->save();
        return response()->json(['success' => 'Product Updated successfully!']);

    }
    public function productdelete($id)
    {
        $data=Product::findOrFail($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully!']);
    }
}
