<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mcd;
use App\Models\McdServer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InsertController extends Controller
{
    function getmcdproduct($request)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://reseller.mcd.5starcompany.com.ng/api/v1/data/'.$request,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer rocqaIlgQZ7S22pno8kiXwgaGsRANJEHD5ai49nX7CrXBfZVS7vvRfCzYmdzZ2GuqmB6JgrUZBmFjwNXUDF9zEV25tWH7ADv7SjcJuOlWypRxpoy28KQU0U2D3XWjKQybBYjNixsMCBv1GJxQPNMcC'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;

        $data = json_decode($response, true);

//return $success;
        foreach ($data['data'] as $plan){
            $success =$plan["network"];
            $planid = $plan["coded"];
            $price= $plan['price'];
            $allowance=$plan['name'];
            $category =$plan['category'];
            $server=$plan['server'];
            $insert= Mcd::create([
                'plan_id' =>$planid,
                'network' =>$success,
                'plan' =>$allowance,
                'code' =>$planid,
                'amount'=>$price,
                'tamount'=>$price,
                'ramount'=>$price,
                'cat_id'=>$planid,
                'server'=>$server,
                'category'=>$category,
            ]);
        }
    }
    function getmcdproduct1($request)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://reseller.mcd.5starcompany.com.ng/api/v1/tv/'.$request,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer XXRpRiPRkAsrV4Do9hpWbmDJRUVFHBRUyUFmw5IIVceBjnl8VclzX3BJgMD6ZhVNK6PPSgN5xSz6ubYNntBev5xbjFa2JZTiVRvSUiWr7wA9UzgAbUt4IvG5U71kra0YKaWDUFGEKa6NgRn8kUCgN'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;

        $data = json_decode($response, true);

//return $success;
        foreach ($data['data'] as $plan){
            $success =$plan["type"];
            $planid = $plan["coded"];
            $price= $plan['price'];
            $allowance=$plan['name'];
            $category =$plan['type'];
//            $server=$plan['server'];
            $insert= Mcd::create([
                'plan_id' =>$planid,
                'network' =>$success,
                'plan' =>$allowance,
                'code' =>$planid,
                'amount'=>$price,
                'tamount'=>$price,
                'ramount'=>$price,
                'cat_id'=>$planid,
//                'server'=>$server,
                'category'=>$category,
            ]);
        }
    }


    function indexserver()
    {
        $server=McdServer::all();
        return view('admin.serversetting', compact('server'));
    }

    function createserevr(Request $request)
    {
        $create=$request->validate([
            'name'=>'required',
            'code'=>'required'
        ]);

        McdServer::create($create);
        $msg="server create successful";
        return response()->json([
            'status'=>'success',
            'message'=>$msg,
        ]);
    }

    function switchserver($id)
    {
        $serve=McdServer::where('id', $id)->first();

        if ($serve->status == "1") {
            $give = "0";
        } else {
            $give = "1";
        }
        $serve->status = $give;
        $serve->save();
        $msg="server switch";
        Alert::success('Admin', $msg);

        return redirect('admin/switchserver');
    }

}
