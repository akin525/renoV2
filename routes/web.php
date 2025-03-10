<?php

use App\Http\Controllers\admin\AdminpdfController;
use App\Http\Controllers\admin\bonusController;
use App\Http\Controllers\admin\CandCController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\Easy;
use App\Http\Controllers\admin\HonorApi;
use App\Http\Controllers\admin\InsertController;
use App\Http\Controllers\admin\LockController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\QueryController;
use App\Http\Controllers\admin\RateController;
use App\Http\Controllers\admin\SafelocksController;
use App\Http\Controllers\admin\SetController;
use App\Http\Controllers\admin\TransactionController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\UserStatementController;
use App\Http\Controllers\admin\VertualAController;
use App\Http\Controllers\admin\WithadController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\AirtimeController;
use App\Http\Controllers\AlltvController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EkectController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\GiveawaController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\listdata;
use App\Http\Controllers\McdController;
use App\Http\Controllers\admin\McdController1;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RefersController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SafelockController;
use App\Http\Controllers\Transaction1Controller;
use App\Http\Controllers\TransController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\verify;
use App\Http\Controllers\VertualController;
use App\Http\Controllers\WithdrawController;
use App\Http\PinController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('createemail', [AlltvController::class, 'createemail'])->name('createemail');
Route::post('log', [AuthController::class, 'customLogin'])->name('log');
Route::get('/', [AuthController::class, 'landing'])->name('home');
Route::post('passw', [AuthController::class, 'pass'])->name('passw');

Route::view('delete', 'auth.delete');
Route::post('dele', [AuthController::class, 'deleteaccount'])->name('dele');
Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});

Route::get('2fa', [App\Http\Controllers\TwoFactorController::class, 'show'])->name('2fa');
Route::post('2fa', [App\Http\Controllers\TwoFactorController::class, 'verify']);


Route::get('signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('signup', [AuthController::class, 'register'])->middleware('prevent.bot.registration');

Route::get('signup/verify', [AuthController::class, 'showVerificationForm'])->name('signup.verify');
Route::post('signup/verify', [AuthController::class, 'verifyEmail']);

Route::get('admin', function () {

    return view('admin.login');

});

Route::post('cuslog', [LoginController::class, 'login'])->name('cuslog');


Route::group(['middleware' => ['auth', 'two.factor']], function () {
    Route::view('picktv', 'picktv');
    Route::view('fund1', 'fund1');
    Route::view('safelock', 'safelock');
    Route::view('vtu', 'vtu');
    Route::post('wac', [EducationController::class, 'waec'])->name('wac');
    Route::get('waec', [EducationController::class, 'indexw'])->name('waec');
    Route::post('nec', [EducationController::class, 'neco'])->name('nec');
    Route::get('commission', [AirtimeController::class, 'listairtimecommission'])->name('commission');
    Route::post('pin', [AirtimeController::class, 'pintransaction'])->name('pin');
    Route::post('pin1', [BillController::class, 'pintransaction1'])->name('pin1');
    Route::post('datap', [BillController::class, 'billpin'])->name('datap');
    Route::get('neco', [EducationController::class, 'indexn'])->name('neco');
    Route::post('pick', [AlltvController::class, 'tv'])->name('pick');
    Route::get('verifytv/{value1}/{value2}', [AlltvController::class, 'verifytv'])->name('verifytv');
    Route::get('getOptions/{selectedValue}', [AlltvController::class, 'netwplanrequest'])->name('getOptions');

    Route::get('addlock/{id}', [SafelockController::class, 'add'])->name('addlock');
    Route::post('adlock', [SafelockController::class, 'adlock'])->name('adlock');
    Route::post('safe', [SafelockController::class, 'safe'])->name('safe');
    Route::get('allock', [SafelockController::class, 'index'])->name('allock');
    Route::get('tv', [AlltvController::class, 'tv'])->name('tv');
    Route::get('select', [AuthController::class, 'select'])->name('select');
    Route::get('select1', [AuthController::class, 'select1'])->name('select1');
    Route::post('tvp', [AlltvController::class, 'paytv'])->name('tvp');
    Route::get('paytv', [AlltvController::class, 'paytv'])->name('paytv');
//    Route::post('verifytv', [AlltvController::class, 'verifytv'])->name('verifytv');
    Route::get('listdata', [listdata::class, 'list'])->name('listdata');
    Route::get('listtv', [AlltvController::class, 'listtv'])->name('listv');
    Route::get('listelect', [EkectController::class, 'listelect'])->name('listelect');
    Route::get('elect', [EkectController::class, 'electric'])->name('elect');
    Route::get('velect/{value1}/{value2}', [EkectController::class, 'verifyelect'])->name('velect');
    Route::post('payelect', [EkectController::class, 'payelect'])->name('payelect');
    Route::get('invoice', [AuthController::class, 'invoice'])->name('invoice');
    Route::get('charges', [AuthController::class, 'charges'])->name('charges');
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('referal', [AuthController::class, 'refer'])->name('referal');
    Route::post('mp', [ResellerController::class, 'reseller'])->name('mp');
    Route::get('reseller', [ResellerController::class, 'sell'])->name('reseller');
    Route::get('upgrade', [ResellerController::class, 'apiaccess'])->name('upgrade');
    Route::post('buyairtime', [AirtimeController::class, 'airtime'])->name('buyairtime');
    Route::post('airtimep', [AirtimeController::class, 'pinimport'])->name('airtimep');
    Route::post('buyairtime1', [AirtimeController::class, 'honor'])->name('buyairtime1');
    Route::get('airtime1', [AuthController::class, 'airtime'])->name('airtime1');
    Route::get('airtime', [AuthController::class, 'airtime'])->name('airtime');
    Route::get('airtimepin', [AuthController::class, 'airtimepin'])->name('airtimepin');
    Route::get('buydata/{selectedValue}', [AuthController::class, 'buydata'])->name('buydata');
    Route::get('redata/{selectedValue}/{category}', [AuthController::class, 'redata'])->name('redata');
    Route::post('pre', [AuthController::class, 'pre'])->name('pre');
    Route::post('bill', [BillController::class, 'bill'])->name('bill');
    Route::get('referwith', [RefersController::class, 'index'])->name('referwith');
    Route::post('referwith1', [RefersController::class, 'with'])->name('referwith1');
    Route::get('fund', [FundController::class, 'fund'])->name('fund');
    Route::get('tran/{reference}', [FundController::class, 'tran'])->name('tran');
    Route::get('vertual', [VertualController::class, 'vertual'])->name('vertual');
    Route::get('createpin', [PinController::class, 'createpin'])->name('createpin');
    Route::post('cepin', [PinController::class, 'pinsave'])->name('cepin');


    Route::get('viewpdf/{id}', [PdfController::class, 'viewpdf'])->name('viewpdf');
    Route::get('/dopdf/{id}', [PdfController::class, 'dopdf'])->name('dopdf');

//withdraw request
    Route::get('withdraw', [WithdrawController::class, 'bank'])->name('withdraw');
    Route::post('verify', [WithdrawController::class, 'verify'])->name('verify');
    Route::post('sub', [WithdrawController::class, 'sub'])->name('sub');
//profile route
    Route::post('pic', [UserController::class, 'updateprofilephoto'])->name('pic');
    Route::post('update', [UserController::class, 'updateuserdecry'])->name('update');
    Route::get('myaccount', [UserController::class, 'viewuserencry'])->name('myaccount');
    Route::get('deletepic', [UserController::class, 'removephoto'])->name('deletepic');

//giveaway route
    Route::get('giveaway', [GiveawaController::class, 'giveaway'])->name('giveaway');
    Route::get('airtimegiveaway', [GiveawaController::class, 'giveawayair'])->name('airtimegiveaway');
    Route::post('away', [GiveawaController::class, 'creategiveawaydata'])->name('away');
    Route::post('airaway', [GiveawaController::class, 'creategiveawayairtime'])->name('airaway');
    Route::get('bonus', [GiveawaController::class, 'bonus'])->name('bonus');
    Route::get('claim', [GiveawaController::class, 'claimgiveaway'])->name('claim');
    Route::post('claimn', [GiveawaController::class, 'claimgive'])->name('claimn');
    Route::get('claimnow/{id}', [GiveawaController::class, 'claimnow'])->name('claimnow');
//validate transaction
    Route::view('verifybill', 'check');
    Route::view('verifydeposit', 'check1');
    Route::post('check', [verify::class, 'verifypurchase'])->name('check');
    Route::post('check1', [verify::class, 'verifydeposit'])->name('check1');


    Route::get('datapin', [\App\Http\Controllers\DataPinController::class, 'dataindex'])->name('datapin');
    Route::post('datapan', [\App\Http\Controllers\DataPinController::class, 'processdatapin'])->name('datapan');
    Route::get('/transaction', [Transaction1Controller::class, 'getTransactions']);
    Route::get('/transactions', [TransactionController::class, 'getTransactions']);
    Route::get('/transactions1', [TransactionController::class, 'getTransactions1']);
    Route::get('/transaction1', [Transaction1Controller::class, 'getTransactions1']);

    Route::get('checkusers', [TransactionController::class, 'showPieChart']);
    Route::get('checklock', [TransactionController::class, 'lockPieChart']);

//    advertisement
    Route::get('advertisement', [AdvertController::class, 'myads'])->name('advertisement');


    Route::get('plan', [AdvertController::class, 'Plan'])->name('plan');
    Route::get('myads', [AdvertController::class, 'myadsload'])->name('myads');
    Route::get('details/{id}', [AdvertController::class, 'adsdetails'])->name('details');

    Route::get('choosep/{id}', [AdvertController::class, 'planchoose'])->name('choosep');
    Route::group(['middleware' => 'choose.plan'], function () {
        // Your protected routes go here
        Route::get('advert', [TransController::class, 'alladvert'])->name('advert');
        Route::get('upgrade', [AdvertController::class, 'upgrade'])->name('upgrade');
        Route::get('listupgrade', [AdvertController::class, 'listupgrade'])->name('listupgrade');
        Route::get('verifyads/{id}', [AdvertController::class, 'verifyads'])->name('verifyads');

        Route::post('padvert', [AdvertController::class, 'advert'])->name('padvert');

    });

    Route::get('withdrawapi', [WithdrawController::class, 'withdrawapi'])->name('withdrawapi');
    Route::post('rbonus', [WithdrawController::class, 'confirmto'])->name('rbonus');

});

Route::middleware(['auth'])->group(function () {

    Route::post('admin/changelock', [SafelocksController::class, 'editsafelock'])->name('admin/changelock');
    Route::post('admin/doplan', [\App\Http\Controllers\admin\AdminAdsController::class, 'editplan'])->name('admin/doplan');
    Route::get('admin/plan', [\App\Http\Controllers\admin\AdminAdsController::class, 'ediitadsplan'])->name('admin/plan');
    Route::get('admin/planss/{id}', [\App\Http\Controllers\admin\AdminAdsController::class, 'onoffplan'])->name('admin/planss');

    Route::get('admin/statement1', [UserStatementController::class, 'loadindex1'])->name('admin/statement1');
    Route::get('admin/statement', [UserStatementController::class, 'loadindex'])->name('admin/statement');
    Route::post('admin/state1', [UserStatementController::class, 'customerstatementpurchase'])->name('admin/state1');
    Route::post('admin/state', [UserStatementController::class, 'customerstatementfunding'])->name('admin/state');
    Route::get('admin/extract', [UserStatementController::class, 'loadmailcsv'])->name('admin/extract');
    Route::post('admin/sub', [McdController1::class, 'mcd'])->name('admin/sub');
    Route::post('admin/verify', [McdController1::class, 'verify'])->name('admin/verify');
    Route::get('admin/mcd', [McdController1::class, 'index'])->name('admin/mcd');
    Route::get('admin/allock', [LockController::class, 'index'])->name('admin/allock');
    Route::get('admin/com', [LockController::class, 'wi'])->name('admin/com');
    Route::get('admin/interest', [LockController::class, 'lit'])->name('admin/interest');
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin/dashboard');
    Route::get('admin/mcdtransaction', [DashboardController::class, 'mcdtran'])->name('admin/mcdtransaction');
    Route::get('admin/refer', [DashboardController::class, 'ref'])->name('admin/refer');
    Route::get('admin/setmin', [SetController::class, 'index1'])->name('admin/setmin');
    Route::post('admin/min', [SetController::class, 'min'])->name('admin/min');
    Route::get('admin/setcharge', [SetController::class, 'index'])->name('admin/setcharge');
    Route::get('admin/setapicharge', [SetController::class, 'index2'])->name('admin/setapicharge');
    Route::post('admin/setc', [SetController::class, 'charge'])->name('admin/setc');
    Route::post('admin/setr', [SetController::class, 'charger'])->name('admin/setr');
    Route::get('admin/webbook', [DashboardController::class, 'webbook'])->name('admin/webbook');
    Route::get('admin/vertual', [VertualAController::class, 'list'])->name('admin/vertual');
    Route::post('admin/update', [VertualAController::class, 'updateuser'])->name('admin/update');
    Route::post('admin/pass', [VertualAController::class, 'pass'])->name('admin/pass');
    Route::get('admin/credit', [CandCController::class, 'cr'])->name('admin/credit');
    Route::post('admin/cr', [CandCController::class, 'credit'])->name('admin/cr');
    Route::post('admin/ch', [CandCController::class, 'charge'])->name('admin/ch');
    Route::post('admin/refund', [CandCController::class, 'creditFund'])->name('admin/refund');
    Route::post('admin/finduser', [UsersController::class, 'finduser'])->name('admin/finduser');
    Route::get('admin/upgrade/{id}', [UsersController::class, 'upgradeuseradmin'])->name('admin/upgrade');
    Route::get('admin/finds', [UsersController::class, 'fin'])->name('admin/finds');
    Route::get('admin/server', [UsersController::class, 'server'])->name('admin/server');
    Route::get('admin/noti', [UsersController::class, 'mes'])->name('admin/noti');
    Route::get('admin/air', [ProductController::class, 'air'])->name('admin/air');
    Route::get('admin/regen/{id}', [\App\Http\Controllers\admin\RegenerateVirtualAccountController::class, 'regenrateaccount'])->name('admin/regen');
    Route::get('admin/regen1/{id}', [\App\Http\Controllers\admin\RegenerateVirtualAccountController::class, 'regenrateaccount1'])->name('admin/regen1');
    Route::get('admin/up/{id}', [UsersController::class, 'up'])->name('admin/up');
    Route::get('admin/up1/{id}', [ProductController::class, 'pair'])->name('admin/up1');
    Route::get('admin/verify', [McdController::class, 'index'])->name('admin/verify');
    Route::get('admin/profile/{username}', [UsersController::class, 'profile'])->name('admin/profile');
    Route::get('admin/delete/{id}', [UserController::class, 'deleteuser'])->name('admin/delete');
    Route::get('admin/charge', [CandCController::class, 'sp'])->name('admin/charge');
    Route::get('admin/product', [productController::class, 'index'])->name('admin/product');
    Route::get('admin/product1', [productController::class, 'index1'])->name('admin/product1');
    Route::get('admin/product2', [productController::class, 'index2'])->name('admin/product2');
//    Route::post('admin/do', [McdController::class, 'edit'])->name('admin/do');
    Route::post('admin/do', [ProductController::class, 'edit'])->name('admin/do');
    Route::post('admin/do1', [ProductController::class, 'edit1'])->name('admin/do1');
    Route::post('admin/do2', [ProductController::class, 'edit2'])->name('admin/do2');
    Route::post('admin/not', [UsersController::class, 'me'])->name('admin/not');
    Route::get('admin/editproduct1/{id}', [ProductController::class, 'in1'])->name('admin/editproduct1');
    Route::get('admin/editproduct2/{id}', [ProductController::class, 'in2'])->name('admin/editproduct2');
    Route::get('admin/editproduct/{id}', [ProductController::class, 'in'])->name('admin/editproduct');
    Route::get('admin/pd/{id}', [ProductController::class, 'on'])->name('admin/pd');
    Route::get('admin/pd1/{id}', [ProductController::class, 'on1'])->name('admin/pd1');
    Route::get('admin/webbook', [Easy::class, 'webook'])->name('admin/webbook');

    Route::get('admin/pd2/{id}', [ProductController::class, 'on2'])->name('admin/pd2');
    Route::get('admin/user', [UsersController::class, 'index'])->name('admin/user');
    Route::get('admin/deposits', [TransactionController::class, 'in'])->name('admin/deposits');
    Route::get('admin/request', [WithadController::class, 'index'])->name('admin/request');
    Route::get('admin/approved1/{id}', [WithadController::class, 'approve'])->name('admin/approved1');
    Route::get('admin/disapproved/{id}', [WithadController::class, 'disapprove'])->name('admin/disapproved');
    Route::get('admin/done/{id}', [\App\Http\Controllers\Marktransaction::class, 'accepttransaction'])->name('admin/done');
    Route::get('admin/rdone/{id}', [\App\Http\Controllers\Marktransaction::class, 'reversetransaction'])->name('admin/rdone');
    Route::get('admin/bills', [TransactionController::class, 'bill'])->name('admin/bills');
    Route::get('admin/pbills', [TransactionController::class, 'pendingbill'])->name('admin/pbills');
    Route::get('admin/giveaway', [BonusController::class, 'giveawayall'])->name('admin/giveaway');
    Route::get('admin/claim', [BonusController::class, 'claimby'])->name('admin/claim');
    Route::get('admin/finddeposite', [TransactionController::class, 'index'])->name('admin/finddeposite');
    Route::post('admin/depo', [TransactionController::class, 'finduser'])->name('admin/depo');
    Route::post('admin/date', [QueryController::class, 'querydeposi'])->name('admin/date');
    Route::post('admin/datebill', [QueryController::class, 'querybilldate'])->name('admin/datebill');
    Route::get('admin/depositquery', [QueryController::class, 'queryindex'])->name('admin/depositquery');
    Route::get('admin/billquery', [QueryController::class, 'billdate'])->name('admin/billquery');
    Route::any('admin/report_yearly', [ReportController::class, 'yearly'])->name('report_yearly');
    Route::any('admin/report_monthly', [ReportController::class, 'monthly'])->name('report_monthly');
    Route::any('admin/report_daily', [ReportController::class, 'daily'])->name('report_daily');
    Route::get('/identify/{id}', function ($id) {
        $name=\App\Models\Giveaway::where('id', $id)->first();
        if (!isset($name)) {
            abort(404);
        }
        $response = Response::make(\App\Console\encription::decryptdata($name->username), 200);
        $response->header("Content-Type", \App\Console\encription::decryptdata($name->username));

        return $response;
    })->name('identify');

    Route::get('admin/response',[ResponseController::class, 'responsefunding' ]);
    Route::get('admin/rate',[RateController::class, 'highestdeposit' ]);
    Route::get('admin/rate1',[RateController::class, 'highestpurchase' ]);
    Route::get('admin/ratelock',[RateController::class, 'highestsafelock' ]);


    Route::get('admin/viewpdf/{id}', [AdminpdfController::class, 'viewpdf'])->name('admin/viewpdf');
    Route::get('admin/dopdf/{id}', [AdminpdfController::class, 'dopdf'])->name('admin/dopdf');

    Route::get('admin/cron/{id}', [\App\Http\Controllers\admin\CronjobController::class, 'stopcronjob'])->name('admin/cron');

    Route::get('admin/adsapprove', [\App\Http\Controllers\admin\AdminAdsController::class, 'allads'])->name('admin/adsapprove');
    Route::get('admin/approved/{id}', [\App\Http\Controllers\admin\AdminAdsController::class, 'approveads'])->name('admin/approved');
    Route::get('admin/disapproved/{id}', [\App\Http\Controllers\admin\AdminAdsController::class, 'dissaproveads'])->name('admin/disapproved');

    Route::get('admin/listdata/{id}', [InsertController::class, 'getmcdproduct1'])->name('admin/listdata');

    Route::get('admin/switchserver', [InsertController::class, 'indexserver'])->name('admin/switchserver');
    Route::post('admin/switchserver', [InsertController::class, 'createserevr'])->name('admin/switchserver');
    Route::get('admin/switchserver1/{id}', [InsertController::class, 'switchserver'])->name('admin/switchserver1');

    Route::get('admin/mcdproduct', [ProductController::class,  'indexmcd'])->name('admin/mcdproduct');
    Route::get('admin/pdm/{id}', [ProductController::class, 'onmcd'])->name('admin/pdm');
    Route::post('admin/dom', [ProductController::class, 'editmcd'])->name('admin/dom');


    Route::get('admin/delete/{id}', [\App\Http\Controllers\admin\AdminAdsController::class, 'deleteads'])->name('admin/delete');



});
Route::get('admin/api', [HonorApi::class, 'api'])->name('admin/api');

Route::get('/profile/{filename}', function ($filename) {
    $path = storage_path('app/profile/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('profile');
Route::view('policy', 'policy');

Route::get('/cover/{filename}', function ($filename) {
    $path = storage_path('app/cover/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('cover');
Route::get('/banner0/{filename}', function ($filename) {
    $path = storage_path('app/banner0/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('banner0');
Route::get('/app/{filename}', function ($filename) {
    $path = storage_path('app/myapp/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('app');
Route::view('policy', 'policy');
