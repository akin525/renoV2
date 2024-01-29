<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\safe_lock;
use Illuminate\Http\Request;

class SafelocksController extends Controller
{
  function editsafelock(Request $request)
  {
      $request->validate([
          'id'=>'required',
          'amount'=>'required',
      ]);
      $lock=safe_lock::where('id', $request)->first();

      $lock->balance=$request->amount;
      $lock->save();
      $msg="Amount Change Successful";
      return response()->json([
          "status"=>1,
          "message"=>$msg,
      ]);

  }
}
