<?php

namespace App\Http\Controllers;

use App\Console\encription;
use App\Mail\Emailtrans;
use App\Models\bill_payment;
use App\Models\bo;
use App\Models\Comission;
use App\Models\data;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AirtimeController
{
    public function listairtimecommission()
    {
        $allcommission=Comission::where('username', Auth::user()->username)->latest()->get();

        return view("commission", compact("allcommission"));
    }

    public function pintransaction(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'number' => 'required',
            'id' => 'required',
        ]);
        $user = User::find($request->user()->id);
        $wallet = wallet::where('username', $user->username)->first();
//        if (Auth::user()->bvn==NULL){
//            Alert::warning('Update', 'Please Kindly Update your profile including your bvn for account two & to continue');
//            return redirect()->intended('myaccount')
//                ->with('info', 'Please Kindly Update your profile including your bvn for account two');
//        }

        if ($wallet->balance < $request->amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

            return response()->json( $request, Response::HTTP_BAD_REQUEST);



        }
        if ($request->amount < 0) {

            $mg = "error transaction";
            return response()->json($mg, Response::HTTP_BAD_REQUEST);



        }


        return view('pin', compact('request'));
    }

    public function pinimport(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $user = User::find($request->user()->id);
        $wallet = wallet::where('username', $user->username)->first();

//        if (Auth::user()->bvn==NULL){
//            Alert::warning('Update', 'Please Kindly Update your profile including your bvn for account two & to continue');
//            return redirect()->intended('myaccount')
//                ->with('info', 'Please Kindly Update your profile including your bvn for account two');
//        }
        if ($wallet->balance < $request->amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

            return response()->json($mg, Response::HTTP_BAD_REQUEST);


        }
        if ($request->amount < 0) {

            $mg = "error transaction";
            return response()->json($mg, Response::HTTP_BAD_REQUEST);


        }
        $bo = bill_payment::where('transactionid', $request->refid)->first();
        if (isset($bo)) {
            $mg = "duplicate transaction";
            return response()->json( $mg, Response::HTTP_CONFLICT);

        } else {

            $user = User::find($request->user()->id);
            $bt = data::where("cat_id", $request->id)->first();
            $wallet = wallet::where('username', $user->username)->first();
            $per=2/100;
            $comission=$per*$request->amount;

            $fbalance=$wallet->balance;

            $gt = $wallet->balance - $request->amount;
            $wallet->balance = $gt;
            $wallet->save();
            if (Auth::user()->pin !="0"){
                $pi=$request->pin;
                $pe=Auth::user()->pin;
                if ($pi != $pe){
                    Alert::error('Ooops', 'incorrect pin');
                    return redirect('airtime');
                }else{


                    $bo = bill_payment::create([
                        'username' => $user->username,
                        'product' => $request->id.'Airtime',
                        'amount' => $request->amount,
                        'server_response' => 0,
                        'status' => 0,
                        'number' => $request->number,
                        'paymentmethod'=>'wallet',
                        'transactionid' => $request->refid,
                        'discountamount' => 0,
                        'fbalance'=>$fbalance,
                        'balance'=>$gt,
                    ]);
                    $comiS=Comission::create([
                        'username'=>Auth::user()->username,
                        'amount'=>$comission,
                    ]);
                    $bo['name']=encription::decryptdata($user->name);
                    $bo['email']=encription::decryptdata(Auth::user()->email);

                    $resellerURL = 'https://integration.mcd.5starcompany.com.ng/api/reseller/';
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL =>'https://reseller.mcd.5starcompany.com.ng/api/v1/airtime',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array( 'provider' => $request->id,
                            'number' => $request->number,
                            'amount' => $request->amount,
                            'country' => 'NG',
                            'payment'=>'wallet',
                            'promo'=>'0',
                            'ref'=>$request->refid,
                            'operatorID'=>0
                            ),

                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Authorization: Bearer XXRpRiPRkAsrV4Do9hpWbmDJRUVFHBRUyUFmw5IIVceBjnl8VclzX3BJgMD6ZhVNK6PPSgN5xSz6ubYNntBev5xbjFa2JZTiVRvSUiWr7wA9UzgAbUt4IvG5U71kra0YKaWDUFGEKa6NgRn8kUCgNr'
                        )));

                    $response = curl_exec($curl);

                    curl_close($curl);
//                    return $response;
                    $data = json_decode($response, true);
                    $success = $data["success"];
//                    $tran1 = $data["discountAmount"];
                    if ($success == 1) {
//                    $bo->server_response=$response;
//                    $bo->status=1;
//                    $bo->save();
                        $update=bill_payment::where('id', $bo->id)->update([
                            'server_response'=>$response,
                            'status'=>1,
                        ]);
                        $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                        $ph = $request->number;

                        $receiver = encription::decryptdata($user->email);
                        $admin = 'info@renomobilemoney.com';


                        Mail::to($receiver)->send(new Emailtrans($bo));
                        Mail::to($admin)->send(new Emailtrans($bo));
                        $username=encription::decryptdata($user->username);
                        $name="Airtime";
                        $body=$username.' purchase '.$name;
                        $this->reproduct($username, "User AirtimePurchase", $body);
                        $this->reproduct1($username, "User AirtimePurchase", $body);
                        $this->reproduct2($username, "User AirtimePurchase", $body);

                        $com=$wallet->balance+$comission;
                        $wallet->balance=$com;
                        $wallet->save();

                        $parise=$comission."₦ Commission Is added to your wallet balance";
                        Alert::success('success', $am.' ' .$ph.' & '.$parise);
//                    $msg=$am.' ' .$ph.' & '.$parise;
//                    Alert::image('Success..',$msg,'https://renomobilemoney.com/nov.jpeg','200','200', 'Image Alt');

                        return redirect()->route('viewpdf', $bo->id);
                    } elseif ($success == 0) {
//                        $zo = $wallet->balance + $request->amount;
//                        $wallet->balance = $zo;
//                        $wallet->save();

//                    $name = $bt->plan;
                        $am = "NGN $request->amount Was Refunded To Your Wallet";
                        $ph = ", Transaction fail";

                        Alert::error('error', $am.' ' .$ph);
                        return redirect()->route('viewpdf', $bo->id);
                    }
                }

            }


        }




    }

    public function airtime(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'amount' => [
                'required',
                'regex:/^[0-9]+$/', // Ensures the amount contains only digits (no special characters)
            ],
        ], [
            'amount.regex' => 'Amount must not contain special characters.',
        ]);


        $user = User::find($request->user()->id);
            $wallet = wallet::where('username', $user->username)->first();

//        if (Auth::user()->bvn==NULL){
//            Alert::warning('Update', 'Please Kindly Update your profile including your bvn for account two & to continue');
//            return redirect()->intended('myaccount')
//                ->with('info', 'Please Kindly Update your profile including your bvn for account two');
//        }
            if ($wallet->balance < $request->amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                return response()->json($mg, Response::HTTP_BAD_REQUEST);

            }
            if ($request->amount < 100) {

                $mg = "enter a valid amount";
                return response()->json($mg, Response::HTTP_BAD_REQUEST);


            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                return response()->json($mg, Response::HTTP_BAD_REQUEST);


            }
            if ($request->amount > 2000) {

                $mg = "You can purchase above 500 airtime once";
                return response()->json($mg, Response::HTTP_BAD_REQUEST);


            }
        $validAmounts = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1500, 2000];

        if (!in_array($request->amount, $validAmounts)) {
            $mg = "Please enter a standard figure e.g., 100, 200, 300, 400, 500";
            return response()->json($mg, Response::HTTP_BAD_REQUEST);
        }
            $bo = bill_payment::where('transactionid', $request->refid)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction kindly reload this page";
                return response()->json( $mg, Response::HTTP_CONFLICT);

            } else {

                $user = User::find($request->user()->id);
                $bt = data::where("cat_id", $request->id)->first();
                $wallet = wallet::where('username', $user->username)->first();
                $per=2/100;
                $comission=$per*$request->amount;
                $fbalance=$wallet->balance;


                $gt = $wallet->balance - $request->amount;

                $wallet->balance = $gt;
                $wallet->save();

                        $bo = bill_payment::create([
                            'username' => $user->username,
                            'product' => $request->id.'Airtime',
                            'amount' => $request->amount,
                            'server_response' => 0,
                            'status' => 0,
                            'number' => $request->number,
                            'paymentmethod'=>'wallet',
                            'transactionid' => $request->refid,
                            'discountamount' => 0,
                            'fbalance'=>$fbalance,
                            'balance'=>$gt,
                        ]);
                        $comiS=Comission::create([
                            'username'=>Auth::user()->username,
                            'amount'=>$comission,
                        ]);
                        $bo['name']=encription::decryptdata($user->name);
                        $bo['email']=encription::decryptdata(Auth::user()->email);

                        $resellerURL = 'https://integration.mcd.5starcompany.com.ng/api/reseller/';
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://reseller.mcd.5starcompany.com.ng/api/v1/airtime',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
    "provider": "'.$request->id.'",
    "amount": "'.$request->amount.'",
    "number": "'.$request->number.'",
    "country" : "NG",
    "payment" : "wallet",
    "promo" : "0",
    "ref":"'.$request->refid.'",
    "operatorID": 0
}',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer XXRpRiPRkAsrV4Do9hpWbmDJRUVFHBRUyUFmw5IIVceBjnl8VclzX3BJgMD6ZhVNK6PPSgN5xSz6ubYNntBev5xbjFa2JZTiVRvSUiWr7wA9UzgAbUt4IvG5U71kra0YKaWDUFGEKa6NgRn8kUCgNr'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                        $data = json_decode($response, true);
//                return response()->json($response, Response::HTTP_BAD_REQUEST);


                        $success = $data["success"];
//                        $tran1 = $data["discountAmount"];
                        if ($success == 1) {
                            $update=bill_payment::where('id', $bo->id)->update([
                                'server_response'=>$response,
                                'status'=>1,
                            ]);
                            $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                            $ph = $request->number;

                            $receiver = encription::decryptdata($user->email);
                            $admin = 'info@renomobilemoney.com';


                            Mail::to($receiver)->send(new Emailtrans($bo));
                            Mail::to($admin)->send(new Emailtrans($bo));
                            $username=encription::decryptdata($user->username);
                            $name="Airtime";
                            $body=$username.' purchase '.$name;
                            $this->reproduct($username, "User AirtimePurchase", $body);
                            $this->reproduct1($username, "User AirtimePurchase", $body);
                            $this->reproduct2($username, "User AirtimePurchase", $body);

                            $com=$wallet->balance+$comission;
                            $wallet->balance=$com;
                            $wallet->save();

                            $parise=$comission."₦ Commission Is added to your wallet balance";

                            return response()->json([
                                'status' => 'success',
                                'message' => $am.' ' .$ph.' & '.$parise,
//                            'data' => $responseData // If you want to include additional data
                            ]);
                        } elseif ($success == 0) {
//
                            $am = "NGN $request->amount Was Refunded To Your Wallet";
                            $ph = ", Transaction fail";

                            return response()->json([
                                'status' => 'fail',
                                'message' => $response,
//                            'message' => $am.' ' .$ph,
//                            'data' => $responseData // If you want to include additional data
                            ]);
                        }
                    }
    }
    public function airtimepin(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'amount' => [
                'required',
                'regex:/^[0-9]+$/', // Ensures the amount contains only digits (no special characters)
            ],
        ], [
            'amount.regex' => 'Amount must not contain special characters.',
        ]);

            $user = User::find($request->user()->id);
            $wallet = wallet::where('username', $user->username)->first();

//        if (Auth::user()->bvn==NULL){
//            Alert::warning('Update', 'Please Kindly Update your profile including your bvn for account two & to continue');
//            return redirect()->intended('myaccount')
//                ->with('info', 'Please Kindly Update your profile including your bvn for account two');
//        }
            if ($wallet->balance < $request->amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                return response()->json($mg, Response::HTTP_BAD_REQUEST);

            }
            if ($request->amount < 100) {

                $mg = "enter a valid amount";
                return response()->json($mg, Response::HTTP_BAD_REQUEST);


            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                return response()->json($mg, Response::HTTP_BAD_REQUEST);


            }
            if ($request->amount > 2000) {

                $mg = "You can purchase above 500 airtime once";
                return response()->json($mg, Response::HTTP_BAD_REQUEST);


            }
        $validAmounts = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1500, 2000];

        if (!in_array($request->amount, $validAmounts)) {
            $mg = "Please enter a standard figure e.g., 100, 200, 300, 400, 500";
            return response()->json($mg, Response::HTTP_BAD_REQUEST);
        }
            $bo = bill_payment::where('transactionid', $request->refid)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction kindly reload this page";
                return response()->json( $mg, Response::HTTP_CONFLICT);

            } else {

                $user = User::find($request->user()->id);
                $bt = data::where("cat_id", $request->id)->first();
                $wallet = wallet::where('username', $user->username)->first();
                $per=2/100;
                $comission=$per*$request->amount;
                $fbalance=$wallet->balance;


                $gt = $wallet->balance - $request->amount;

                $wallet->balance = $gt;
                $wallet->save();

                        $bo = bill_payment::create([
                            'username' => $user->username,
                            'product' => $request->id.'Airtime',
                            'amount' => $request->amount,
                            'server_response' => 0,
                            'status' => 0,
                            'number' => $request->number,
                            'paymentmethod'=>'wallet',
                            'transactionid' => $request->refid,
                            'discountamount' => 0,
                            'fbalance'=>$fbalance,
                            'balance'=>$gt,
                        ]);
                        $comiS=Comission::create([
                            'username'=>Auth::user()->username,
                            'amount'=>$comission,
                        ]);
                        $bo['name']=encription::decryptdata($user->name);
                        $bo['email']=encription::decryptdata(Auth::user()->email);

                        $resellerURL = 'https://integration.mcd.5starcompany.com.ng/api/reseller/';
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://reseller.mcd.5starcompany.com.ng/api/v1/airtime',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
    "provider": "'.$request->id.'",
    "amount": "'.$request->amount.'",
    "number": "'.$request->number.'",
    "country" : "NG",
    "payment" : "wallet",
    "promo" : "0",
    "ref":"'.$request->refid.'",
    "operatorID": 0
}',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer XXRpRiPRkAsrV4Do9hpWbmDJRUVFHBRUyUFmw5IIVceBjnl8VclzX3BJgMD6ZhVNK6PPSgN5xSz6ubYNntBev5xbjFa2JZTiVRvSUiWr7wA9UzgAbUt4IvG5U71kra0YKaWDUFGEKa6NgRn8kUCgNr'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                        $data = json_decode($response, true);
//                return response()->json($response, Response::HTTP_BAD_REQUEST);


                        $success = $data["success"];
//                        $tran1 = $data["discountAmount"];
                        if ($success == 1) {
                            $update=bill_payment::where('id', $bo->id)->update([
                                'server_response'=>$response,
                                'status'=>1,
                            ]);
                            $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                            $ph = $request->number;

                            $receiver = encription::decryptdata($user->email);
                            $admin = 'info@renomobilemoney.com';


                            Mail::to($receiver)->send(new Emailtrans($bo));
                            Mail::to($admin)->send(new Emailtrans($bo));
                            $username=encription::decryptdata($user->username);
                            $name="Airtime";
                            $body=$username.' purchase '.$name;
                            $this->reproduct($username, "User AirtimePurchase", $body);
                            $this->reproduct1($username, "User AirtimePurchase", $body);
                            $this->reproduct2($username, "User AirtimePurchase", $body);

                            $com=$wallet->balance+$comission;
                            $wallet->balance=$com;
                            $wallet->save();

                            $parise=$comission."₦ Commission Is added to your wallet balance";

                            return response()->json([
                                'status' => 'success',
                                'message' => $am.' ' .$ph.' & '.$parise,
//                            'data' => $responseData // If you want to include additional data
                            ]);
                        } elseif ($success == 0) {
//
                            $am = "NGN $request->amount Was Refunded To Your Wallet";
                            $ph = ", Transaction fail";

                            return response()->json([
                                'status' => 'fail',
                                'message' => $response,
//                            'message' => $am.' ' .$ph,
//                            'data' => $responseData // If you want to include additional data
                            ]);
                        }
                    }
    }
    public function honor(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $user = User::find($request->user()->id);
        $wallet = wallet::where('username', $user->username)->first();


        if ($wallet->balance < $request->amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

            Alert::error('error', $mg);
            return redirect('dashboard');


        }
        if ($request->amount < 0) {

            $mg = "error transaction";
            return view('bill', compact('user', 'mg'));

        }
        $bo = bill_payment::where('transactionid', $request->refid)->first();

        if (isset($bo)) {
            $mg = "duplicate transaction";
            return view('bill', compact('user', 'mg'));

        } else {
            $user = User::find($request->user()->id);
            $bt = data::where("id", $request->id)->first();
            $wallet = wallet::where('username', $user->username)->first();


            $gt = $wallet->balance - $request->amount;


            $wallet->balance = $gt;
            $wallet->save();


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.honourworld.com.ng/api/v1/purchase/airtime',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
  "network" : "'.$request->id.'",
  "phone" : "'.$request->number.'",
  "amount" : "'.$request->amount.'"
}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer sk_live_ac82a88e-743f-4937-a516-10222493fed5',
                    'Accept: application/json',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            echo $response;

            $data = json_decode($response, true);
//            $success = $data["message"];
//            $tran1 = $data["discountAmount"];

//                        return $response;
            if ($data['message']== 'SUCCESSFUL') {

                $bo = bill_payment::create([
                    'username' => $user->username,
                    'product' => $request->id.'Airtime',
                    'amount' => $request->amount,
                    'server_response' => $response,
                    'status' => '1',
                    'number' => $request->number,
                    'paymentmethod'=>'wallet',
                    'transactionid' => $request->refid,
                    'discountamount' =>0,
                ]);

                $success=1;
                $name = "Airtime";
                $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                $ph = $request->number;

                $receiver = encription::decryptdata($user->email);
                $admin = 'info@renomobilemoney.com';
                Mail::to($receiver)->send(new Emailtrans($bo));
                Mail::to($admin)->send(new Emailtrans($bo));
                $username=encription::decryptdata($user->username);
                $body=$username.' purchase '.$name;
                $this->reproduct($username, "User DataPurchase", $body);

                Alert::success('success', $am.' ' .$ph);
                return back();
            } elseif ($data['message']== 'Possible duplicate transaction, Please retry after 2 minutes') {
                $zo = $user->balance + $request->amount;
                $user->balance = $zo;
                $user->save();
$success=0;
                $name = 'Airtime';
                $am = "NGN $request->amount Was Refunded To Your Wallet";
                $ph = ", Possible duplicate transaction, Please retry after 2 minutesl";

                return view('bill', compact('user', 'name', 'am', 'ph', 'success'));

            } elseif ($data['message']== 'Failed') {
                $zo = $user->balance + $request->amount;
                $user->balance = $zo;
                $user->save();
                $success=0;
                $name = 'Airtime';
                $am = "NGN $request->amount Was Refunded To Your Wallet";
                $ph = ", Transaction fail";

                Alert::error('error', $am.' ' .$ph);
                return back();
            }
        }

        }
    public  function reproduct($username, $title, $body)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "to": "/topics/Adeolu23",
    "notification": {
        "body": "'.$body.'",
        "title": "'.$title.'"
                "image": "https://renomobilemoney.com/renon.png"

    }
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer AAAA0VPmumc:APA91bFO0BZ1BL5bGsBIFW2JGE3SZzC60y-Hrqg2UgVlgeYfj7_kIawa7W1Vz0LMTVhhyC1uy4dsSGAU2oe87HzR27PInPhLlDlWKOS5buvaejdQl2O2lWe9Ewts09GiRcmJEi3LnkzB',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        dd($response);
//        echo $response;
    }
    public  function reproduct1($username, $title, $body)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "to": "/topics/Izormor2019",
    "notification": {
        "body": "'.$body.'",
        "title": "'.$title.'"
                "image": "https://renomobilemoney.com/renon.png"

    }
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer AAAA0VPmumc:APA91bFO0BZ1BL5bGsBIFW2JGE3SZzC60y-Hrqg2UgVlgeYfj7_kIawa7W1Vz0LMTVhhyC1uy4dsSGAU2oe87HzR27PInPhLlDlWKOS5buvaejdQl2O2lWe9Ewts09GiRcmJEi3LnkzB',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        dd($response);
//        echo $response;
    }
    public  function reproduct2($username, $title, $body)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "to": "/topics/'.$username.'",
    "notification": {
        "body": "'.$body.'",
        "title": "'.$title.'"
                "image": "https://renomobilemoney.com/renon.png"

    }
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer AAAA0VPmumc:APA91bFO0BZ1BL5bGsBIFW2JGE3SZzC60y-Hrqg2UgVlgeYfj7_kIawa7W1Vz0LMTVhhyC1uy4dsSGAU2oe87HzR27PInPhLlDlWKOS5buvaejdQl2O2lWe9Ewts09GiRcmJEi3LnkzB',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        dd($response);
//        echo $response;
    }


}
