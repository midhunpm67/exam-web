<?php

namespace App\Repositories\Admin;

use App\Models\Question;
use Illuminate\Support\Str;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class QuestionRepository.
 */
class QuestionRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }
    public function createQuestion($data)
    {
        if ($data->question_type == '3') {
            if ($data->questionImage) {
                $image = $data->questionImage;
                $qstnImage = date('YmdHis') . Str::random(5) . "." . $image->getClientOriginalExtension();
                $move = $image->storeAs('/image/question', $qstnImage, 'public');
                $options = [$data->option11, $data->option12, $data->option13, $data->option14];
                $answerArray = $this->createOption($data);
            }
        } elseif ($data->question_type == '2') {
            $options = [$data->option21, $data->option22, $data->option23, $data->option24];
            foreach ($options as $key => $image) {
                $optnImage = date('YmdHis') . Str::random(5) . "." . $image->getClientOriginalExtension();
                $move = $image->storeAs('/image/question', $optnImage, 'public');
                $optnImages[$key] = $optnImage;
            }
            $data['optnImage'] = $optnImages;

            $answerArray = $this->createOption($data);
        } elseif ($data->question_type == '1') {
            $answerArray = $this->createOption($data);
        }
        $qstn = new Question();
        $qstn->question_type = $data->question_type;
        $qstn->question = $data->question1;
        $qstn->questionImage = isset($qstnImage) ? $qstnImage : '';
        $qstn->answer_options = $answerArray;
        $qstn->score = $data->score;
        $qstn->save();
        if ($qstn) {
            $qstn['status'] = 1;
            $qstn['message'] = 'Question added successfully';
        }
        return $qstn;
    }
    public function createOption($data)
    {
        $answerArray = [
            ['answer_option_id' => 1, 'text' => isset($data->option11) ? $data->option11 : '', 'image' => isset($data->optnImage[0]) ? $data->optnImage[0] : '', 'is_correct_answer' => ($data->correct == 'option1') ? true : false],
            ['answer_option_id' => 2, 'text' => isset($data->option12) ? $data->option12 : '', 'image' => isset($data->optnImage[1]) ? $data->optnImage[1] : '', 'is_correct_answer' => ($data->correct == 'option2') ? true : false],
            ['answer_option_id' => 3, 'text' => isset($data->option13) ? $data->option13 : '', 'image' => isset($data->optnImage[2]) ? $data->optnImage[2] : '', 'is_correct_answer' => ($data->correct == 'option3') ? true : false],
            ['answer_option_id' => 4, 'text' => isset($data->option14) ? $data->option14 : '', 'image' => isset($data->optnImage[3]) ? $data->optnImage[3] : '', 'is_correct_answer' => ($data->correct == 'option4') ? true : false],
        ];

        return $answerArray;
    }




    public function listQuestionJosn($request)
    {
        $draw = $request->draw;
        $search = $request->search['value'];
        $length = $request->length;
        $start = $request->start;
        // getting driver data
        $query = Question::select('_id', 'question_type', 'question', 'score');
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
        // creating action buttons
        foreach ($questions as $question) {
            $question['actions'] = "<a href='" . route('QuestionGetById', ['id' => $question->id]) . "'><button class='btn btn-success me-2' data-toggle='modal' data-target='' value=''><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
             </svg></button></a>
            <button class='btn btn-danger deletebtn' value='$question->_id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
            <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z'/>
          </svg></button>";
        }
        return ['draw' => $draw, 'recordsTotal' => $count, 'recordsFiltered' => $filteredCount, 'data' => $questions];
    }
    public function delete($id)
    {
        return Question::find($id)->delete();
    }
    public function QuestionGetById($id)
    {
        return Question::where('_id', $id)->first();
    }
    public function updateQuestion($data)
    {
        $oldData = Question::find($data->id);
        if ($data->qstn_type == '3') {
            if ($data->questionImage) {
                $image = $data->questionImage;
                $qstnImage = date('YmdHis') . Str::random(5) . "." . $image->getClientOriginalExtension();
                $move = $image->storeAs('/image/question', $qstnImage, 'public');
                $options = [$data->option11, $data->option12, $data->option13, $data->option14];
                $answerArray = $this->createOption($data);
            } else {
                $qstnImage = $oldData->questionImage;
                $answerArray = $this->createOption($data);
            }
        } elseif ($data->qstn_type == '2') {
            $options = [$data->option21, $data->option22, $data->option23, $data->option24];
            foreach ($options as $key => $image) {
                if ($image) {
                    $optnImage = date('YmdHis') . Str::random(5) . "." . $image->getClientOriginalExtension();
                    $move = $image->storeAs('/image/question', $optnImage, 'public');
                    $optnImages[$key] = $optnImage;
                }
                else{
                    $optnImages[$key] = $oldData->answer_options[$key]['image'];
                }
            }
            $data['optnImage'] = $optnImages;
            $answerArray = $this->createOption($data, $oldData);
        } elseif ($data->qstn_type == '1') {
            $answerArray = $this->createOption($data);
        }
        $qstn = Question::find($data->id);
        $qstn->question_type = $data->qstn_type;
        $qstn->question = $data->question1;
        $qstn->questionImage = isset($qstnImage) ? $qstnImage : '';
        $qstn->answer_options = $answerArray;
        $qstn->score = $data->score;
        $qstn->save();
        if ($qstn) {
            $qstn['status'] = 1;
            $qstn['message'] = 'Question updated successfully';
        }
        return $qstn;
    }
}
