<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 12/8/20
 * Time: 19:14
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Tag;

class QuizController extends Controller
{

    public function addNewQuiz() {
        $activePage = 'new_quiz';
        $tags = Tag::where('type', Tag::TYPE_QUIZ)->get();
        return view('admin.create-new-quiz')->with(compact('activePage', 'tags'));
    }

    public function loadQuestionCollapse($index)
    {
        $view = view('admin.includes.quiz-question-collapse')->with(compact('index'))->render();
        return response()->json(compact('view'));
    }
}