<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ExamQuestion;
use App\Repositories\Admin\ExamQuestionRepository;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ExamQuestionController extends Controller
{
    public function __construct(ExamQuestionRepository $ExamQuestionRepository)
    {
        $this->examQuestionRepository = $ExamQuestionRepository;
    }
    public function addQuestionList(Request $request)
    {
        $response = $this->examQuestionRepository->addQuestionList($request);
        return response()->json($response);
    }
    public function addExamQuestion(Request $request)
    {
        $add = $this->examQuestionRepository->addQuestion($request);
        if ($add) {
            return response()->json($add);
        } else {
            return response()->json(false);
        }
    }
    public function removeExamQuestion(Request $request)
    {
        $remove = $this->examQuestionRepository->removeQuestion($request);
        if ($remove) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    public function ExamQuestionGetById()
    {
        $id = request()->id;
        $exam_id = request()->exam_id;
        $response = ExamQuestion::where('exam_id', $exam_id)->where('question_id', $id)->first();
        return view('Admin.question.edit-exam-question', compact('response'));
    }
    public function updateExamQuestion(Request $request)
    {
        $update = $this->examQuestionRepository->updateQuestion($request);
    }
}
