<?php

namespace App\Actions\Fortify;

use App\Console\encription;
use App\Mail\Emailotp;
use App\Models\User;
use App\Models\wallet;
use http\Exception\BadConversionException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use RealRashid\SweetAlert\Facades\Alert;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:500', 'unique:users'],
            'username' => ['required', 'string',  'min:6', 'unique:users'],
            'phone' => ['required', 'numeric',  'min:11'],
            'address' => ['required', 'string',  'min:11'],
            'gender' => ['required', 'string'],
            'dob' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $getall=User::where('username', $input['username'])->first();

        $username=$input['username'].rand(111, 999);
//
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://reseller.mcd.5starcompany.com.ng/api/v1/virtual-account',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_SSL_VERIFYHOST => 0,
//            CURLOPT_SSL_VERIFYPEER => 0,
//            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS =>'{
//    "account_name": "'.$input['name'].'",
//    "business_short_name": "RENO",
//    "uniqueid": "'.$username.'",
//    "email" : "'.$input['email'].'",
//    "phone" : "'.$input['phone'].'",
//    "webhook_url" : "https://renomobilemoney.com/api/run"
//}',
//            CURLOPT_HTTPHEADER => array(
//                'Content-Type: application/json',
//                'Authorization: Bearer XXRpRiPRkAsrV4Do9hpWbmDJRUVFHBRUyUFmw5IIVceBjnl8VclzX3BJgMD6ZhVNK6PPSgN5xSz6ubYNntBev5xbjFa2JZTiVRvSUiWr7wA9UzgAbUt4IvG5U71kra0YKaWDUFGEKa6NgRn8kUCgNr'
//            ),
//        ));
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);
//
//        $data = json_decode($response, true);
//        if ($data['success']==1){
//            $account = $data["data"]["account_name"];
//            $number = $data["data"]["account_number"];
//            $bank = $data["data"]["bank_name"];
//            $wallet= wallet::create([
//                'username' => encription::encryptdata($input['username']),
//                'balance' => 0,
//                'account_number'=>$number,
//                'account_name'=>$account,
//                'bank'=>$bank,
//            ]);
//
//
//        }elseif ($data['success']==0){
//            $wallet= wallet::create([
//                'username' => encription::encryptdata($input['username']),
//                'balance' => 0,
//            ]);
//
//        }
//
//        $receiver=$input ['email'];
//        $admin= 'info@renomobilemoney.com';
//        Mail::to($receiver)->send(new Emailotp($input));
//        Mail::to($admin)->send(new Emailotp($input));
//
//        return User::create([
//            'name' => encription::encryptdata($input['name']),
//            'email' => encription::encryptdata($input['email']),
//            'password' => $input['password'],
//            'address' => $input['address'],
//            'dob' => $input['dob'],
//            'gender' => $input['gender'],
//            'phone'=>encription::encryptdata($input['phone']),
//            'username'=>encription::encryptdata($input['username']),
//        ]);
    }
}
