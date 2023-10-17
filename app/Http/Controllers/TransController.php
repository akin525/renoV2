<?php


namespace App\Http\Controllers;


use App\Models\Advert;
use App\Models\RequestFund;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransController extends Controller
{
public function allrequest()
{
    $fund=RequestFund::where('username', Auth::user()->username)->get();
    return view('allrequest', compact('fund'));
}
public function alladvert()
{

    if (Auth::user()->plan ==null){
        $msg="Kindly Subscribe to any Membership plan before any post";
        Alert::info('Subscribe', $msg);

        return redirect('plan');
    }

        $advert = Advert::where('username', Auth::user()->username)->get();
        return view('ads.advert', compact('advert'));

}
}
