<?php

namespace App\Http\Controllers\admin;

use App\Models\Advert;
use App\Models\Plan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAdsController
{

    function adminads()
    {
        $allads=Advert::latest()->get();
        $cads=Advert::count();

        return view('admin.ads.dashboard', compact('allads', 'cads'));

    }

    function allads()
    {
        $ads=Advert::latest()->get();
        return view('admin.ads.allads', compact('ads'));

    }

    function deleteads($id)
    {
        $ads=Advert::where('id', $id)->delete();
        Alert::success('Approved', 'Advert Remove');
        return back();
    }
    function approveads($request)
    {
        $ads=Advert::where('id', $request)->first();
        $status=1;

        $ads->status=$status;
        $ads->save();

//        return response()->json([
//            'status' => 'success',
//            'message'=>'Advert Approved'
//        ]);
        Alert::success('Approved', 'Advert Approved');
        return back();
    }
    function dissaproveads($request)
    {
        $ads=Advert::where('id', $request)->first();
        $status=2;

        $ads->status=$status;
        $ads->save();

//        return response()->json([
//            'status' => 'success',
//            'message'=>'Advert Disapproved'
//        ]);

        Alert::warning('Disapproved', 'Advert Disapproved');
        return back();
    }
    function ediitadsplan()
    {
        $plan=Plan::get();
        return view('admin/editplan', compact('plan'));
    }
    function editplan(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'amount'=>'required',
            'limits'=>'required',
            'days'=>'required',
        ]);

        $plan=Plan::where('id', $request->id)->first();

        $plan->amount=$request->amount;
        $plan->limits=$request->limits;
        $plan->days=$request->days;
        $plan->save();

        $mg="Plan Update successfully";

        return response()->json([
            'status'=>'success',
            'message'=>$mg,
        ]);
    }

    function onoffplan($request)
    {
        $plan=Plan::where('id', $request)->first();
        if ($plan->status == "1") {
            $give = "0";
        } else {
            $give = "1";
        }
        $plan->status = $give;
        $plan->save();
        Alert::success('Admin', 'Plan update successfully');

        return redirect('admin/plan');
    }
}
