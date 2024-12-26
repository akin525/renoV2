<?php

namespace App\Http\Controllers;
use App\Mail\Emailotp;
use Illuminate\Support\Facades\Session;
use App\Actions\Fortify\PasswordValidationRules;
use App\Charts\UserChart;
use App\Console\encription;
use App\Mail\login;
use App\Mail\VerifyEmail;
use App\Models\Advert;
use App\Models\airtimecon;
use App\Models\big;
use App\Models\bill_payment;
use App\Models\charge;
use App\Models\charp;
use App\Mail\Emailpass;
use App\Models\easy;
use App\Models\Giveaway;
use App\Models\Mcd;
use App\Models\McdServer;
use App\Models\Messages;
use App\Models\refer;
use App\Models\safe_lock;
use App\Models\server;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\wallet;
use App\Models\bo;
use App\Models\data;
use App\Models\deposit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Laravel\Jetstream\Jetstream;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use mysql_xdevapi\Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class AuthController
{
    use PasswordValidationRules;

    public function landing()
    {
        $mtn=data::where('network', 'mtn-data')->limit(7)->get();
        $glo=data::where('network', 'glo-data')->limit(7)->get();
        $eti=data::where('network', 'etisalat-data')->limit(7)->get();
        $airtel=data::where('network', 'airtel-data')->limit(7)->get();
        $ads=Advert::where('status', 1)->latest()->limit(3)->get();
        $me = Messages::where('status', 1)->first();
//        Alert::image('Latest News', $me->message,'https://renomobilemoney.com/renon.png','200','200', 'Image Alt');

//Alert::info('Renomobilemoney', 'Data Refill | Airtime | Cable TV | Electricity Subscription');
        return view("home", compact("mtn", "glo", "eti", "airtel", "ads"));
    }
  public function pass(Request $request)
{
    $request->validate([
        'email' => 'required',
    ]);

    $user = User::where('email', encription::encryptdata($request->email))->first();

    if (!isset($user)){
        Alert::error('Error', 'Email not found in our system');
        return back();

    }elseif ($user->email ==  encription::encryptdata($request->email)){
        $new['pass']= uniqid('Pass',true);

        $user->password=$new['pass'];
        $user->save();

        $admin= 'info@renomobilemoney.com';
$new['user']=encription::decryptdata($user->username);

        $receiver= $request->email;
        Mail::to($receiver)->send(new Emailpass($new));
        Mail::to($admin)->send(new Emailpass($new ));
Alert::success('Success', 'New Password has been sent to your email');
        return back();
    }
}

    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Retrieve user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        // Generate a new OTP code
        $code = random_int(100000, 999999);

        // Save the code in the session or cache
        Session::put('2fa_code', $code);
        Cache::put('2fa_code_' . $user->id, $code, now()->addMinutes(10));

        // Send the new OTP code via email
        Mail::to($user->email)->send(new TwoFactorCode($code));

        return back()->with('message', 'A new verification code has been sent to your email.');
    }

    public function cus(Request $request)
    {
        if (Auth()->user()) {
            return redirect(route('dashboard'))
                ->withSuccess('Signed in');

        }else{
            return redirect(route('log'));
        }
    }

    public function register(Request $request)

    {
        $request->validate([
            'name' => ['required', 'string', 'max:500', 'unique:users'],
            'username' => ['required', 'string',  'min:6', 'unique:users'],
            'phone' => ['required', 'numeric',  'min:11'],
            'address' => ['required', 'string',  'min:11'],
            'gender' => ['required', 'string'],
            'dob' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        $find=User::where('username', encription::encryptdata($request->username))->first();
        if ($find){
            return back()->withErrors(['token' => 'username Already taken']);
        }

        $find=User::where('email', encription::encryptdata($request->email))->first();
        if ($find){
            return back()->withErrors(['token' => 'email Already taken']);
        }
        $find=User::where('name', encription::encryptdata($request->name))->first();
        if ($find){
            return back()->withErrors(['token' => 'name Already in use']);
        }

        $token = random_int(100000, 999999);

        Session::put('signup_data', [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'password' => $request->password,
        ]);
        Session::put('verification_token', $token);


        Mail::to($request->email)->send(new VerifyEmail($token));
        Mail::to("akinlabisamson15@gmail.com")->send(new VerifyEmail($token));

        return redirect()->route('signup.verify')->with('message', 'A verification code has been sent to your email.');
    }
    public function showSignupForm()
    {
        return view('auth.register');
    }
    public function showVerificationForm()
    {
        return view('auth.verify');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'token' => 'required|numeric',
        ]);

        // Check if the token matches
        if ($request->token != Session::get('verification_token')) {
            return back()->withErrors(['token' => 'The verification code is incorrect.']);
        }

        $signupData = Session::get('signup_data');

        $username=$signupData['username'].rand(111, 999);
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://reseller.mcd.5starcompany.com.ng/api/v1/virtual-account',
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
    "account_name": "' . $signupData['name'] . '",
    "business_short_name": "RENO",
    "uniqueid": "' . $username . '",
    "email" : "' . $signupData['email'] . '",
    "phone" : "' . $signupData['phone'] . '",
    "webhook_url" : "https://renomobilemoney.com/api/run"
}',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer XXRpRiPRkAsrV4Do9hpWbmDJRUVFHBRUyUFmw5IIVceBjnl8VclzX3BJgMD6ZhVNK6PPSgN5xSz6ubYNntBev5xbjFa2JZTiVRvSUiWr7wA9UzgAbUt4IvG5U71kra0YKaWDUFGEKa6NgRn8kUCgNr'
                ),
            ));

            $response = curl_exec($curl);

            if ($response === false) {
                Log::error('cURL error: ' . curl_error($curl));
                return response()->json(['error' => 'Unable to create virtual account'], 500);
            }
            curl_close($curl);

            $data = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('JSON decode error: ' . json_last_error_msg());
                return response()->json(['error' => 'Invalid response from server'], 500);
            }
            if ($data['success'] == 1) {
                $account = $data["data"]["account_name"];
                $number = $data["data"]["account_number"];
                $bank = $data["data"]["bank_name"];
                $wallet = wallet::create([
                    'username' => encription::encryptdata($signupData['username']),
                    'balance' => 0,
                    'account_number' => $number,
                    'account_name' => $account,
                    'bank' => $bank,
                ]);


            } elseif ($data['success'] == 0) {
                $wallet = wallet::create([
                    'username' => encription::encryptdata($signupData['username']),
                    'balance' => 0,
                ]);

            }

            $user = User::create([
                'name' => encription::encryptdata($signupData['name']),
                'email' => encription::encryptdata($signupData['email']),
                'password' => $signupData['password'],
                'address' => $signupData['address'],
                'dob' => $signupData['dob'],
                'gender' => $signupData['gender'],
                'phone' => encription::encryptdata($signupData['phone']),
                'username' => encription::encryptdata($signupData['username']),
                'is_two_factor_verified' => true,
            ]);

            $receiver = $signupData ['email'];
            $admin = 'info@renomobilemoney.com';
            $input = $signupData;
            Mail::to($receiver)->send(new Emailotp($input));
            Mail::to($admin)->send(new Emailotp($input));
            Session::forget(['signup_data', 'verification_token']);
            session()->put('email_verified', true);

        }catch (\Exception $e) {
            // Log and return error message if any exception occurs
            Log::error('Error in user creation: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred during user creation'], 500);
        }
        $user2 = User::where('username', $user->username)
            ->first();
        Auth::login($user2);

        return redirect()->route('dashboard')->with('message', 'Signup complete! Welcome, ' . $user->name);
    }
    public function customLogin(Request $request)
    {


        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);



        $user = User::where('username', encription::encryptdata($request->username))
            ->where('password', $request->password)
            ->first();
        if (Auth::user()){
            Alert::success('Dashboard', 'Login Successfully');
            return redirect()->intended('dashboard')
                ->with('success', 'Welcome back '.encription::decryptdata($user->name));
        }
        if(!isset($user)){
            Alert::error('Credentials does not match', 'Kindly check your password & username');
            return back();
        }else {

            Auth::login($user);
//            $admin = 'info@renomobilemoney.com';
            $user = User::where('username', encription::encryptdata($request->username))->first();
            $login = encription::decryptdata($user->name);
            $receiver = encription::decryptdata($user->email);
            try {
                Mail::to($receiver)->send(new login($login));
            }catch (Exception $ex){

            }
//            Mail::to($admin)->send(new login($login));
            // forever
//            cookie()->queue(cookie()->forever("username", $request->username));
            if (Auth::user()->address==NULL){
                Alert::warning('Update', 'Please Kindly Update your profile for account two & to continue');
                return redirect()->intended('myaccount')
                    ->with('info', 'Please Kindly Update your profile including your bvn for account two');
            }else{
            Alert::success('Dashboard', 'Login Successfully');
            return redirect()->intended('dashboard')
                ->with('success', 'Welcome back '.encription::decryptdata($user->name));
        }
        }



    }
    public function dashboard(Request $request)
    {

            $user = User::where('username', Auth::user()->username)->first();
        $username=$user->username;

        $me = Messages::where('status', 1)->first();
            $refer = refer::where('username', $user->username)->get();
            $totalrefer = 0;
            foreach ($refer as $de){
                $totalrefer += $de->amount;

            }
        // forever

        cookie()->queue(cookie()->forever("username", encription::decryptdata( $user->username)));
            $count = refer::where('username',$user->username)->count();

            $wallet = wallet::where('username', $user->username)->get();
            $wallet1 = wallet::where('username', $user->username)->first();
            $pam = deposit::where('username', $user->username)->latest()->limit(1)->get();
            $pam1 = deposit::where('username', $user->username)->latest()->limit(10)->get();
            $deposite = deposit::where('username', $user->username)->get();
            $totaldeposite = 0;
            foreach ($deposite as $depo){
                $totaldeposite += $depo->amount;

            }
            $bil2 = bill_payment::where('username', $user->username)->get();
            $bill = 0;
            foreach ($bil2 as $bill1){
                $bill += $bill1->amount;

            }

        $time = date("H");
        $timezone = date("e");
        if ($time < "12") {
            $greet="Good morning ☀️";
        } else
            if ($time >= "12" && $time < "17") {
                $greet="Good afternoon 🌞";
            } else
                if ($time >= "17" && $time < "19") {
                    $greet="Good evening 🌙";
                } else
                    if ($time >= "19") {
                        $greet="Good night 🌚";
                    }
            $lock=safe_lock::where('username',$user->username)
                ->where('status', '1')->sum('balance');

        $give=Giveaway::where('status', 1)->get();
        $giveaway=Giveaway::where('status', 1)->count();
        if ($giveaway>0){
            Alert::image('Giveaway Time!!','Check Our Giveaway Page',
                'data:image/png;base64,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',
                '200','200', 'Image Alt');

        }else{
//            Alert::image('Latest News!!',$me->message,'https://renomobilemoney.com/renon.png','200','200', 'Image Alt');
        }
        $cdeposite=deposit::where('username', Auth::user()->username)->count();
        $cbill=bill_payment::where('username', Auth::user()->username)->count();
        $cgive=Giveaway::where('username', Auth::user()->username)->count();

        $all=$cdeposite+$cbill+$cgive;

        $ads=Advert::where('status', 1)->inRandomOrder()->orderBy('id', 'desc')->first();

        $price=data::where('plan', 'MTN 1gb - SME-30 days')->first();

        return  view('dashboard', compact('username', 'price',
                'give', 'all', 'cbill', 'cgive', "user", 'greet',
                'pam1', 'wallet','wallet1', 'totaldeposite', 'me', 'cdeposite',
                'bil2', 'bill', 'ads', 'totalrefer',  'pam', 'count', 'lock'))
                ->with('success', 'Welcome back '.encription::decryptdata($user->name));

    }
    public function refer(Request $request)
    {

            $user = User::find($request->user()->id);
            $username=encription::decryptdata($user->username);
            $refer = refer::where('username', $user->username)->first();
        $ads=Advert::where('status', 1)->inRandomOrder()->orderBy('id', 'desc')->first();

            $refers = refer::where('username', $user->username)->get();
            $totalrefer = 0;
            foreach ($refers as $depo){
                $totalrefer+= $depo->amount;

            }
//            return $username;

            return  view('referal', compact('username', 'ads', 'refers', 'refer', 'totalrefer'));

    }
    public function select(Request  $request)
    {
        $serve = server::where('status', '1')->first();
//        if (Auth::user()->bvn==NULL){
//            Alert::warning('Update', 'Please Kindly Update your profile including your bvn for account two & to continue');
//            return redirect()->intended('myaccount')
//                ->with('info', 'Please Kindly Update your profile including your bvn for account two');
//        }
        if (isset($serve)) {
            $user = User::find($request->user()->id);

            $ads=Advert::where('status', 1)->inRandomOrder()->orderBy('id', 'desc')->first();

            return view('select', compact('user', 'serve', 'ads'));
        } else {
            Alert::info('Server', 'Out of service, come back later');
            return redirect('dashboard');
        }
    }
    public function select1(Request  $request)
    {
        $serve = server::where('status', '1')->first();
//        if (Auth::user()->bvn==NULL){
//            Alert::warning('Update', 'Please Kindly Update your profile including your bvn for account two & to continue');
//            return redirect()->intended('myaccount')
//                ->with('info', 'Please Kindly Update your profile including your bvn for account two');
//        }
        if (isset($serve)) {
            $user = User::find($request->user()->id);
            $ads=Advert::where('status', 1)->inRandomOrder()->orderBy('id', 'desc')->first();


            return view('select1', compact('user', 'serve', 'ads'));
        }else {
            Alert::info('Server', 'Out of service, come back later');
            return redirect('dashboard');
        }
    }
    public function buydata(Request  $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $serve = server::where('status', '1')->first();

        if ($serve->name == 'mcd') {
            $user = User::find($request->user()->id);
            $data = data::where(['status' => 1])->where('network', $request->id)->get();


            return view('buydata', compact('user', 'data'));
        } elseif ($serve->name == 'honorworld') {
            $user = User::find($request->user()->id);
            $data= big::where('status', '1')->where('network', $request->id)->get();
//return $data;
            return view('buydata', compact('user', 'data'));

        }elseif ($serve->name == 'easyaccess') {
            $user = User::find($request->user()->id);
            $data= easy::where('status', '1')->where('network', $request->id)->get();
//return $data;
            return view('buydata', compact('user', 'data'));

        }
       }
    public function redata(Request  $request, $selectedValue, $category)
    {
//        return response()->json($selectedValue);

        $daterserver = new DataserverController();
        $serve = server::where('status', '1')->first();
//return $request->id;
        if ($serve->name == 'mcd') {
            $user = User::find($request->user()->id);
            $serve=McdServer::where('status', 1)->first();
//            return response()->json($serve);
            $data=Mcd::where('server', $serve->code)
                ->where('status', 1)
                ->where('network', $category)
                ->where('category', $selectedValue)->get();
//            $data = data::where(['status' => 1])->where('network', $selectedValue)->get();

            return response()->json($data);

        } elseif ($serve->name == 'honorworld') {
            $user = User::find($request->user()->id);
            $data= big::where('status', '1')->where('network',$selectedValue)->get();
//return $data;
            return response()->json($data);

        }elseif ($serve->name == 'easyaccess') {
            $user = User::find($request->user()->id);
            $data= easy::where('status', '1')->where('network', $selectedValue)->get();
//return $data;
            return response()->json($data);

        }
       }
    public function pre(Request $request)


    {
        $request->validate([
            'id' => 'required',
        ]);
        if(Auth::check()){
            $user = User::find($request->user()->id);
            $data = data::where('id',$request->id )->get();

            return view('pre', compact('user', 'data'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function airtime(Request  $request)
    {
        $con=DB::table('airtimecons')->where('status', '=', '1')->first();
        if (isset($con)) {
            $se = $con->server;
        }else{
            $se=0;
        }
        if ($se == 'MCD') {
            $user = User::find($request->user()->id);
            $data = data::where('plan_id', "airtime")->get();
//            $wallet = wallet::where('username', $user->username)->first();
            $ads=Advert::where('status', 1)->inRandomOrder()->orderBy('id', 'desc')->first();

            return view('airtime', compact('user', 'data', 'ads'));
        } elseif ($se == 'Honor'){
            return view('airtime1');

        }else {
            Alert::info('Server', 'Out of service, come back later');
            return redirect('dashboard');
        }
    }
    public function airtimepin(Request  $request)
    {


            $user = User::find($request->user()->id);
            $data = data::where('plan_id', "airtime")->get();
//            $wallet = wallet::where('username', $user->username)->first();
            $ads=Advert::where('status', 1)->inRandomOrder()->orderBy('id', 'desc')->first();

            return view('airtimepin', compact('user', 'data', 'ads'));

    }

    public function invoice(Request  $request)
    {
        if(Auth::check()){
            $user = User::find($request->user()->id);
            $bill = bill_payment::where('username', $user->username)->get();


            return view('invoice', compact('user', 'bill'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function charges(Request  $request)
    {
        if(Auth::check()){
            $user = User::find($request->user()->id);
            $bill = charge::where('username', $request->user()->username)->get();


            return view('charges', compact('user', 'bill'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    function deleteaccount(Request $request)
    {
        $request->validate([
            'username'=>'required',
        ]);
        $username=encription::encryptdata($request->username);
        $find=User::where('username', $username)->first();
        if (!$find){
            return response()->json([
                'status'=>'fail',
                'message'=>'User not found',
            ]);
        }

        $waller=wallet::where('username', $username)->delete();
        $find->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'User delete successfully',
        ]);
    }
}
