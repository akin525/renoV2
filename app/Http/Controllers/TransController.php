<?php


namespace App\Http\Controllers;


use App\Models\Advert;
use App\Models\Plan;
use App\Models\RequestFund;
use App\Models\User;
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
    $user=User::where('username', Auth::user()->username)->first();

    $advert=Advert::where('username', $user->username)->count();
    $plan=Plan::where('plan', $user->plan)->first();
    if ($plan){
        if ($plan->limits == $advert){
            $msg="Please kindly upgrade your plan, you have reach plan limits";
            Alert::warning('Ooops...', $msg);
            return redirect('plan');
        }
    }

    if ($user->plan ==null){
        $msg="Kindly Subscribe to any Membership plan before any post";
        Alert::info('Subscribe', $msg);

        return redirect('plan');
    }else {

        $advert = Advert::where('username', Auth::user()->username)->get();
        return view('ads.advert', compact('advert'));
    }

}
}
