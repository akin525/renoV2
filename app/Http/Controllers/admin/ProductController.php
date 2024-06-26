<?php

namespace app\Http\Controllers\admin;

use App\Models\airtimecon;
use App\Models\big;
use App\Models\data;
use App\Models\easy;
use App\Models\Mcd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController
{
public function index()
{
    $product=data::paginate(50);

    return view('admin/product', compact('product'));
}
public function indexmcd()
{
    $product=Mcd::paginate(50);

    return view('admin/mcdproduct', compact('product'));
}
    public function index1()
    {
        $product=big::paginate(50);

        return view('admin/product1', compact('product'));
    }
    public function index2()
    {
        $product=easy::paginate(50);

        return view('admin/product2', compact('product'));
    }
public function on(Request $request)
{
    $product = data::where('id', $request->id)->first();

    if ($product->status == "1") {
        $give = "0";
    } else {
        $give = "1";
    }
    $product->status = $give;
    $product->save();
    Alert::success('Admin', 'Product update successfully');

    return redirect('admin/product');

}
public function onmcd(Request $request)
{
    $product = Mcd::where('id', $request->id)->first();

    if ($product->status == "1") {
        $give = "0";
    } else {
        $give = "1";
    }
    $product->status = $give;
    $product->save();
    Alert::success('Admin', 'Product update successfully');

    return redirect('admin/mcdproduct');

}
    public function on1(Request $request)
    {
        $product = big::where('id', $request->id)->first();

        if ($product->status == "1") {
            $give = "0";
        } else {
            $give = "1";
        }
        $product->status = $give;
        $product->save();
        Alert::success('Admin', 'Product update successfully');

        return redirect('admin/product1');

    }
    public function on2(Request $request)
    {
        $product = easy::where('id', $request->id)->first();

        if ($product->status == "1") {
            $give = "0";
        } else {
            $give = "1";
        }
        $product->status = $give;
        $product->save();
        Alert::success('Admin', 'Product update successfully');

        return redirect('admin/product2');

    }
public function in(Request $request)
{

    $pro=data::where('id', $request->id)->first();

return view('admin/editproduct', compact('pro'));
}
    public function in1(Request $request)
    {

        $pro=big::where('id', $request->id)->first();

        return view('admin/editproduct1', compact('pro'));
    }
    public function in2(Request $request)
    {

        $pro=easy::where('id', $request->id)->first();

        return view('admin/editproduct2', compact('pro'));
    }
public function edit(Request $request)
{
    $request->validate([
        'id' => 'required',
        'tamount' => 'required',
        'ramount' => 'required',
        'pamount' => 'required',
        'name' => 'required',
    ]);
    $pro=data::where('id', $request->id)->first();
    $pro->plan=$request->name;
    $pro->tamount=$request->tamount;
    $pro->ramount=$request->ramount;
    $pro->api_amount=$request->pamount;

    $pro->save();
    return response()->json([
        'status'=>'success',
        'message'=>'Product update successfully',
    ]);
}
public function editmcd(Request $request)
{
    $request->validate([
        'id' => 'required',
        'tamount' => 'required',
        'ramount' => 'required',
        'pamount' => 'required',
        'name' => 'required',
    ]);
    $pro=Mcd::where('id', $request->id)->first();
    $pro->plan=$request->name;
    $pro->tamount=$request->tamount;
    $pro->ramount=$request->ramount;
    $pro->api_amount=$request->pamount;

    $pro->save();
    return response()->json([
        'status'=>'success',
        'message'=>'Product update successfully',
    ]);
}
    public function edit1(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'tamount' => 'required',
            'ramount' => 'required',
            'pamount' => 'required',
            'name' => 'required',
        ]);
        $pro=big::where('id', $request->id)->first();
        $pro->plan=$request->name;
        $pro->tamount=$request->tamount;
        $pro->ramount=$request->ramount;
        $pro->api_amount=$request->pamount;
        $pro->save();
        return response()->json([
            'status'=>'success',
            'message'=>'Product update successfully',
        ]);


    }
    public function edit2(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'tamount' => 'required',
            'ramount' => 'required',
            'pamount' => 'required',
            'name' => 'required',
        ]);
        $pro=easy::where('id', $request->id)->first();
        $pro->plan=$request->name;
        $pro->tamount=$request->tamount;
        $pro->ramount=$request->ramount;
        $pro->api_amount=$request->pamount;
        $pro->save();
        return response()->json([
            'status'=>'success',
            'message'=>'Product update successfully',
        ]);


    }


public function air()
{
    $air=DB::table('airtimecons')->get();

    return view('admin/air', compact("air"));
}

public function pair(Request $request)
{
    $air = airtimecon::where('id', $request->id)->first();
    if ($air->status == 1){
        $na= '0';
    }elseif ($air->status == 0){
        $na='1';
    }

    $air->status=$na;
    $air->save();

    return redirect('admin/air')->with('status', 'Server update successfully');

}


}
