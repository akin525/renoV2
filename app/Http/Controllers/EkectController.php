<?php

namespace app\Http\Controllers;

use App\Console\encription;
use App\Mail\Emailtrans;
use App\Models\bill_payment;
use App\Models\bo;
use App\Models\data;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EkectController
{
    public function listelect()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://integration.mcd.5starcompany.com.ng/api/reseller/list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('service' => 'electricity'),
            CURLOPT_HTTPHEADER => array(
                'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        return $response;

        $data = json_decode($response, true);
        $plan1= $data["data"];
        foreach ($plan1 as $plan){
//            $success =$plan["type"];
            $planid = $plan["code"];
//            $price= $plan['amount'];
            $allowance=$plan['name'];
            $insert= data::create([
                'plan_id' =>$planid,
                'network' =>'elect',
                'plan' =>$allowance,
                'code' =>$planid,
                'amount'=>0,
                'tamount'=>0,
                'ramount'=>0,
                'cat_id'=>$planid,
            ]);
        }
    }
    public function electric(Request $request)
    {
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = data::where('network', 'elect')->get();

            return  view('elect', compact('user', 'tv'));

        }
        return redirect("login")->withSuccess('You are not allowed to access');

    }
    public function verifyelect($value1, $value2)
    {
            $tv = data::where('plan', $value2)->first();


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://reseller.mcd.5starcompany.com.ng/api/v1/validate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
    "service": "electricity",
    "provider": "'.$tv->plan_id.'",
    "number": "'.$value1.'"
}',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer XXRpRiPRkAsrV4Do9hpWbmDJRUVFHBRUyUFmw5IIVceBjnl8VclzX3BJgMD6ZhVNK6PPSgN5xSz6ubYNntBev5xbjFa2JZTiVRvSUiWr7wA9UzgAbUt4IvG5U71kra0YKaWDUFGEKa6NgRn8kUCgNr'

                )
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            echo $response;
            $data = json_decode($response, true);
            $success= $data["success"];
            $name=$data["data"];
            if ($success = 1){
                $log=$name;
            }else{
                $log= "Unable to Identify meter Number";
            }
            return response()->json($log);

    }
    public function payelect(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'amount' => [
                'required',
                'regex:/^[0-9]+$/',
            ],
        ], [
            'amount.regex' => 'Amount must not contain special characters.',
        ]);

        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $tv = data::where('plan', $request->id)->first();

            $wallet = wallet::where('username', $user->username)->first();


            if ($wallet->balance < $request->amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                return response()->json($mg, Response::HTTP_BAD_REQUEST );


            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                return response()->json($mg, Response::HTTP_BAD_REQUEST );


            }
            $bo = bo::where('refid', $request->refid)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction";
                return response()->json($mg, Response::HTTP_BAD_REQUEST );


            } else {
                $gt = $wallet->balance - $request->amount;


                $wallet->balance = $gt;
                $wallet->save();
                $resellerURL = 'https://reseller.mcd.5starcompany.com.ng/api/v1/';


                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $resellerURL.'electricity',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
    "provider": "'.$request->id.'",
    "number": "'.$request->number.'",
    "amount": "'.$request->amount.'",
    "payment" : "wallet",
    "promo" : "0",
    "ref":"'.$request->refid.'"
}',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer XXRpRiPRkAsrV4Do9hpWbmDJRUVFHBRUyUFmw5IIVceBjnl8VclzX3BJgMD6ZhVNK6PPSgN5xSz6ubYNntBev5xbjFa2JZTiVRvSUiWr7wA9UzgAbUt4IvG5U71kra0YKaWDUFGEKa6NgRn8kUCgNr'

                    )
                ));

                $response = curl_exec($curl);

                curl_close($curl);
//                echo $response;
//                return response()->json($response, Response::HTTP_BAD_REQUEST );

                $data = json_decode($response, true);
                $success = $data["success"];
                $tran2 = $data["token"];


//                        return $response;
                if ($success == 1) {
                    try {
                        if (!$user || !$tv) {
                            return response()->json([
                                'status' => 'error',
                                'message' => 'User or Electricity plan not found.',
                            ], 404);
                        }


                        $bo = bill_payment::create([
                            'username' => $user->username,
                            'product' => $tv->plan,
                            'amount' => $request->amount,
                            'server_response' => $response,
                            'status' => $success,
                            'number' => $request->number,
                            'transactionid' => $request->refid,
                            'token' => $tran2,
                            'paymentmethod' => 'wallet',
                        ]);

                        $am = $request->id . " was successful to";
                        $ph = $request->number . " | Token: " . $tran2;

                        // Ensure email can be decrypted and exists
                        $receiver = encription::decryptdata($user->email);
                        if (!$receiver) {
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Unable to decrypt user email.',
                            ], 500);
                        }
                        $admin = 'info@renomobilemoney.com';

                        // Send emails
                        Mail::to($receiver)->send(new Emailtrans($bo));
                        Mail::to($admin)->send(new Emailtrans($bo));

                        return response()->json([
                            'status' => 'success',
                            'message' => $am . ' ' . $ph,
                        ]);

                    } catch (\Exception $e) {
                        // Log the error for debugging
                        Log::error('Error in bill payment process: ' . $e->getMessage());

                        return response()->json([
                            'status' => 'error',
                            'message' => 'An error occurred during the transaction process.',
                        ], 500);
                    }
                } elseif ($success==0){
                    $zo=$user->balance+$tv->tamount;
                    $user->balance = $zo;
                    $user->save();

                    $name= $tv->network;
                    $am= "NGN $request->amount Was Refunded To Your Wallet";
                    $ph=", Transaction fail";

                    return response()->json([
                        'status' => 'fail',
                        'message' => $am.' ' .$ph,
//                            'data' => $responseData // If you want to include additional data
                    ]);
                }
            }
        }
    }

}
