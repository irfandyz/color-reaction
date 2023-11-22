<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Score;
use App\Models\Setting;
use File;
use App\Exports\UserScoreExport;
use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{
    public function index(request $request){
        $user = User::where('role','user')->get();
        if ($request->id) {
            $userSelect = User::find($request->id);
            $data = Score::where('user_id',$request->id)->get();
            $result = [];
            $count = 0;
            $average = [];
            foreach ($data as $score) {
                $score->score = json_decode($score->score);
                $count += count($score->score);
                $score->indexAverage = $this->indexScore($score->average);
                array_push($result,$score);
                array_push($average,floatval($score->average));
            }
            $averageFinal['average'] =null;
            $averageFinal['index'] =null;
            if ($data->count() > 0) {
                $averageFinal['average'] = number_format((float)array_sum($average)/count($average), 2, '.', '');
                $averageFinal['index'] = $this->indexScore($averageFinal['average']);
            }
            return view('admin.score',compact('result','user','userSelect','count','average','averageFinal'));
        }
        $final = [];
        foreach ($user as $value) {
            $data = Score::where('user_id',$value->id)->get();
            $allScore = [];
            foreach ($data as $score) {
                $score->score = json_decode($score->score);
                array_push($allScore,$score);
            }
            $value->score = $allScore;
            array_push($final,$value);
        }
        return view('admin.index',compact('final','user'));
    }
    public function setting(){
        $setting = Setting::first();
        return view('admin.setting',compact('setting'));
    }
    public function saveSetting(request $request){
        $request->validate([
            'audio'=>'mimes:mp3'
        ]);
        $data = [
            'attempt'=>$request->attempt,
            'obstacle'=>$request->obstacle,
            'colorOne'=>$request->colorOne,
            'colorTwo'=>$request->colorTwo,
            'background'=>$request->background,
            'audioPlay'=>$request->audioPlay,
        ];
        if ($request->audio) {
            $audio = $request->audio;
            $url = 'assets';
            File::delete(public_path($url . "/" . Setting::first()->audio));
            $filename = date('dmYHis'). "." . $audio->extension();
            $audio->move(public_path($url), $filename);
            $data['audio'] = $filename;
        }
        Setting::first()->update($data);
        return redirect()->back()->with('message','success');
    }
    function indexScore($score){
        $index = null;
        if ($score <= 100) {
            $index = "Istimewa";
        }elseif ($score <= 200) {
            $index = "Bagus Sekali";
        }elseif ($score <= 300) {
            $index = "Bagus";
        }elseif ($score <= 400) {
            $index = "Cukup";
        }elseif ($score <= 500) {
            $index = "Kurang";
        }else {
            $index = "Kurang Sekali";
        }
        return $index;
    }
    public function export($id){
        $user = User::find($id);
        $data = Score::where('user_id',$id)->get();
        $result = [];
        foreach ($data as $score) {
            $score->score = json_decode($score->score);
            array_push($result,$score);
        }
        // return $result;

        return Excel::download(new UserScoreExport($id), $user->name.'.xlsx');
    }
}
