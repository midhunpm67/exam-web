@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    {{-- <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/asset/plugin/src/bootstrap-duallistbox.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="../src/bootstrap-duallistbox.css"> --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>

    <script src="asset/plugin/src/jquery.bootstrap-duallistbox.js"></script>
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
                    <h1 class="m-0">Exam</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Exam v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <form id="demoform" action="" method="">
        @csrf
        <div class="">
            <div class="col-6">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="col-form-label">Exam</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="exam" name="exam" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="col-form-label">Time <span
                                    style="font-size: 65%;">(minutes)</span> </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="time" name="time" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-sm-6">
                <label class="text-uppercase">Questions</label>
            </div>
            <div class="col-sm-6">
                <label class="text-uppercase">Selected questions</label>
            </div>
        </div>
        <div class="">
            <div class="card">
                <div class="p-4">
                    <select multiple="multiple" size="10" name="duallistbox_demo1[]" id="duallistbox_demo1">
                        @foreach ($questions as $key=>$item)
                            <option value="{{ $item->_id }}">{{$key+1}} . {{ $item->question }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-secondary btn-block text-uppercase" id="submit">Submit
                    data</button>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script>
        var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('/asset/js/admin/create-exam.js') }}"></script>
@endpush
