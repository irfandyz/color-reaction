<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\User;
class ScoreController extends Controller
{
    public function get(request $request){
        $data = Score::find($request->id);
        $result = [];
        foreach (json_decode($data->score) as $value) {
            array_push($result,$value);
        }
        $data->score = $result;
        return response()->json([
            'data'=>$data
        ],200);
    }
    public function store(request $request){
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['message'=>'Error, user not found'], 200);
        }
        $data = [];
        $total = 0;
        foreach ($request->score as $value) {
            array_push($data,$value);
            $total = $total + $value;
        }
        $result = [
            'user_id'=>$request->user_id,
            'score'=>json_encode($data),
            'average'=>$total/count($data),
        ];
        $score = Score::create($result);
        return response()->json([
            'message'=>'success',
            'data'=>$score
        ],200);
    }
}
