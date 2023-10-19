<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersInformationController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\DialogController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\VideoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/', function () {
//     return view('demo');
// });

Route::get('/', function () {
    $data['user_token'] =  Session::get('userLogin', 'null');
    return view('index')->with(['data' => $data]);
});
Route::get('/logout', function () {
    Session::forget('userLogin');
    $data['user_token'] =  Session::get('userLogin', 'null');
    return redirect()->intended('/')->with(['data' => $data]);
});
Route::get('/manual', function () {
    $data['user_token'] =  Session::get('userLogin', 'null');
    return view('manual')->with(['data' => $data]);
});

Route::get('/infoDialog', function () {
    $data['user_token'] =  Session::get('userLogin', 'null');
    return view('infoDialog')->with(['data' => $data]);
});

Route::get('/aboutUs', function() {
    $data['user_token'] =  Session::get('userLogin', 'null');
    return view('aboutUs')->with(['data' => $data]);
});

Route::get('/seeMore', Function() {
    $data['user_token'] =  Session::get('userLogin', 'null');
    return view('seeMore')->with(['data' => $data]);
});

Route::get('dialogManagement', [DialogController::class, 'index']);
Route::get('action', [ActionController::class, 'view']);

Route::get('image/{filename}', [PictureController::class, 'getImage']);
Route::post('downloadImage', [PictureController::class, 'download']);
Route::post('QRcodeGenerate', [PictureController::class, 'QRcodeGenerate']);
Route::post('imageSave', [PictureController::class, 'imageSave']);

Route::get('videos/{filename}', [VideoController::class, 'getVideo'])->name('videos');

Auth::routes();

Route::post('userAdd', [UsersInformationController::class, 'add']);
Route::post('userLogin', [UsersInformationController::class, 'login']);

Route::post('topicIndex',[TopicController::class, 'index']);
Route::post('topicAdd', [TopicController::class, 'addTopic']);
Route::post('topicDelete', [TopicController::class, 'deletePlace']);
Route::post('topicModify', [TopicController::class, 'modifyPlace']);
Route::post('typeDelete', [TopicController::class, 'deleteType']);
Route::post('typeModify', [TopicController::class, 'modifyType']);

Route::post('AnswerGroupUpdate', [AnswerController::class,'update']);
Route::post('answerInsert', [AnswerController::class,'insert']);
Route::post('AnswerDelete', [AnswerController::class, 'delete']);

Route::post('questionUpdate', [QuestionController::class,'update']);
Route::post('questionGroupIndex', [QuestionController::class,'index']);
Route::post('questionInsert', [QuestionController::class,'insert']);
Route::post('QuestionDelete', [QuestionController::class, 'delete']);

Route::post('actionGet', [ActionController::class,'index']);
// Route::post('answerIndex', [AnswerController::class,'index']);