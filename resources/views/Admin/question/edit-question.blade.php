@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <style>
        .error {
            color: #ed6664;
            font-size: 80%;
        }
    </style>
@endpush

@extends('Layout.adminLayout')
@section('body')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Question</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Question v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <form action="" method="" id="update-question-from" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <select class="form-select question-select" aria-label="Default select example" id="question_type"
                            name="question_type" disabled>
                            <option selected>select question type</option>
                            @php $array=(config('question'))   @endphp
                            @foreach ($array['qstntype'] as $key => $value)
                                <option value="{{ $key }}" @php
                                    if ($key == $response->question_type) {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    }
                                @endphp>
                                    {{ $value }}
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card-body">
                    <div class="">
                        <div class="form-group row type1">
                            <div class="col-sm-2">
                                <label for="inputEmail3" class="col-form-label">Question</label>
                                <input type="hidden" value="{{ $response->_id }}" name="id">
                                <input type="hidden" value="{{ $response->question_type }}" name="qstn_type">
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="question1" name="question1"
                                    placeholder="question" value="{{ $response->question }}">
                            </div>
                            <span id="error-question1" class="invalid-feedback"></span>
                            <p class="question" style="color: red"></p>
                        </div>
                        <div class="form-group row type2">
                            <div class="col-sm-2">
                                <label for="inputEmail3" class="col-form-label"></label>
                            </div>
                            <div class="col-sm-10">
                                <input type="file" class="form-control mt-2" id="questionImage" name="questionImage"
                                    placeholder="question">
                                <div>
                                    <img src="{{ asset('storage/image/question/' . $response->questionImage) }}"
                                        alt="" style="width: 20%;height:20%" class="mt-2" class="img-thumbnail">
                                </div>
                            </div>

                            <p class="question" style="color: red"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="option-type1">
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row ">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label">Option:1 </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="option11" name="option11"
                                        placeholder="option"
                                        value="{{ isset($response->answer_options[0]['text']) ? $response->answer_options[0]['text'] : '' }}">
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="correct" value="option1"
                                            id="radio1" @if ($response->answer_options[0]['is_correct_answer']) checked @endif>
                                        <img src="{{ asset('asset/img/check-mark.png') }}" alt=""
                                            style="width: 30px; height:30px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row ">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label">Option:2 </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="option12" name="option12"
                                        placeholder="option"
                                        value="{{ isset($response->answer_options[1]['text']) ? $response->answer_options[1]['text'] : '' }}">
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="correct" value="option2"
                                            id="" @if ($response->answer_options[1]['is_correct_answer']) checked @endif>
                                        <img src="{{ asset('asset/img/check-mark.png') }}" alt=""
                                            style="width: 30px; height:30px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row ">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label">Option:3 </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="option13" name="option13"
                                        placeholder="option"
                                        value="{{ isset($response->answer_options[2]['text']) ? $response->answer_options[2]['text'] : '' }}">
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="correct" value="option3"
                                            id="" @if ($response->answer_options[2]['is_correct_answer']) checked @endif>
                                        <img src="{{ asset('asset/img/check-mark.png') }}" alt=""
                                            style="width: 30px; height:30px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row ">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label">Option:4 </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="option14" name="option14"
                                        placeholder="option"
                                        value="{{ isset($response->answer_options[3]['text']) ? $response->answer_options[3]['text'] : '' }}">
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="correct" value="option4"
                                            id="" @if ($response->answer_options[3]['is_correct_answer']) checked @endif>
                                        <img src="{{ asset('asset/img/check-mark.png') }}" alt=""
                                            style="width: 30px; height:30px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- type 2 ----------------------------------------------------------------------------------- --}}

        <div class="option-type2">
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label">Option:1 </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="option21" name="option21"
                                        placeholder="option">
                                    <div>
                                        <img src="{{ asset('storage/image/question/' . $response->answer_options[0]['image']) }}"
                                            alt="" style="width: 20%;height:20%" class="mt-2"
                                            class="img-thumbnail">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="correct" value="option1"
                                            id="radio2" value="" @if ($response->answer_options[0]['is_correct_answer'] && $response->question_type ==2 ) checked @endif>
                                        <img src="{{ asset('asset/img/check-mark.png') }}" alt=""
                                            style="width: 30px; height:30px">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label">Option:2 </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="option22" name="option22"
                                        placeholder="option">
                                    <div>
                                        <img src="{{ asset('storage/image/question/' . $response->answer_options[1]['image']) }}"
                                            alt="" style="width: 20%;height:20%" class="mt-2">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="correct" value="option2"
                                            id="" @if ($response->answer_options[1]['is_correct_answer'] && $response->question_type ==2 ) checked @endif>
                                        <img src="{{ asset('asset/img/check-mark.png') }}" alt=""
                                            style="width: 30px; height:30px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label">Option:3 </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="option23" name="option23"
                                        placeholder="option">
                                    <div>
                                        <img src="{{ asset('storage/image/question/' . $response->answer_options[2]['image']) }}"
                                            alt="" style="width: 20%;height:20%" class="mt-2">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="correct" value="option3"
                                            id="" @if ($response->answer_options[2]['is_correct_answer'] && $response->question_type ==2 ) checked @endif>
                                        <img src="{{ asset('asset/img/check-mark.png') }}" alt=""
                                            style="width: 30px; height:30px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label">Option:4 </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="option24" name="option24"
                                        placeholder="option">
                                    <div>
                                        <img src="{{ asset('storage/image/question/' . $response->answer_options[3]['image']) }}"
                                            alt="" style="width: 20%;height:20%" class="mt-2 img-fluid">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="correct" value="option4"
                                            id="" @if ($response->answer_options[3]['is_correct_answer'] && $response->question_type ==2 ) checked @endif>
                                        <img src="{{ asset('asset/img/check-mark.png') }}" alt=""
                                            style="width: 30px; height:30px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row score">
            <div class="col-6">
                <div class="card-body">
                    <div class="">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="inputEmail3" class="col-form-label">Score</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="score" name="score"
                                    placeholder="score" value="{{ isset($response->score) ? $response->score : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="card-body">
                    <div class="col-6">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    {{-- popper js------------------------------ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
    {{-- popper js------------------------------ --}}

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('/asset/js/admin/edit-question.js') }}"></script>
    <script src="{{ asset('/asset/js/admin/update-question.js') }}"></script>
@endpush
