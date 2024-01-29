<?php
namespace app\Http\Controllers\admin;


use App\Models\airtimecon;
use App\Models\big;
use App\Models\charp;
use App\Models\data;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SetController
{
    public function index()
    {
        $charge=setting::first();

        return view("admin/setcharge", compact("charge"));
    }
    public function index2()
    {
        $charge=setting::first();

        return view("admin/rsetcharge", compact("charge"));
    }

    public function charge(Request $request)
    {
        $request->validate([
           'body'=>'required',
        ]);

        $charge=setting::first();

        $charge->charges=$request->body;
        $charge->save();

        Alert::success('Admin','Charges Updated');
        return redirect('admin/setcharge');

    }
    public function charger(Request $request)
    {
        $request->validate([
           'body'=>'required',
        ]);

        $charge=setting::first();

        $charge->rcharges=$request->body;
        $charge->save();

        return response()->json([
            'status'=>1,
            'message'=>'Charges Updated',
        ]);

    }
    public function index1()
    {
        $min=setting::first();

        return view("admin/setmin", compact("min"));
    }
    public  function min(Request $request)
    {
        $request->validate([
            'body'=>'required',
        ]);
        $min=setting::first();
        $min->len=$request->body;
        $min->save();

        return redirect('admin/setmin')->with('status', 'Minimum Fund Updated');
    }
}
