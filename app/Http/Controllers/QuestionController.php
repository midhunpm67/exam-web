<?php

namespace App\Http\Controllers;

use App\Repositories\Admin\QuestionRepository;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(QuestionRepository $QuestionRepository)
    {
        $this->questionRepository = $QuestionRepository;
    }
    public function question()
    {
        return view('Admin.question.question');
    }
    public function createQuestion(Request $request)
    {
        $response = $this->questionRepository->createQuestion($request);

        return $response;
    }
    public function listQuestion()
    {
        return view('Admin.question.list-question');
    }
    public function listQuestionJosn(Request $request)
    {
        $response = $this->questionRepository->listQuestionJosn($request);
        return response()->json($response);
    }
    public function QuestionDelete()
    {
        $response = $this->questionRepository->delete(request()->id);
        return response()->json($response);
    }
    public function QuestionGetById()
    {
        $response = $this->questionRepository->QuestionGetById(request()->id);
        // dd($response);   
        return view('Admin.question.edit-question',compact('response'));
    }
    public function updateQuestion(Request $request)
    {
        // dd($request);
        $response = $this->questionRepository->updateQuestion($request);
        return $response;
    }
}
