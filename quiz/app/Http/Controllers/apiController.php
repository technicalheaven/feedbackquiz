<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class apiController extends Controller
{
  function service_options(){
    $service_options =   DB::table('service_option')->select('id','name')->get();
    return response(['status'=>true,'options'=>$service_options], 200);
   }

  function user_feedback(Request $request){
    $rules = [
        'user_id'  => 'required|numeric',
    ];

    $input     = $request->only('user_id');
    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'error' => $validator->messages()]);
    }
    $data = DB::table('service_feedback as sf')->select('so.id','so.name')
        ->join('service_option as so', 'sf.option_id', '=', 'so.id')
        ->where('sf.user_id', $request->user_id)->first();
    return response(['status'=>true,'data'=>$data], 200);
  }

  function feedback_report(){
    $data = DB::table('service_feedback as sf')
    ->join('service_option as so', 'sf.option_id', '=', 'so.id')
    ->select('so.name',DB::raw('count(sf.user_id) as count'))
    ->groupBy('sf.option_id')->get();
    $total = DB::table('service_feedback')->count();
    return response(['status'=>true,'total' => $total,'data'=>$data], 200);
  }
  function save_feedback(Request $request){

    $rules = [
        'user_id'  => 'unique:service_feedback|required|numeric',
        'option_id'=> 'required|numeric',
    ];

    $input     = $request->only('user_id', 'option_id');
    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'error' => $validator->messages()]);
    }

    $data = array(
        'user_id'    => $request->user_id,
        'option_id'  => $request->option_id,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
    );
    $res = DB::table('service_feedback')->insert($data);
    return response(['status'=>true,'data'=>$res], 200);
   }
}
