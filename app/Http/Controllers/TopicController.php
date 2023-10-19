<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Topic;
class TopicController extends Controller
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    public $timestamps = false;
    public function index()
    {
        //
        $topics = Topic::all();
        $json = [];
        foreach($topics as $tp) {
            $id = $tp["id"];
            $place = $tp["place"];
            $type = $tp['topic'];
            $existingPlace = array_filter($json, function ($item) use ($place) {
                return $item["place"] === $place;
            });
            if (!empty($existingPlace)) {
                // 已存在該地點，將類型加入該地點的類型陣列中
                foreach ($json as &$item) {
                    if ($item['place'] === $place) {
                        $item['type'][] = $type;
                        $item['id'][] = $id;
                        break;
                    }
                }
            } 
            else {
                // 不存在該地點，新增地點及其類型
                $json[] = [
                    "place" => $place,
                    "type" => [$type],
                    "id" => [$id]
                ];
            }
        }
        return  response()->json($json);
    }
    public function addTopic(Request $request) {
        Log::info($request);
        $formData = $request->all();
        $topics = Topic::where('place','=',$formData['place'])
                        ->where('topic', '=', $formData['type'])
                        ->exists();
        Log::info($topics);
        try {
            if(!$topics) {
                $topic = new Topic();
    
                $topic->topic = $formData['type'];
                $topic->place = $formData['place'];
    
                $topic->save();
    
                return response()->json(['message' => '新增成功']);
            }
            else {
    
                return response()->json(['message' => '已經存在']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => '新增失敗']);
        }
        
        
    }

    public function deletePlace(Request $request) {

        $formData = $request->all();
        // Log::info($formData);
        $place = Topic::where('place', $formData['place'])->first();
           
        // Log::info($place);            
        $place->delete();
        return response()->json(['message' => '刪除成功']);
    }
    public function deleteType(Request $request) {
        $formData = $request->all();
        $type = Topic::where('place','=', $formData['place'])
                    ->where('topic','=', $formData['type'])
                    ->first();

        $type->delete();

        return response()->json(['message' => '刪除成功']);
    }
    public function modifyPlace(Request $request) {
        
        $formData = $request->all();
        // Log::info($formData);
        try {
            foreach ($formData['index'] as $index) {
                // Log::info($index);
                $place = Topic::find($index);
                // Log::info($place);
                $place->place  = $formData['place'];
                $place->save();
            }
            return response()->json(['message' => '修改成功']);
        } catch (\Throwable $th) {
            return response()->json(['message' => '修改失敗']);
        }
        
    }

    public function modifyType(Request $request) {
        $formData = $request->all();

        try {
            $type = Topic::where('place', $formData['place'])
                    ->where('topic', $formData['before'])
                    ->first();
            // Log::info($type);
            $type->topic = $formData['after'];
            $type->save();

            return response()->json(['message' => '修改成功']);
        } catch (\Throwable $th) {
            return response()->json(['message' => '修改失敗']);
        }
        
    }
    
}
