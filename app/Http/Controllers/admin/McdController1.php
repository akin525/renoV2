<?php

namespace app\Http\Controllers\admin;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class McdController1
{
    public function index()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/bank",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_test_280c68e08f76233b476038f04d92896b4749eec3",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
//    return $response;
        }
        $data = json_decode($response, true);
        $success = $data["status"];
        return view('admin/mcd', compact('data'));
    }
public function verify(Request $request)
{
    $number=$request['number'];
    $code=$request['bank'];

    $curl = curl_init();


    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=$number&bank_code=$code",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_live_15001f29b396a714841ab44f5547801beb3855c2",
            "Cache-Control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
//    return $response;
    }

    $data = json_decode($response, true);
$tran=$data['data'];
    return view("admin/verify", compact("tran", "request"));


}
    public function mcd(Request $request)
    {
        $request->validate([
            'bank' => 'required',
            'amount' => 'required',
        ]);

        $amount=$request->amount;
        $number=$request->number;
        $bank=$request->bank;
        $name=$request->code;
        $resellerURL='https://integration.mcd.5starcompany.com.ng/api/reseller/';

        $refid=uniqid('RENO',true);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://reseller.mcd.5starcompany.com.ng/api/v1/make-withdrawal',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => 'POST',CURLOPT_POSTFIELDS =>'{
    "amount": "'.$amount.'",
    "account_number": "'.$number.'",
    "bank_code": "'.$name.'",
    "bank": "'.$bank.'",
    "wallet": "Wallet",
    "ref":"'.$refid.'"
}',

            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer AAAA0VPmumc:APA91bFO0BZ1BL5bGsBIFW2JGE3SZzC60y-Hrqg2UgVlgeYfj7_kIawa7W1Vz0LMTVhhyC1uy4dsSGAU2oe87HzR27PInPhLlDlWKOS5buvaejdQl2O2lWe9Ewts09GiRcmJEi3LnkzB',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        //echo $amount;
        $data = json_decode($response, true);
        $success = $data["success"];
        $tran = $data["message"];

        Alert::success('MCD Admin', 'Your request has been proceed');
        return redirect('admin/mcd');
    }
}
