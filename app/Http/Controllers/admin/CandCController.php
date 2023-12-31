<?php

namespace App\Http\Controllers\admin;

use App\Console\encription;
use App\Mail\Emailcharges;
use App\Mail\Emailfund;
use App\Models\charge;
use App\Models\charp;
use App\Models\deposit;
use App\Models\setting;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class CandCController
{
    public function cr()
    {
        if (Auth()->user()->role == "admin") {

            $wallet = wallet::get();
            $totalwallet = 0;
            foreach ($wallet as $wall) {
                $totalwallet += (int)$wall->balance;

            }
            return view('admin/credit', compact('totalwallet'));
        }
        return redirect("admin/login")->with('status', 'You are not allowed to access');


    }
public function credit(Request $request)
{
    $request->validate([
        'username' => 'required',
        'amount' => 'required',
        'refid' => 'required',
    ]);
    if (Auth()->user()->role == "admin") {


        $user = User::where('username', encription::encryptdata($request->username))->first();
        if (!isset($user)){

            return response()->json('User Not Found', Response::HTTP_BAD_REQUEST);

        }
        $wallet = wallet::where('username', encription::encryptdata($request->username))->first();

        $depo = deposit::where('payment_ref', encription::encryptdata($request->refid))->first();
        if (isset($depo)) {
            return response()->json('Duplicate Transaction', Response::HTTP_CONFLICT);

        } else {
            $gt = $wallet->balance + $request->amount;
            $deposit = deposit::create([
                'username' => encription::encryptdata($request->username),
                'payment_ref' => $request->refid,
                'amount' => $request->amount,
                'iwallet' => $wallet->balance,
                'fwallet' => $gt,
            ]);

            $wallet->balance = $gt;
            $wallet->save();
            $admin = 'info@renomobilemoney.com';

            $receiver = encription::decryptdata($user->email);
            Mail::to($receiver)->send(new Emailfund($deposit));
            Mail::to($admin)->send(new Emailfund($deposit));
            $mo=$request->username." was successful fund with NGN".$request->amount;
           return response()->json([
               'status'=>'success',
               'message'=>$mo,
           ]);

        }
    }
    return redirect("admin/login")->with('status', 'You are not allowed to access');


}

public function creditFund(Request $request)
{
    $request->validate([
        'username' => 'required',
        'amount' => 'required',
    ]);
    if (Auth()->user()->role == "admin") {


        $user = User::where('username', encription::encryptdata($request->username))->first();
        if (!isset($user)){

            return response()->json('User Not Found', Response::HTTP_BAD_REQUEST);

        }
        $wallet = wallet::where('username', encription::encryptdata($request->username))->first();

        $depo = deposit::where('payment_ref', encription::encryptdata($request->refid))->first();

            $gt = $wallet->balance + $request->amount;

            $wallet->balance = $gt;
            $wallet->save();
            $admin = 'info@renomobilemoney.com';

            $receiver = encription::decryptdata($user->email);
//            Mail::to($receiver)->send(new Emailfund($deposit));
//            Mail::to($admin)->send(new Emailfund($deposit));
            $mo=$request->username." was successful refund with NGN".$request->amount;
           return response()->json([
               'status'=>'success',
               'message'=>$mo,
           ]);

    }
    return redirect("admin/login")->with('status', 'You are not allowed to access');


}
public function sp()
{
    $ch=charp::get();
    return view('admin/charge', compact('ch'));

}
public function charge(Request $request)
{
    $request->validate([
        'username' => 'required',
        'amount' => 'required',
        'refid' => 'required',
    ]);
    if (Auth()->user()->role == "admin") {
        $user = User::where('username', encription::encryptdata($request->username))->first();
        if (!isset($user)){
            return response()->json('User Not Found', Response::HTTP_BAD_REQUEST);


        }
        $wallet = wallet::where('username', $user->username)->first();
        $gt = $wallet->balance - $request->amount;
        $charp = charge::create([
            'username' => $user->username,
            'payment_ref' => $request->refid,
            'amount' => $request->amount,
            'iwallet' => $wallet->balance,
            'fwallet' => $gt,
        ]);

        $wallet->balance = $gt;
        $wallet->save();

        $admin = 'info@renomobilemoney.com';

        $receiver = encription::decryptdata($user->email);

        Mail::to($receiver)->send(new Emailcharges($charp));
        Mail::to($admin)->send(new Emailcharges($charp));
        $mg=$request->amount . " was charge from " . $request->username . ' wallet successfully';

        return response()->json([
            'status'=>'success',
            'message'=>$mg,
        ]);

    }
    return redirect("admin/login")->with('status', 'You are not allowed to access');

}

}
