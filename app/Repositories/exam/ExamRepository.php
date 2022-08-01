<?php

namespace App\Repositories\exam;

use App\Models\Admin\Exam;
use App\Models\Admin\ExamQuestion;
use App\Models\Question;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ExamRepository.
 */
class ExamRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }
    public function createExam($request)
    {
        $exam = new Exam();
        $exam->name = $request->exam;
        $exam->time = $request->time;
        // $exam->questions = $request->duallistbox_demo1;
        $exam->status = config('question.examstatus.pending');
        $exam->save();
        if($request->duallistbox_demo1)
        {
            foreach ($request->duallistbox_demo1 as $question) {
                $data = Question::select()->where('_id', $question)->first();
                $examQuestion = new ExamQuestion();
                $examQuestion->exam_id = $exam->id;
                $examQuestion->question_id = $data->id;
                $item['question_type'] = $data->question_type;
                $item['question'] = $data->question;
                $item['questionImage'] = $data->questionImage;
                $item['answer_options'] = $data->answer_options;
                $item['score'] = $data->score;
                $examQuestion->question = $item;
                $examQuestion->save();
            }
        }
        $exam['status'] = 1;
        $exam['message'] = "Exam created successfully";
        return $exam;
    }
    public function examListJson($request)
    {
        $draw = $request->draw;
        $search = $request->search['value'];
        $length = $request->length;
        $start = $request->start;
        // getting driver data
        $query = Exam::select('_id', 'name', 'time', 'questions', 'status');
        $count = $query->count();
        // if search has value
        if (!empty($search)) {
            $searchColumns = ['name', 'time', 'status'];
            $query->where(function ($query) use ($searchColumns, $search) {
                foreach ($searchColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
            $filteredCount = $query->count();
        } else {
            $filteredCount = $count;
        }
        $exams = $query->offset($start)->limit($length)->get();
        // creating action buttons
        foreach ($exams as $exam) {
            $exam['actions'] = "<a href='" . route('exam-data-get', ['id' => $exam->id]) . "'><button class='btn btn-success me-2' data-toggle='modal' data-target='' value=''><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-view-list' viewBox='0 0 16 16'>
            <path d='M3 4.5h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1H3zM1 2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 2zm0 12a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 14z'/>
          </svg></button></a>
            <button class='btn btn-danger deletebtn' value='$exam->_id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
            <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z'/>
          </svg></button>";
        }
        return ['draw' => $draw, 'recordsTotal' => $count, 'recordsFiltered' => $filteredCount, 'data' => $exams];
    }
    public function examQuestions($request)
    {
       
        // $questions = Exam::select('questions')->where('_id', $request->id)->first()->toArray();
        $draw = $request->draw;
        $search = $request->search['value'];
        $length = $request->length;
        $start = $request->start;
        $i = 1;
        // getting driver data
        $query = ExamQuestion::select('_id','question_id','question.question')->where('exam_id',$request->id);
        $count = $query->count();
        // if search has value
        if (!empty($search)) {
            $searchColumns = ['question'];
            $query->where(function ($query) use ($searchColumns, $search) {
                foreach ($searchColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
            $filteredCount = $query->count();
        } else {
            $filteredCount = $count;
        }
        $questions = $query->offset($start)->limit($length)->get();
        // dd($questions);
        // creating action buttons
        foreach ($questions as $question) {
            $question['number'] = $i++;
            $qId = $question->question_id;
            $question['question'] = array_key_exists('question',$question->question)?$question->question['question']:null;
            $question['actions'] = "<a href='" . route('exam-question-get', ['id' => $qId,'exam_id'=>$request->id]) . "'><button class='btn btn-light border border-dark me-2' name=exam_id value='$request->id'>EDIT</button></a>
            <button class='btn btn-secondary question-remove-btn border border-dark' value='$qId' data-value='$qId'>REMOVE</button>";
        }
        return ['draw' => $draw, 'recordsTotal' => $count, 'recordsFiltered' => $filteredCount, 'data' => $questions];
    }
    public function removeQuestion($request)
    {
        $items = Exam::select('questions')->where('_id', $request->exam_id)->first()->toArray();
        foreach ($items['questions'] as $key => $item) {
            if ($item == $request->question_id) {
                // dd($items['questions'][$key]);
            }
        }
        dd('flgjkh');
    }
    public function deleteExam($id)
    {
        return Exam::find($id)->delete();
    }
}
