<?php

namespace App\Http\Controllers\admin;

use App\Models\Advert;

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
    function approveads($request)
    {
        $ads=Advert::where('id', $request)->first();
        $status=1;

        $ads->sataus=$status;
        $ads->save();

        return response()->json([
            'status' => 'success',
            'message'=>'Advert Approved'
        ]);
    }
    function dissaproveads($request)
    {
        $ads=Advert::where('id', $request)->first();
        $status=2;

        $ads->sataus=$status;
        $ads->save();

        return response()->json([
            'status' => 'success',
            'message'=>'Advert Disapproved'
        ]);
    }
}
