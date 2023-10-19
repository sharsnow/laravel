<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;

class AnswerController extends Controller
{
    //
    public function index() {
        
        $answer = Answer::all();
        return  response()->json($answer, 200);
    }
    
    public function update(Request $request) {
        $formData = $request->all();
        Log::info($formData);
        
        $ans_no = $formData['ans_no'];
        $ans = $formData['ans'];
        $direction = $formData['qus_no'];
        
        $answer = Answer::find($ans_no);
        $answer->answer = $ans;
        $answer->direction  = $direction ; 
        $answer->save();

        return response()->json(['message' => '更新成功']);
    }
      
    public function insert(Request $request) {
        $formData = $request->all();
        // Log::info($formData);

        $qus_no = $formData['qus_no'];
        $ans = $formData['answer'];
        $direction = $formData['direction'];
        $place = $formData['place'];
        $type = $formData['type'];
       
        $answer = new Answer();
        $answer->answer = $ans;
        $answer->direction = $direction;
        $answer->topic = $type;
        $answer->place = $place;
        $answer->save();

        // Log::info($answer);
        // Log::info($answer->ans_no);

        $question = Question::find($qus_no);
        if(empty($question->direction)) {
            $question->direction = strval($answer->ans_no);
        }
        else {
            $question->direction .= "." . strval($answer->ans_no);
        }
        // Log::info($question);
        $question->direction = str_replace('..','.',$question->direction);
        $question->save();

        return response()->json(['message' => '新增成功','ans_no' => $answer->ans_no, 'dir' => $question->direction]);
    }
    public function delete(request $request) {
        $formData = $request->all();
        Log::info($formData);

        $answer = Answer::find($formData['ans_no']);
        $answer->delete();

        $question = Question::find($formData['qus_no']);
        $question->direction = str_replace($formData['ans_no'],'',$question->direction);
        $question->direction = str_replace('..','.',$question->direction);
        Log::info($question);
        $question->save();
        return response()->json(['message' => '刪除成功']);
    }
}
