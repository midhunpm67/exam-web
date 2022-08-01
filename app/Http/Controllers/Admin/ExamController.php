<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Repositories\exam\ExamRepository;

class ExamController extends Controller
{

    public function __construct(ExamRepository $ExamRepository)
    {
        $this->examRepository = $ExamRepository;
    }

    public function exam()
    {
        $questions = Question::get();
        // dd($questions);
        return view('Admin.exam.exam', compact('questions'));
    }
    public function createExam(Request $request)
    {
        $response = $this->examRepository->createExam($request);
        return response()->json($response);
    }
    public function examList()
    {
        return view('Admin.exam.exam-list');
    }
    public function examListJson(Request $request)
    {
        $response = $this->examRepository->examListJson($request);
        return response()->json($response);
    }
    public function examGetData()
    {
        $exam = Exam::find(request()->id);
        return view('Admin.exam.exam-edit', compact('exam'));
    }
    public function examQuestions(Request $request)
    {
        $questions = $this->examRepository->examQuestions($request);
        return response()->json($questions);
    }
    public function removeQuestion(Request $request)
    {
        $questions = $this->examRepository->removeQuestion($request);
        return response()->json($questions);
    }
    public function deleteExam()
    {
        $status = $this->examRepository->deleteExam(request()->id);
        return $status;
    }
}
