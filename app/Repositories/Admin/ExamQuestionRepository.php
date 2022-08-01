<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ExamQuestion;
use App\Models\Question;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ExamQuestionRepository.
 */
class ExamQuestionRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }
    public function addQuestionList($request)
    {
        $draw = $request->draw;
        $search = $request->search['value'];
        $length = $request->length;
        $start = $request->start;
        // getting driver data
        $query = Question::select('_id', 'question');
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
        $addedQuestions = ExamQuestion::select('question_id')->where('exam_id', $request->exam_id)->get()->toArray();
        $data[] = " ";
        foreach ($addedQuestions as $item) {
            $data[] =  $item['question_id'];
        }
        foreach ($questions as $key => $question) {
            $question['number'] = $key + 1;
            if ($data) {
                if (in_array($question->_id, $data)) {
                    $question['actions'] = "
                    <button class='btn btn-secondary question-remove-btn' value='$question->_id'>REMOVE</button>";
                } else {
                    $question['actions'] = "
                    <button class='btn btn-secondary question-add-btn' value='$question->_id'>ADD</button>";
                }
            } else {
                $question['actions'] = "
                <button class='btn btn-secondary question-add-btn' value='$question->_id'>ADD</button>";
            }
        }
        return ['draw' => $draw, 'recordsTotal' => $count, 'recordsFiltered' => $filteredCount, 'data' => $questions];
    }
    public function addQuestion($request)
    {
        $data = Question::select()->where('_id', $request->id)->first();
        $examQuestion = new ExamQuestion();
        $examQuestion->exam_id = $request->exam_id;
        $examQuestion->question_id = $data->id;
        $item['question_type'] = $data->question_type;
        $item['question'] = $data->question;
        $item['questionImage'] = $data->questionImage;
        $item['answer_options'] = $data->answer_options;
        $item['score'] = $data->score;
        $examQuestion->question = $item;
        $examQuestion->save();
        return $examQuestion;
    }
    public function removeQuestion($request)
    {
        $delete =   ExamQuestion::where('question_id', $request->id)->where('exam_id', $request->exam_id)->delete();
        return $delete;
    }
    public function updateQuestion($request)
    {
        // $examQuestion = ExamQuestion::where('exam_id',$request->exam_id)->where('question_id',$request->question_id)->first();
        // $examQuestion->exam_id = $request->exam_id;
        // $examQuestion->question_id = $request->question_id;
        // // $item['question_type'] = $request->question_type;
        // $item['question'] = $request->question;
        // $item['questionImage'] = $request->questionImage;
        // $item['answer_options'] = $request->answer_options;
        // $item['score'] = $request->score;
        // $examQuestion->question = $item;
        // $examQuestion->save();
        // dd($examQuestion);
    }
}
