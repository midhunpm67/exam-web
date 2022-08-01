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
    <form action="" method="" id="update-exam-question" enctype="multipart/form-data">
        @csrf
        <div class="col-6">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <select class="form-select question-select" aria-label="Default select example" id="question_type"
                        name="question_type" disabled>
                        <option selected>select question type</option>
                        @php $array=(config('question'))   @endphp
                        @foreach ($array['qstntype'] as $key => $value)
                            <option value="{{ $key }}" @php
                                if ($key == $response->question['question_type']) {
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
        {{-- @dd($response); --}}
        @if ($response->question['question_type'] == 1 || $response->question['question_type'] == 3)
            <div class="col-6">
                <div class="card-body">
                    <div class="">
                        <div class="form-group row type1">
                            <div class="col-sm-2">
                                <label for="inputEmail3" class="col-form-label">Question</label>
                                <input type="hidden" value="{{$response->question_id}}" name="question_id">
                                <input type="hidden" value="{{$response->exam_id}}" name="exam_id">
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="question" name="question"
                                    placeholder="question" value="{{ $response->question['question'] }}">
                            </div>
                            <span id="error-question1" class="invalid-feedback"></span>
                            <p class="question" style="color: red"></p>
                        </div>
                        @if ($response->question['question_type'] == 3)
                            <div class="form-group row type2">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label"></label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control mt-2" id="questionImage" name="questionImage"
                                        placeholder="question">
                                    <div>
                                        <img src="{{ asset('storage/image/question/' . $response->question['questionImage']) }}"
                                            alt="" style="width: 20%;height:20%" class="mt-2"
                                            class="img-thumbnail">
                                    </div>
                                </div>

                                <p class="question" style="color: red"></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @foreach ($response->question['answer_options'] as $key => $item)
                <div class="col-6">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row ">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label">Option:{{ $key + 1 }} </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="option{{ $key + 1 }}"
                                        name="option{{ $key + 1 }}" placeholder="option"
                                        value="{{ isset($item['text']) ? $item['text'] : '' }}">
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="correct" value="option1"
                                            id="radio1" @if ($item['is_correct_answer']) checked @endif>
                                        <img src="{{ asset('asset/img/check-mark.png') }}" alt=""
                                            style="width: 30px; height:30px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        @if ($response->question['question_type'] == 2)
            <div class="col-6">
                <div class="card-body">
                    <div class="">
                        <div class="form-group row type1">
                            <div class="col-sm-2">
                                <label for="inputEmail3" class="col-form-label">Question</label>
                                {{-- <input type="hidden" value="{{ $response->_id }}" name="id">
                        <input type="hidden" value="{{ $response->question['question']}}" name="qstn_type"> --}}
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="question1" name="question1"
                                    placeholder="question" value="{{ $response->question['question'] }}">
                            </div>
                            <span id="error-question1" class="invalid-feedback"></span>
                            <p class="question" style="color: red"></p>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($response->question['answer_options'] as $item)
                {{-- @dd($item); --}}
                <div class="col-6">
                    <div class="card-body">
                        <div class="">
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="col-form-label">Option:{{ $key + 1 }} </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="option{{ $key + 1 }}"
                                        name="option{{ $key + 1 }}" placeholder="option">
                                    <div>
                                        <img src="{{ asset('storage/image/question/' . $item['image']) }}" alt=""
                                            style="width: 20%;height:20%" class="mt-2" class="img-thumbnail">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="correct" value="option1"
                                            id="radio1" @if ($item['is_correct_answer']) checked @endif>
                                        <img src="{{ asset('asset/img/check-mark.png') }}" alt=""
                                            style="width: 30px; height:30px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="card-body">
            <div class="col-6">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-secondary">UPDATE</button>
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
    <script src="{{ asset('/asset/js/admin/update-exam-question.js') }}"></script>
@endpush
