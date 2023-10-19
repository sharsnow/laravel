<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Action;

class QuestionController extends Controller
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    public $timestamps = false;
    public function index(Request $request)
    {
        $formData = $request->all();

        $place = $formData['place'];
        $type = $formData['type'];
        // Log::info($formData);
        $question = Question::join('action', 'question_information.action', '=', 'action.no')
                    ->select('question_information.*', 'action.*')
                    ->where('topic', '=', $type)
                    ->where('place', '=', $place)
                    ->get();
        // Log::info($question);
        $answer = Answer::where('topic', '=', $type)
                    ->where('place', '=', $place)
                    ->get();
        $json = [];
        // Log::info($answer);
        $answerMap = [];
        foreach ($answer as $a) {
            $answerMap[$a["ans_no"]] = [
                "ans_no" => $a["ans_no"],
                "answer" => $a["answer"],
                "qus_no" => $a["direction"],
            ];
        }

        $json = [];
        foreach ($question as $q) {
            $qus_no = $q["qus_no"];
            $question = $q["question"];
            $action = $q["action"];
            $ans_dir = [];
            $dir = explode(".", $q["direction"]);
            foreach ($dir as $d) {
                if (isset($answerMap[$d])) {
                    $ans_dir[] = $answerMap[$d];
                }
            }
            $json[] = [
                "qus_no" => $qus_no,
                "question" => $question,
                "action" => $action,
                "ans_dir" => $ans_dir,
                "modify" => false
            ];
        }
        return  response()->json($json, 200);
        // return view('user.index', ['users' => $users]);
    }
    public function update(Request $request) {
        $formData = $request->all();
        // Log::info($formData);
        
        $qus_no = $formData['qus_no'];
        $qus = $formData['question'];
        $action = $formData['action'];
        
        $question = Question::find($qus_no);
        $question->question = $qus;
        $question->action = $action;
        $question->save();

        return response()->json(['message' => '更新成功']);
    }
    public function insert(Request $request) {
        $formData = $request->all();

        // Log::info($formData);
        $question = new Question();
        try {
            $question->question = $formData['qus'];
            $question->place = $formData['place'];
            $question->topic = $formData['type'];
            $question->action = $formData['action']; 
            // Log::infO($action);
    
            $question->save();
        } catch (\Throwable $th) {
            return response()->json(['message' => '新增失敗']);
        }
        return response()->json(['message' => '新增成功', 'qus_no' => $question->qus_no]);
    } 
    public function delete(Request $request) {
        $formData = $request->all();
        // Log::info($formData);

        $question = Question::find($formData['qus_no']);
        $question->delete();
        // Log::info($question);

        $answer = Answer::all();
        foreach($answer as $ans) {
            if(($ans->direction == $formData['qus_no'])) {
                $a = Answer::find($ans->ans_no);
                // Log::info($a);
                $a->direction = '';
                $a->save();
            }
        }

        foreach ($formData['ans_dir'] as $ans) {
            $answer = Answer::find($ans['ans_no']);
            // $answer->delete();
            // Log::info($answer);
        }
        
        return response()->json(['message' => '刪除成功']);
    }
}
